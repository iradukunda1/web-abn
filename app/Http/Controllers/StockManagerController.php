<?php

namespace App\Http\Controllers;

use App\Category;
use App\consumed_stockOut;
use App\Order;
use Illuminate\Http\Request;
use App\User;
use App\Merchant;
use App\OrderedProduct;
use App\Product;
use App\stockIn;
use App\stockOut;
use Carbon\Carbon;
use Exception;
use jeremykenedy\LaravelRoles\Models\Role;
use Illuminate\Support\Str;
use PHPUnit\Util\Json;
use Illuminate\Validation\ValidationException;

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
        $total_request = OrderedProduct::all()->count();
        $d = Order::latest()->first()->created_at->diffForHumans();
        $latest_product = Product::latest()->first()->created_at->diffForHumans();

        $stockIn = stockIn::get()->count();
        $latest_stockIn = stockIn::latest()->first()->created_at->diffForHumans();
        $stockOut = stockOut::get()->count();
        $latest_stockOut = stockOut::latest()->first()->created_at->diffForHumans();

        $products_low = stockIn::where('quantity', '<=', 5)->get();

        return view('stock_manager.index', compact('stockOut', 'products_low', 'latest_stockOut', 'latest_stockIn', 'total_product', 'latest_product', 'total_request', 'd', 'stockIn'));
    }
    public function stockInList()
    {
        $products = stockIn::paginate(10);

        $products_low = stockIn::where('quantity', '<=', 5)->get();

        return view('stock_manager.stockin.stock_in_list', compact('products', 'products_low'));
    }
    public  function stockIn()
    {
        $low_quantity = stockIn::where('quantity', '<=', 5)->count();
        $products_low = stockIn::where('quantity', '<=', 5)->get();
        $categories = Category::all();
        return view('stock_manager.stockin.stock_in', compact('categories', 'low_quantity', 'products_low'));
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

            $erros =  json_encode($e->getMessage(), true);
            alert()->error('Invalid', 'Duplication of Product');
            return redirect()->back();
        }
        alert()->success('Product', 'Product Has been Saved succesfuly');


        return redirect()->back();
    }
    public function stockOut()
    {

        $products_low = stockIn::where('quantity', '<=', 5)->get();
        $categories = Category::all();
        return view('stock_manager.stockout.stock_out', compact('categories', 'products_low'));
    }
    public function stockOutList()
    {

        $products_low = stockIn::where('quantity', '<=', 5)->get();

        $stockOuts = stockOut::all();
        return view('stock_manager.stockout.stock_out_list', compact('stockOuts', 'products_low'));
    }
    public function edit_stockOut($id){
        $stock_edit=stockOut::where('id',$id)->first();
        $categories=Category::all();
        $products_low = stockIn::where('quantity', '<=', 5)->get();

        return view ('stock_manager.stockout.edit',compact('stock_edit','categories','products_low'));
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
            alert()->error('Invalid', "Invalid data");
            return redirect()->back();
        }
        alert()->success('Stock Out', 'Stock Out Has Been Done succesfuly');

        return redirect()->back();
    }
    public function report()
    {
        $products_low = stockIn::where('quantity', '<=', 5)->get();
        $reports = consumed_stockOut::paginate(10);
        return view('stock_manager.report', compact('reports',  'products_low'));
    }

    public function profile()
    {
        $products_low = stockIn::where('quantity', '<=', 5)->get();

        return view('stock_manager.profile',compact('products_low'));
    }
    public function edit($id)
    {
        $products_low = stockIn::where('quantity', '<=', 5)->get();
        $categories = Category::all();
        $stock_edit = stockIn::where('slug', $id)->first();

        return view('stock_manager.stockin.edit', compact('stock_edit', 'categories', 'products_low'));
    }


    public function update(Request $request, $id)
    {
        $data_update = $request->except('_token', '_method');
        stockIn::where('slug', $id)->update($data_update);
        alert()->success($data_update['product_name'], 'Product Have Been Update succesfuly');

        return redirect()->route('manager.stockInList');
    }
    public function AddQuantity($id)
    {
        $products_low = stockIn::where('quantity', '<=', 5)->get();
        $categories = Category::all();
        $stock_edit = stockIn::where('slug', $id)->first();
        return view('stock_manager.stockin.quantity_edit', compact('products_low', 'stock_edit', 'categories'));
    }
    public function update_quantity(Request $request, $id)
    {
        $new_quantity = $request->current_quantity + $request->new_quantity;

        stockIn::where('slug', $id)->update(['quantity' => $new_quantity]);
        alert()->success($request['product_name'], 'Quantity  Have Been Increased succesfuly');

        return redirect()->route('manager.stockInList');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stock = stockIn::where('slug', $id)->first();
        if (consumed_stockOut::where('stockIn_id', $stock->id)->exists()) {

            alert()->error('Invalid', 'Product has been used ');
            return redirect()->route('manager.stockInList');


        } else {

            $destroy=stockIn::where('slug',$id)->delete();
            alert()->info('Product', 'Product  Have Been Deleted succesfuly');


            return redirect()->route('manager.stockInList');
        }
    }
}
