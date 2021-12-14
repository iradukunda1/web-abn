<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\HomeSection;
use App\Http\Resources\OrderProductsResource;
use App\Http\Resources\ProductImageResource;
use App\Http\Resources\ProductsResource;
use App\Product;

use Illuminate\Support\Facades\DB;
use jeremykenedy\LaravelRoles\Models\Role;

class AdminProductController extends Controller
{

    private function imagesUploader($image): string
    {
        $uploadedFileUrl = Cloudinary()->upload($image)->getSecurePath();
        return $uploadedFileUrl;
    }

    public function index(Request $request)
    {
        $products = Product::where("status", 1);
        if ($sort = $request->sort) {
            switch ($sort) {
                case "prod_id":
                    $products = $products->orderBy("id");
                    break;
                case  "prod_name":
                    $products = $products->orderBy("title");
                    break;
                default:
                    $products = $products->withCount("orderProducts")->orderByDesc("order_products_count");
            }
        }
        $products = $products->paginate(50);
        return view('admin.products.index',compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            "title" => "required",
            "price" => "required|numeric|lt:sale_price",
            "sale_price"=>"required|numeric",
            "quantity" => "required|numeric",
            "category" => "required",
            "description" => "required"
        ]);
        $product = Product::create([
            "title" => $request['title'],
            "price" => $request['price'],
            "sale_price"=>$request['sale_price'],
            "quantity" => $request['quantity'],
            "description" => $request['description'],
            "created_by" => auth()->user()->id,
            "tags" => count($request['tags']) == 0 ? null : json_encode($request['tags']),
        ]);
        // /* foreach ($request['category'] as $category) {
        //      DB::table("category_product")->insert(["category_id" => $category['id'], "product_id" => $product->id]);
        //  }*/
        DB::table("category_product")->insert(["category_id" => $request['category']['id'], "product_id" => $product->id]);

        return "Product Created Successfully!";
    }

    public function show(Product $product)
    {
        return new ProductsResource($product);
    }

    public function image($product)
    {
        $product = Product::where("slug", $product)->first();
        if ($product->images) {
            $images = $product->images;
        } else {
            $images = "[]";
        }
        return view("admin.products.image", compact('product', 'images'));
    }

    public function storeImages($product, Request $request)
    {
        $product = Product::where("id", $product)->first();
        $images = [];
        foreach ($request->all() as $request) {
            if (($request && $request['old'] = true) && ($request['path'] == $request['name'])) {
                array_push($images, $request['path']);
            } else {
                array_push($images, $this->imagesUploader($request['path']));
            }
        }
        $product->update(["images" => $images]);
        return $images;
    }


    public function edit(Product $product)
    {
        $category = $product->categories->first();
        return view("admin.products.edit", compact('product', 'category'));
    }

    public function getByCategories(Category $category)
    {
        return ProductImageResource::collection($category->products->sortByDesc('updated_at')->take(8));
    }


    public function update(Request $request, Product $product)
    {
        $request->validate([
            "title" => "required",
            "price" => "required|numeric|lt:sale_price",
            "sale_price"=>"required|numeric",
            "quantity" => "required|numeric",
            "category" => "required",
            "description" => "required"
        ]);
        $product->update([
            "title" => $request['title'],
            "price" => $request['price'],
            "sale_price"=>$request['sale_price'],
            "quantity" => $request['quantity'],
            "description" => $request['description'],
            "tags" => count($request['tags']) == 0 ? null : json_encode($request['tags']),
        ]);
        DB::table("category_product")->where("product_id", $product->id)->update(["category_id" => $request['category']['id']]);
        return "Product Updated Successfully!";
    }


    public function destroy(Product $product)
    {
        $product->update(["status" => 0]);
        return "Ok";
    }

    public function changeSlider(Request $request, $product)
    {
        $product = Product::where("id", $product)->first();
        $product->update(["home_slider" => $request->value]);
        return "Ok";
    }
}
