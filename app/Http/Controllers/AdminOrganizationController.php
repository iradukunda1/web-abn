<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminOrganizationController extends Controller
{

    public function index()
    {
        return view('admin.users.organizations.index');
    }

    public function create()
    {
        return view('admin.users.organizations.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }
   
    public function update(Request $request, $id)
    {
        //
    }
  
    public function destroy($id)
    {
        //
    }
}
