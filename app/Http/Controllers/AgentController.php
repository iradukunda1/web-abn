<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Merchant;
use App\Product;
use App\Order;
use App\User;
use App\userProfile;
use App\Http\Resources\UserResource;

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
    public function complete_profile(){
        if(auth()->user()->profile_complete != 1){
           return view('agent.complete_profile');
        }else {
            return redirect("/agent");
        }
    }
    public function profile_store(Request $request ,User $user)
    {
        $request->validate([
            'email' => ['required', 'string', 'max:255', 'unique:users,email,' . $user->id],

        ]);
        $user->update([
            'profile_complete' => 1,
        ]);
        $user_profile=userProfile::create([
            'user_id'=>$user->id,
            'province'=>$request->province,
            'district'=>$request->district,
            'sector'=>$request->sector,
        ]);


        return response(new UserResource($user));
    }
}
