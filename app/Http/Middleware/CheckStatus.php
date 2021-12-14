<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckStatus
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        if (Auth::check() && Auth::user()->active != 1) {
            Auth::logout();
            return redirect('/login')->with('error_login', 'Your account is not active. Please contact ABN administrator!');
        }
        return $response;
    }
}
