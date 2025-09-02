<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRoleMiddleware
{
    // Define role hierarchy (higher number = more permissions)
    private $roleHierarchy = [
        'user' => 1,        // Regular users (ticket creators)
        'agent' => 2,       // Support agents
        'admin' => 3,       // Full admin access
    ];

    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            abort(403, 'Unauthorized');
        }

        $userRole = strtolower(Auth::user()->role);
        $requiredRole = strtolower($role);

        // Check if user's role level is >= required role level
        $userLevel = $this->roleHierarchy[$userRole] ?? 0;
        $requiredLevel = $this->roleHierarchy[$requiredRole] ?? 999;

        if ($userLevel >= $requiredLevel) {
            return $next($request);
        }

        abort(403, 'Unauthorized - Insufficient permissions');
    }
}