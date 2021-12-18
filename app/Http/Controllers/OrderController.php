<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderedProduct;
use App\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('agent.orders.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request_products = $request['products'];
        $order_id = uniqid() . '-' . random_int(10000, 99999);
        $sum = $request['products'][0]['sale_price'] * $request['quantity'];
        $order = Order::create([
            "order_id" => $order_id,
            "agent_id" => auth()->user()->id,
            "price" => $sum,
            "customer_id"=> $request['merchant']['id'],
        ]);
        foreach ($request_products as $request_product) {
            $product = Product::where('id', $request_product['id'])->first();
            $product->update([
                "quantity" => $product->quantity - $request['quantity'],
            ]);
            OrderedProduct::create([
                "order_id" => $order->id,
                "quantity" => $request['quantity'],
                "price" => $request_product['sale_price'],
                "product_id" => $request_product['id'],
                "customer_id" => $request['merchant']['id'],
                "agent_id" =>auth()->user()->id,
            ]);
        }
        return "Order Created Successfully!";
    }

    public function show(Order $order)
    {
        //
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
