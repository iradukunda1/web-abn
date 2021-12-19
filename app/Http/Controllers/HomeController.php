<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
class HomeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }
    public function index()
    {
        return view('pages.home');
    }

    public function about()
    {
        return view('pages.about');
    }
    public function contact()
    {
        return view('pages.contact-us');
    }

    public function services()
    {
        return view('pages.services');
    }

    public function productdetail($slug)
    {
        $product = Product::where("slug", $slug)->first();
        $product_id = [];
        foreach ($product->categories as $category) {
            foreach ($category->products->pluck("id") as $item) {
                $product_id[] = $item;
            }
        }
        $recommended_products = Product::latest()->whereIn("id", $product_id)->where("id", "!=", $product->id)->take(12)->get();
        return view('pages.product-detail',compact('product','recommended_products'));
    }

    public function checkout()
    {
        return view('pages.checkout');
    }
}
