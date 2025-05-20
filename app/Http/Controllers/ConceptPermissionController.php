<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ConceptType;
use Illuminate\Http\Request;

class ConceptPermissionController extends Controller
{
    public function index()
    {
        // Solo admins pueden gestionar permisos
        if (!auth()->user()->is_admin) {
            return redirect()->route('concepts.index')
                ->with('error', 'No tienes permiso para administrar permisos');
        }
        
        $users = User::where('is_admin', false)->get();
        $conceptTypes = ConceptType::all();
        
        // Obtener usuarios que tienen permisos asignados
        $usersWithPermissions = User::whereHas('conceptTypes')->get();
        
        return view('admin.concepts.user_permissions', compact('users', 'conceptTypes', 'usersWithPermissions'));
    }

    public function getUserPermissions($userId)
    {
        $user = User::findOrFail($userId);
        $allTypes = ConceptType::all();
        
        if ($allTypes->count() === 0) {
            return response()->json([
                'can_create' => false,
                'can_edit' => false,
                'can_delete' => false
            ]);
        }
        
        // Verificar los permisos del usuario para determinar si tiene permisos globales
        $types = $user->conceptTypes;
        
        // Si el usuario no tiene permisos asignados
        if ($types->isEmpty()) {
            return response()->json([
                'can_create' => false,
                'can_edit' => false,
                'can_delete' => false
            ]);
        }
        
        // Verificar si tiene permisos globales
        // Para tener permisos globales debe tener el mismo permiso para todos los tipos
        $firstType = $types->first();
        $can_create = $firstType->pivot->can_create;
        $can_edit = $firstType->pivot->can_edit;
        $can_delete = $firstType->pivot->can_delete;
        
        // Verificar si todos los tipos tienen los mismos permisos que el primero
        $hasGlobalPermissions = $types->count() === $allTypes->count() && 
            $types->every(function($type) use ($can_create, $can_edit, $can_delete) {
                return $type->pivot->can_create === $can_create && 
                       $type->pivot->can_edit === $can_edit && 
                       $type->pivot->can_delete === $can_delete;
            });
        
        if ($hasGlobalPermissions) {
            return response()->json([
                'can_create' => $can_create,
                'can_edit' => $can_edit,
                'can_delete' => $can_delete
            ]);
        } else {
            // Si no tiene permisos consistentes para todos los tipos, mostramos como no globales
            return response()->json([
                'can_create' => false,
                'can_edit' => false,
                'can_delete' => false
            ]);
        }
    }

    public function update(Request $request)
    {
        // Solo admins pueden gestionar permisos
        if (!auth()->user()->is_admin) {
            return redirect()->route('concepts.index')
                ->with('error', 'No tienes permiso para administrar permisos');
        }
        
        // Validar
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'permissions' => 'sometimes|array',
        ]);
        
        $userId = $request->user_id;
        $user = User::findOrFail($userId);
        
        // Eliminar todos los permisos existentes
        $user->conceptTypes()->detach();
        
        // Si hay permisos seleccionados
        if ($request->has('permissions')) {
            $canCreate = isset($request->permissions['create']);
            $canEdit = isset($request->permissions['edit']);
            $canDelete = isset($request->permissions['delete']);
            
            // Si al menos uno de los permisos está activo
            if ($canCreate || $canEdit || $canDelete) {
                // Obtener todos los tipos de conceptos
                $conceptTypes = ConceptType::all();
                
                // Asignar los mismos permisos a todos los tipos
                foreach ($conceptTypes as $type) {
                    $user->conceptTypes()->attach($type->id, [
                        'can_create' => $canCreate,
                        'can_edit' => $canEdit,
                        'can_delete' => $canDelete
                    ]);
                }
            }
        }
        
        return redirect()->route('concepts.permissions')
            ->with('success', 'Permisos actualizados exitosamente');
    }
}