<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Merchant;
use App\Product;


class AgentController extends Controller
{
    public function index()

    {   
        $active_merchants_count = Merchant::where('registered_by', auth()->user()->id)->where('active',1)->get()->count();
        $total_merchants = Merchant::where('registered_by', auth()->user()->id)->get()->count();
        $products_count = Product::where('status', 1)->get()->count();
        return view('agent.index',compact('active_merchants_count','total_merchants','products_count'));
    }

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
