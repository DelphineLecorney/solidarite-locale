<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Vérifie le rôle de l'utilisateur connecté.
     * L'admin a toujours accès à tout.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        $user = Auth::user();

        if (!$user) {
            // pas connecté
            abort(403, 'Accès refusé');
        }

        // admin a toujours accès
        if ($user->role === 'admin') {
            return $next($request);
        }

        if ($user->role !== $role) {
            abort(403, 'Accès refusé');
        }

        return $next($request);
    }
}
