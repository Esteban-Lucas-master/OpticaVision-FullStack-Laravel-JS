<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles Los roles permitidos para la ruta.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Verifica si el usuario ha iniciado sesión
        if (!Auth::check()) {
            // Si no ha iniciado sesión, lo mejor es redirigirlo al login
            return redirect('login');
        }

        // 2. Obtiene el rol del usuario actual
        $userRole = Auth::user()->rol; // Usamos la columna 'rol'

        // 3. Comprueba si el rol del usuario está en la lista de roles permitidos
        if (in_array($userRole, $roles)) {
            // Si el rol es correcto, permite el acceso a la ruta
            return $next($request);
        }

        // 4. Si el rol no es correcto, muestra un error 403 "Prohibido"
        abort(403, 'NO TIENES PERMISOS PARA ACCEDER A ESTA SECCIÓN');
    }
}
