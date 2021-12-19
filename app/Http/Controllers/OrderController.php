<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderedProduct;
use App\Product;
use App\User;
use App\Merchant;
use App\Http\Resources\OrderProductsResource;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->where('agent_id',auth()->user()->id)->orderBy("created_at")->get();
        foreach ($orders as $order) {
            $order["merchant"] = Merchant::where("id",$order->merchant_id)->first();
        }
        return view('agent.orders.index',compact('orders'));
    }
    public function adminList()
    {
        $orders = Order::latest()->orderBy("created_at")->get();
        foreach ($orders as $order) {
            if($order->merchant_id){
                $customer = Merchant::where("id",$order->merchant_id)->first();
            }else{
                $customer = User::where("id",$order->customer_id)->first();
            }
            $order["customer"] = $customer;
            $order["agent"] = User::where("id",$order->agent_id)->first();
        }
        return view('admin.orders.list',compact('orders'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {  
        $request_products = $request->all()['products'][0];
        $order_id = uniqid() . '-' . random_int(10000, 99999);
        $sum = 0;
        foreach($request_products as $request_product){
            $sum += $request_product['sale_price'] * $request_product['request_quantity'];
            $product = Product::where('id', $request_product['id'])->first();
            $product->update([
                "quantity" => $product->quantity - $request_product['request_quantity'],
            ]);
        }
        $order = Order::create([
            "order_id" => $order_id,
            "agent_id" => auth()->user()->id,
            "price" => $sum,
            "merchant_id"=> $request['merchant']['id'],
        ]);
        foreach ($request_products as $request_product) {           
            OrderedProduct::create([
                "order_id" => $order->id,
                "quantity" => $request_product['request_quantity'],
                "price" => $request_product['sale_price'],
                "product_id" => $request_product['id'],
                "merchant_id" => $request['merchant']['id'],
                "agent_id" =>auth()->user()->id,
            ]);
        }
        return "Order Created Successfully!";
    }

    public function agentShow(Order $order)
    {
        return OrderProductsResource::collection(OrderedProduct::where("order_id", $order->id)->where("agent_id",auth()->user()->id)->get());
    }  
    public function adminShow(Order $order)
    {
        $order = Order::where("id",$order->id)->first();

        $order->update([
            "seen" => true,
        ]);
        return OrderProductsResource::collection(OrderedProduct::where("order_id", $order->id)->get());
    }

    public function edit(Order $order)
    {
        //
    }

  
    public function update(Request $request, Order $order)
    {
        //
    }

    public function destroy(Order $order)
    {
        //
    }
}
