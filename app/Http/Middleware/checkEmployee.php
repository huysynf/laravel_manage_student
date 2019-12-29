<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class checkEmployee
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
        if (Auth::guard()->user()->role < 3) {
            return redirect()->route('errors.forbidden');
        }

        return $next($request);
    }
}
