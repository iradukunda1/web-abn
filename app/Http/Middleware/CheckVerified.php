<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckVerified
{
    
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        if (Auth::check() && Auth::user()->verified != 1) {
            Auth::logout();
            return redirect('/login')->with('error_login', 'Your account is not verified. Please contact ABN administrator!');
        }
        return $response;
    }
}
