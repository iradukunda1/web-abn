@extends('layouts.admin')
@section('title', 'Admin | Home')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-md-6">
                <div class="card prod-p-card card-success">
                    <div class="card-body">
                        <div class="row align-items-center m-b-30">
                            <div class="col">
                                <h6 class="m-b-5 text-white">Total User</h6>
                                <h3 class="m-b-0 f-w-700 text-white">{{$total_user}}</h3>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user text-c-red f-18"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card prod-p-card card-blue">
                    <div class="card-body">
                        <div class="row align-items-center m-b-30">
                            <div class="col">
                                <h6 class="m-b-5 text-white">Total Agent</h6>
                                <h3 class="m-b-0 f-w-700 text-white">{{$total_agent}}</h3>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users text-c-blue f-18"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card prod-p-card card-red">
                    <div class="card-body">
                        <div class="row align-items-center m-b-30">
                            <div class="col">
                                <h6 class="m-b-5 text-white">Total Unverified Agent</h6>
                                <h3 class="m-b-0 f-w-700 text-white">{{$total_unverified_agents}}</h3>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users text-c-green f-18"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card prod-p-card card-yellow">
                    <div class="card-body">
                        <div class="row align-items-center m-b-30">
                            <div class="col">
                                <h6 class="m-b-5 text-white">Total Products</h6>
                                <h3 class="m-b-0 f-w-700 text-white">{{$products_count}}</h3>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-tags text-c-yellow f-18"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card prod-p-card" style="background-color: #8e44ad!important;">
                    <div class="card-body">
                        <div class="row align-items-center m-b-30">
                            <div class="col">
                                <h6 class="m-b-5 text-white">Total Merchants</h6>
                                <h5 class="m-b-0 f-w-700 text-white">{{$total_merchants}}</h5>
                            </div>
                            <div class="col-auto">
                                <i style="color:  #8e44ad!important;" class="fas fa-users f-18"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card prod-p-card card-info">
                    <div class="card-body">
                        <div class="row align-items-center m-b-30">
                            <div class="col">
                                <h6 class="m-b-5 text-white">Total Requests</h6>
                                <h4 class="m-b-0 f-w-700 text-white">{{$total_request}}</h4>
                            </div>
                            <div class="col-auto">
                                <i style="color: #00bcd4 !important;" class="fas fa-cart-arrow-down f-18"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5>Income Statistics</h5></div>
            <div class="card-body">
                <div class="col-md-12" style="overflow: auto">
                </div>
                <div class="col-md-12" style="overflow: auto">
                </div>
            </div>
        </div> 
    </div>
@endsection
@push("scripts")
    <script src="/js/echarts-en.min.js" type="text/javascript"></script>
@endpush
