<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class checkUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard()->user()->role < 2) {
            return redirect()->route('home');
        }
        return $next($request);

        return $next($request);
    }
}
