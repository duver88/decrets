<?php

namespace App\Http\Controllers;  
  
use App\Models\User;  
use App\Models\Category;  
use App\Models\UserCategoryPermission;  
use Illuminate\Http\Request;  
  
class UserCategoryPermissionController extends Controller  
{  
    /**  
     * Muestra la página de gestión de permisos  
     */  
    public function index()  
    {  
        $users = User::where('is_admin', 0)->get();  
        $categories = Category::all();  
        $permissions = UserCategoryPermission::with(['user', 'category'])->get();  
          
        return view('admin.user_permissions', compact('users', 'categories', 'permissions'));  
    }  
      
    /**  
     * Almacena un nuevo permiso  
     */  
    public function store(Request $request)  
    {  
        $request->validate([  
            'user_id' => 'required|exists:users,id',  
            'category_id' => 'required|exists:categories,id',  
        ]);  
          
        // Eliminar permisos existentes para esta combinación usuario-categoría  
        UserCategoryPermission::where('user_id', $request->user_id)  
                             ->where('category_id', $request->category_id)  
                             ->delete();  
          
        // Crear nuevo permiso  
        UserCategoryPermission::create([  
            'user_id' => $request->user_id,  
            'category_id' => $request->category_id,  
            'can_create' => $request->has('can_create'),  
            'can_edit' => $request->has('can_edit'),  
            'can_delete' => $request->has('can_delete'),  
        ]);  
          
        return redirect()->back()->with('success', 'Permisos asignados correctamente');  
    }  
      
    /**  
     * Elimina un permiso  
     */  
    public function destroy($id)  
    {  
        $permission = UserCategoryPermission::findOrFail($id);  
        $permission->delete();  
          
        return redirect()->back()->with('success', 'Permisos eliminados correctamente');  
    }  
}