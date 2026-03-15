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
     * Example usage:
     *  - role:supervisor
     *  - role:engineer,manager
     */
    public function handle(Request $request, Closure $next, string $roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if (!$user->role) {
            abort(403, 'You are not allowed to access this page.');
        }

        // Support one or many roles separated by comma 
        $allowedRoles = array_map(
            fn ($name) => strtolower(trim($name)),
            explode(',', $roles)
        );

        $userRoleName = strtolower($user->role->name);
        
         // block supervisors 
        if (in_array('engineer', $allowedRoles, true) && in_array('manager', $allowedRoles, true)) {
            if ($userRoleName === 'supervisor') {
                abort(403, 'You are not allowed to access this page.');
            }

            return $next($request);
        }

        // Generic check for single-role or other combinations.
        if (!in_array($userRoleName, $allowedRoles, true)) {
            abort(403, 'You are not allowed to access this page.');
        }

        return $next($request);
    }
}