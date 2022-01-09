<?php

namespace App\Http\Controllers;

use App\Merchant;
use App\OrderedProduct;
use App\Order;
use App\User;
use App\userProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use jeremykenedy\LaravelRoles\Models\Role;

class DistrictManagerController extends Controller
{
    public function index()
    {
        $province=Auth::user()->user->first()->province;
        $district=Auth::user()->user->first()->district;
        $agents = Role::where("slug", "agent")->first()->users->where("active", 1)->where("verified", 1);
        $agents_id=[];
        foreach($agents as $agent){
            array_push($agents_id,$agent->id);
        }
        $total_agents=userProfile::whereIn('user_id',$agents_id)->where('province',$province)->where('district',$district)->get()->count();
        $merchants=Merchant::where('province',$province)->where('district',$district)->where('active',1)->where('verified',1)->get();
        $merchants_id=[];
        foreach($merchants as $merchant){
            array_push($merchants_id,$merchant->id);
        }
        $ordered_products=OrderedProduct::whereIn('merchant_id',$merchants_id)->get();
        $orders_products_id= [];
        foreach($ordered_products as $ordered_product){
            array_push($orders_products_id,$ordered_product['order_id']);
        }
        $total_requests = Order::whereIn('id',$orders_products_id)->get()->count();
        $total_merchants = $merchants->count();
        return view('District_Reporter.index',compact('total_agents','total_merchants','district','total_requests'));
    }

    public function create()
    {
        //
    }
    public function agent_report(){
        $province=Auth::user()->user->first()->province;
        $district=Auth::user()->user->first()->district;
        $agents = Role::where("slug", "agent")->first()->users->where("active", 1)->where("verified", 1);
        $agents_id=[];
        foreach($agents as $agent){
            array_push($agents_id,$agent->id);
        }
        $agents=userProfile::whereIn('user_id',$agents_id)->where('province',$province)->where('district',$district)->paginate(20);
        return view('District_Reporter.agent_reporter',compact('agents','province','district'));
    }

     public function all_request(){
        $province=Auth::user()->user->first()->province;
        $district=Auth::user()->user->first()->district;

        $merchants=Merchant::where('province',$province)->where('district',$district)->get();
        $merchants_id=[];
        foreach($merchants as $merchant){
            array_push($merchants_id,$merchant->id);
        }
        $ordered_products=OrderedProduct::whereIn('merchant_id',$merchants_id)->get();
        $orders_products_id= [];
        foreach($ordered_products as $ordered_product){
            array_push($orders_products_id,$ordered_product['order_id']);
        }
        $orders = Order::whereIn('id',$orders_products_id)->paginate(300);
        foreach ($orders as $order) {
            if($order->merchant_id){
                $customer = Merchant::where("id",$order->merchant_id)->first();
            }else{
                $customer = User::where("id",$order->customer_id)->first();
            }
            $order["customer"] = $customer;
            $order["agent"] = User::where("id",$order->agent_id)->first();
        }
        return view('District_Reporter.all_request',compact('orders','province','district'));
    }

     public function merchent_report(){
        $province=Auth::user()->user->first()->province;
        $district=Auth::user()->user->first()->district;

        $merchants=Merchant::where('province',$province)->where('district',$district)->where('active',1)->where('verified',1)->paginate(20);

        return view('District_Reporter.merchent_report' ,compact('merchants','province','district'));
    }
  
    public function store(Request $request)
    {
        //
    }

    public function show()
    {
        return view('District_Reporter.profile');
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
