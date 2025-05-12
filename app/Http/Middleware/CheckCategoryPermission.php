<?php
namespace App\Http\Middleware;  
  
use Closure;  
use Illuminate\Http\Request;  
use App\Models\Document;  
use Symfony\Component\HttpFoundation\Response;  
  
class CheckCategoryPermission  
{  
    /**  
     * Handle an incoming request.  
     *  
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next  
     */  
    public function handle(Request $request, Closure $next, string $permission): Response  
    {  
        // Si es admin, permitir acceso  
        if (auth()->user()->is_admin) {  
            return $next($request);  
        }  
          
        // Para rutas que incluyen el ID del documento  
        if ($request->route('id')) {  
            $document = Document::findOrFail($request->route('id'));  
            $categoryId = $document->category_id;  
              
            if (!auth()->user()->hasPermissionFor($categoryId, $permission)) {  
                return redirect()->route('user.dashboard')  
                               ->with('error', 'No tienes permiso para realizar esta acción');  
            }  
        }  
          
        // Para rutas de creación, verificar si tiene permiso para al menos una categoría  
        if ($request->routeIs('user.document.create')) {  
            $hasCreatePermission = auth()->user()->categoryPermissions()  
                                      ->where('can_create', true)  
                                      ->exists();  
              
            if (!$hasCreatePermission) {  
                return redirect()->route('user.dashboard')  
                               ->with('error', 'No tienes permiso para crear documentos');  
            }  
        }  
          
        return $next($request);  
    }  
}