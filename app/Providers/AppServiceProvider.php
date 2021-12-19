<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\OrderedProduct;
use App\Order;
use App\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(["layouts.admin"], function ($view) {
            if (auth()->check() &&  auth()->user()->hasRole("admin")) {
                $un_seen = Order::where("seen", 0)->get()->count();
                $new_agent = User::where("verified", 0)->get()->count();
                $view->with(["un_seen"=>$un_seen,"new_agent"=>$new_agent]);
            }
        });
    }
}
