<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Vérifie si l'utilisateur connecté a le rôle requis
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role  Rôle attendu : user, association, admin
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        $user = Auth::user();

        if (!$user || $user->role !== $role) {
            abort(403, 'Accès refusé');
        }

        return $next($request);
    }
}
