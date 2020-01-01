<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class CheckUser
{

    public function handle($request, Closure $next)
    {
        if (Auth::guard()->user()->hasPermissionByRoleId('not-permission', Auth::guard()->user()->role_id)) {
            return redirect()->route('home');
        }
        return $next($request);
    }
}
