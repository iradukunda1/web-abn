<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\User;
use App\Merchant;
use App\Product;
use jeremykenedy\LaravelRoles\Models\Role;
class StockManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $total_merchants = Merchant::get()->count();
        $total_product = Product::where('status', 1)->get()->count();
        $total_agent = Role::where("slug", "agent")->first()->users->where("active", 1)->count();
        $total_unverified_agents = Role::where("slug", "agent")->first()->users->where("verified", 0)->count();
        $total_user = Role::where("slug", "user")->first()->users->where("active", 1)->count();
        $total_request = Order::latest()->count();
        $latest_request=Order::latest()->first();
        $d=$latest_request->created_at->diffForHumans();
        
        $total_district_managers = Role::where("slug", "reporter_2")->first()->users->where("active", 1)->count();
        $total_province_managers = Role::where("slug", "reporter_1")->first()->users->where("active", 1)->count();
        return view('stock_manager.index',compact('total_merchants','total_product','total_agent','total_unverified_agents','total_user','total_request','total_district_managers','total_province_managers','d'));
  
        
    }
    public function stockIn(){
        $products=Product::paginate(10);
        
        return view('stock_manager.stock_in_list',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
