<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Verifica si el usuario está autenticado y es administrador
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        // Si no es admin, redirige o lanza un error 403
        abort(403, 'Acceso denegado');
    }
}
