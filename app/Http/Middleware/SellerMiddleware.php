<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
if (!Auth::guard('seller')->check()) {
    return redirect('/login');
}
class SellerMiddleware
{


    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'seller') {
            return $next($request);
        }

        abort(403, 'Unauthorized access.');
    }
}