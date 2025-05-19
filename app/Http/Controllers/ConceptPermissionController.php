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
        
        return view('concepts.user_permissions', compact('users', 'conceptTypes'));
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
            'permissions' => 'required|array',
            'permissions.*' => 'array'
        ]);
        
        // Procesar permisos
        foreach ($request->permissions as $userId => $typePermissions) {
            $user = User::findOrFail($userId);
            
            // Eliminar permisos existentes
            $user->conceptTypes()->detach();
            
            // Agregar nuevos permisos
            foreach ($typePermissions as $typeId => $permissions) {
                $canCreate = isset($permissions['create']);
                $canEdit = isset($permissions['edit']);
                $canDelete = isset($permissions['delete']);
                
                if ($canCreate || $canEdit || $canDelete) {
                    $user->conceptTypes()->attach($typeId, [
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