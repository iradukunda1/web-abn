<?php

namespace App\Http\Controllers;

use App\Category;
use App\consumed_stockOut;
use App\Order;
use Illuminate\Http\Request;
use App\User;
use App\Merchant;
use App\Product;
use App\stockIn;
use App\stockOut;
use Carbon\Carbon;
use Exception;
use jeremykenedy\LaravelRoles\Models\Role;
use Illuminate\Support\Str;
use PHPUnit\Util\Json;

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
        $latest_request = Order::latest()->first();
        $d = $latest_request->created_at->diffForHumans();

        $total_district_managers = Role::where("slug", "reporter_2")->first()->users->where("active", 1)->count();
        $total_province_managers = Role::where("slug", "reporter_1")->first()->users->where("active", 1)->count();
        return view('stock_manager.index', compact('total_merchants', 'total_product', 'total_agent', 'total_unverified_agents', 'total_user', 'total_request', 'total_district_managers', 'total_province_managers', 'd'));
    }
    public function stockInList()
    {
        $products = stockIn::paginate(10);

        return view('stock_manager.stockin.stock_in_list', compact('products'));
    }
    public  function stockIn()
    {

        $categories = Category::all();
        return view('stock_manager.stockin.stock_in', compact('categories'));
    }
    public function stockIn_store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'price' => 'required|numeric|min:10',
            'quantity' => 'required|numeric|min:1'
        ]);
        try {


            $stockIn = stockIn::create([
                'product_name' => $request['product_name'],

                'price' => $request['price'],
                'quantity' => $request['quantity'],
                'slug' => Str::slug($request['product_name']),
                'category_id' => $request['category_id']
            ]);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return redirect()->back()->with(['alert' => 'success', 'message' => 'Product Saved Successful']);
    }
    public function stockOut()
    {
        $categories = Category::all();
        return view('stock_manager.stockout.stock_out', compact('categories'));
    }
    public function stockOutList()
    {
        $stockOuts = stockOut::all();
        return view('stock_manager.stockout.stock_out_list', compact('stockOuts'));
    }
    public function Category_Stock(Request $request)
    {
        $datas = stockIn::where('category_id', $request->category_id)->get();
        return response()->json(['stockIn' => $datas,]);
    }
    public function Search_Product_Stock(Request $request)
    {
        $datas = stockIn::where('slug', $request->product_name)->first();
        return response()->json(['product' => $datas]);
    }
    public function stockOut_store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'price' => 'required|numeric|min:10',
            'quantity' => 'required|numeric|min:1',
            'quantity_needed' => 'required|numeric|lte:quantity'
        ]);
        try {
            $stockindata = stockIn::where('slug', $request->product_name)->first();

            $stockOut = stockOut::create([
                'stockIn_id' => $stockindata->id,
                'quantity' => $request['quantity_needed'],
            ]);
            $stockconsumer = consumed_stockOut::create([
                'stockIn_id' => $stockindata->id,
                'stockOut_id' => $stockOut->id,
                'quantity_stockIn' => $request['quantity'],
                'quantity_stockOut' => $request['quantity_needed']
            ]);
            $remeinder = $stockindata->quantity - $request['quantity_needed'];
            stockIn::where('slug', $request->product_name)->update(['quantity' => $remeinder, 'quantity_consumed' => $stockconsumer->quantity_stockOut]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
        return redirect()->back();
    }
    public function report()
    {
        $reports = consumed_stockOut::paginate(10);
        return view('stock_manager.report', compact('reports'));
    }

    public function profile()
    {
        return view('stock_manager.profile');
    }
    public function edit($id)
    {
        $categories = Category::all();
        $stock_edit = stockIn::where('slug', $id)->first();

        return view('stock_manager.stockin.edit', compact('stock_edit', 'categories'));
    }


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
