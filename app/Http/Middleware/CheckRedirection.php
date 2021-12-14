<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRedirection
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        if (Auth::check() && (Auth::user()->hasRole("admin"))) {
            return redirect('/admin');
        }elseif (Auth::check() && (Auth::user()->hasRole("user"))) {
            return $response;
        }elseif (Auth::check() && (Auth::user()->hasRole("agent"))) {
            return redirect("/agent");
        }
        return redirect(""); 
    }
}
