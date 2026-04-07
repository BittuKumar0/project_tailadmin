<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();

        // If not logged in, redirect to login
        if (!$user) {
            return redirect()->route('login'); // safer than hardcoded /login
        }

        // Normalize roles to lowercase
        if (strtolower($user->role) !== strtolower($role)) {
            abort(403, 'Unauthorized: insufficient permissions');
        }

        return $next($request);
    }
}