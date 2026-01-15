<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // convertir roles a enteros
        $roles = array_map('intval', $roles);
        $userRole = (int) Auth::user()->role_id;

        if (!in_array($userRole, $roles)) {
            abort(403, 'No tiene permisos para acceder a este módulo');
        }

        return $next($request);
    }
}
