<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Merchant;
use App\Product;
use App\Order;
use jeremykenedy\LaravelRoles\Models\Role;

class AdminController extends Controller
{
    public function index()
    {
        $total_merchants = Merchant::get()->count();
        $products_count = Product::where('status', 1)->get()->count();
        $total_agent = Role::where("slug", "agent")->first()->users->where("active", 1)->count();
        $total_unverified_agents = Role::where("slug", "agent")->first()->users->where("verified", 0)->count();
        $total_user = Role::where("slug", "user")->first()->users->where("active", 1)->count();
        $total_request = Order::latest()->count();
        $total_district_managers = Role::where("slug", "reporter_2")->first()->users->where("active", 1)->count();
        $total_province_managers = Role::where("slug", "reporter_1")->first()->users->where("active", 1)->count();
        return view('admin.index',compact('total_merchants','products_count','total_agent','total_unverified_agents','total_user','total_request','total_district_managers','total_province_managers'));
    }
}
