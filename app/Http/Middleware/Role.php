<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class Role
{

    public function handle($request, Closure $next, $permission)
    {
        if (Auth::guard()->user()->hasPermissionByRoleId($permission, Auth::guard()->user()->role_id)) {
            return $next($request);
        }
        return redirect()->route('error.forbidden');
    }
}
