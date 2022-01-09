<?php

namespace App\Http\Controllers;

use App\Merchant;
use App\OrderedProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Order;
use App\userProfile;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use jeremykenedy\LaravelRoles\Models\Role;

class ProvinceManagerController extends Controller
{

    public function index()
    {
        $province=Auth::user()->user->first()->province;
        $agents = Role::where("slug", "agent")->first()->users->where("active", 1)->where("verified", 1);
        $agents_id=[];
        foreach($agents as $agent){
            array_push($agents_id,$agent->id);
        }
        $total_agents=userProfile::whereIn('user_id',$agents_id)->where('province',$province)->get()->count();

        $district_managers = Role::where("slug", "reporter_2")->first()->users->where("active", 1);
        $district_managers_id=[];
        foreach($district_managers as $manager){
            array_push($district_managers_id,$manager->id);
        }
        $total_district_managers=userProfile::whereIn('user_id',$district_managers_id)->where('province',$province)->get()->count();

        $merchants=Merchant::where('province',$province)->get();
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

        return view('Province_Reporter.index',compact('total_agents','total_district_managers','total_requests','total_merchants','province'));
    }

    public function show()
    {
        $province=Auth::user()->user->first()->province;

        $data=Merchant::where('province',$province)->get();
       return view('Province_Reporter.agent_reporter',['datas'=>$data]);
    }
    
    public function mechent_report()
    {
        $province=Auth::user()->user->first()->province;
        $merchants=Merchant::where('province',$province)->where('active',1)->where('verified',1)->paginate(200);

        return view ('Province_Reporter.mechent_report',compact('merchants'));
    }

    public function all_request(){

        $province=Auth::user()->user->first()->province;
        $merchants=Merchant::where('province',$province)->get();
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
        return view('Province_Reporter.all_request_report',compact('orders','province'));
    }
    public function edit()
    {
        return view('Province_Reporter.profile');
    }

    public function agents_list(){
        $province = $province=Auth::user()->user->first()->province;
        $agents = Role::where("slug", "agent")->first()->users->where("active", 1)->where("verified", 1);
        $agents_id=[];
        foreach($agents as $agent){
            array_push($agents_id,$agent->id);
        }
        $agents=userProfile::whereIn('user_id',$agents_id)->where('province',$province)->paginate(500);
        return view('Province_Reporter.agent_reporter',compact('agents','province'));
    }

    public function district_managers(){
        $province = $province=Auth::user()->user->first()->province;
        $district_managers = Role::where("slug", "reporter_2")->first()->users->where("active", 1)->where("verified", 1);
        $district_managers_id=[];
        foreach($district_managers as $manager){
            array_push($district_managers_id,$manager->id);
        }
        $district_managers=userProfile::whereIn('user_id',$district_managers_id)->where('province',$province)->paginate(500);
        return view('Province_Reporter.district_managers_list',compact('district_managers','province'));
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
