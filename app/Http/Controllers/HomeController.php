<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
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

    public function productdetail(Product $product)
    {
        return view('pages.productdetail',compact('product'));
    }

    public function checkout()
    {
        return view('pages.checkout');
    }
}
