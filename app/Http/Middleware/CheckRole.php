<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        $userRoleId = auth()->user()->role_id;

        // التحقق من الأدوار بناءً على المعطى
        $roleMap = [
            'admin' => 1,
            'student' => 2,
            'teacher' => 3,
            'manage-lessons' => [2, 3]
        ];

        if (!isset($roleMap[$role]) ||
            (is_array($roleMap[$role]) && !in_array($userRoleId, $roleMap[$role])) ||
            ($roleMap[$role] !== $userRoleId)
        ) {
            abort(403);
        }

        return $next($request);
    }
}
