<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role The role to check for.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Si el usuario no está autenticado o no tiene el rol requerido, denegar acceso.
        if (!Auth::check() || Auth::user()->role !== $role) {
            // Redirigir o mostrar un error 403 (Prohibido)
            abort(403, 'Acceso no autorizado.');
        }

        return $next($request);
    }
}
