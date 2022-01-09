<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class user_profile_completeMiddleware
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
        $response = $next($request);
        if (Auth::check() && Auth::user()->profile_complete != 1) {
            return redirect('/complete/profile')->with('error_login', ' Please Complete your Profile');
        }

        return $response;

    }
}
