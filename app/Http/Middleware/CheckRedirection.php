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
        }elseif (Auth::check() && (Auth::user()->hasRole("agent"))) {
            return redirect("/agent");
        }
        elseif(Auth::check()&&(Auth::user()->hasRole("reporter_1"))){
            return redirect("/province");
        }
        elseif(Auth::check()&&(Auth::user()->hasRole("reporter_2"))){
            return redirect("/district");
        }
        elseif (Auth::check()&&(Auth::user()->hasRole('stock_manager'))){
            return redirect('/stock');
        }
       
        return $response;
    }
}
