<?php

namespace App\Http\Controllers;

use App\Http\Resources\BussinessCategoryResource;
use App\BussinesCategory;
use Illuminate\Http\Request;

class BussinesCategoryController extends Controller
{
    public function getCategory()
    {
        return view("admin.categories.bussiness");
    }

    public function index()
    {
        return BussinessCategoryResource::collection(BussinesCategory::where("status", 1)->orderBy("name")->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required"
        ]);

        return new BussinessCategoryResource(BussinesCategory::create($request->all()));
    }

    public function update(Request $request, BussinesCategory $category)
    {
        $request->validate([
            "name" => "required"
        ]);
        $category->update($request->all());
        return new BussinessCategoryResource($category);
    }

    public function destroy(Category $category)
    {

        $category->update(["status" => 0]);
    }
}
