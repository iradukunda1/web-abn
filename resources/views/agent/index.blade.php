@extends('layouts.admin')
@section('title', 'Agent Dashboard | Home')
@section('content')
    
<div class="container">
        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="card prod-p-card card-yellow">
                    <div class="card-body">
                        <div class="row align-items-center m-b-30">
                            <div class="col">
                                <h6 class="m-b-5 text-white">Total Merchants</h6>
                                <h3 class="m-b-0 f-w-700 text-white">{{$total_merchants}}</h3>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user text-c-red f-18"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card prod-p-card card-success">
                    <div class="card-body">
                        <div class="row align-items-center m-b-30">
                            <div class="col">
                                <h6 class="m-b-5 text-white">Total Active Merchants</h6>
                                <h3 class="m-b-0 f-w-700 text-white">{{$active_merchants_count}}</h3>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users text-c-blue f-18"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card prod-p-card card-green">
                    <div class="card-body">
                        <div class="row align-items-center m-b-30">
                            <div class="col">
                                <h6 class="m-b-5 text-white">Products</h6>
                                <h3 class="m-b-0 f-w-700 text-white">{{$products_count}}</h3>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-object-group text-c-green f-18"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card prod-p-card card-danger">
                    <div class="card-body">
                        <div class="row align-items-center m-b-30">
                            <div class="col">
                                <h6 class="m-b-5 text-white">My Request</h6>
                                <h3 class="m-b-0 f-w-700 text-white">{{$orders_count}}</h3>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-cart-plus text-c-primary f-18"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
