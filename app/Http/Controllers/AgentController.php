<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Merchant;
use App\Product;
use App\Order;


class AgentController extends Controller
{
    public function index()

    {   
        $active_merchants_count = Merchant::where('registered_by', auth()->user()->id)->where('active',1)->get()->count();
        $total_merchants = Merchant::where('registered_by', auth()->user()->id)->get()->count();
        $products_count = Product::where('status', 1)->get()->count();
        $orders_count = Order::where('agent_id', auth()->user()->id)->get()->count();
        return view('agent.index',compact('active_merchants_count','total_merchants','products_count','orders_count'));
    }
}
