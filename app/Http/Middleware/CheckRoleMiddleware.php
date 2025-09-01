<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        // Case-insensitive check
        if (Auth::check() && strtolower(Auth::user()->role) === strtolower($role)) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
