<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Merchant;
use Illuminate\Http\Request;
use App\Http\Resources\MerchantResource;

class MerchentsControllerManagement extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth = auth()->user()->id;
        return MerchantResource::collection(Merchant::where("registered_by", $auth)->where("active",1)->orderBy("bussiness_name")->get());
    }

    public function admin()
    {
        view('admin.users.organizations.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agent.merchants.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string'],
            'bussiness_name'=>'required',
            'tin_number'=>'required|max:10',
            "district"=>'required',
            "province"=>'required',
            'cell'=>'required',
            'sector'=>'required',
            'description'=>'required',
            'category'=>'required',
            'village'=>'required',
            'phone_number' => 'required|regex:/^(07[8,2,3,9])[0-9]{7}$/|unique:merchants',
        ]);
        $merchant = Merchant::create([
            "first_name" => $request['first_name'],
            "last_name" => $request['last_name'],
            "country"=>$request['country'],
            "bussiness_name" => $request['bussiness_name'],
            "tin_number" => $request['tin_number'],
            "district" => $request['district'],
            "province" => $request['province'],
            "cell" => $request['cell'],
            "sector" => $request['sector'],
            "village" => $request['village'],
            "description" => $request['description'],
            "phone_number" => $request['phone_number'],
            "registered_by" => auth()->user()->id,
            "password" => Hash::make('merchant'),
            "bussiness_category_id"=> $request['category']['id'],
        ]);

        return "Merchant Created Successfully!";
    }
   
    public function show(Merchant $merchant)
    {
        return new MerchantResource($merchant);
    }

    public function edit(Merchant $merchant)
    {
        $category = $merchant->category;
        return view("agent.merchants.edit", compact('merchant', 'category'));
    }

    public function update(Request $request, Merchant $merchant)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string'],
            'bussiness_name'=>'required',
            'tin_number'=>'required|max:10',
            "district"=>'required',
            "province"=>'required',
            'cell'=>'required',
            'sector'=>'required',
            'description'=>'required',
            'category'=>'required',
            'village'=>'required',
        ]);

        $merchant->update([
            "first_name" => $request['first_name'],
            "last_name" => $request['last_name'],
            "country"=>$request['country'],
            "bussiness_name" => $request['bussiness_name'],
            "tin_number" => $request['tin_number'],
            "district" => $request['district'],
            "province" => $request['province'],
            "cell" => $request['cell'],
            "sector" => $request['sector'],
            "village" => $request['village'],
            "description" => $request['description'],
            "bussiness_category_id"=> $request['category']['id'],
        ]);

        return "Merchant Updated Succeffully";
    }

    public function destroy(Merchant $merchant)
    {
        $merchant->update(["active" => 0]);
        return "Ok";
    }
}
