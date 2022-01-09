@extends('layouts.admin')
@section('title', 'District Dashboard | Home')
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
                                <h6 class="m-b-5 text-white">Total Agent</h6>
                                <h3 class="m-b-0 f-w-700 text-white">{{$total_agents}}</h3>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users text-c-blue f-18"></i>
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
                                <h6 class="m-b-5 text-white">Total Request In {{$district}} District</h6>
                                <h3 class="m-b-0 f-w-700 text-white">{{$total_requests}}</h3>
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
