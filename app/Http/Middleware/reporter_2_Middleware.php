<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;



use Closure;

class reporter_2_Middleware
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
        if (Auth::check() && (Auth::user()->hasRole("reporter_2"))) {
            return $response = $next($request);
        }
        return redirect("/home");
    }
}
