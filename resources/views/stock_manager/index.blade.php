@extends('layouts.manager')
@section('title','| Stocke Manager')
@section('page_title','Dashboard')
@section('content')
<div class="row">
        <div class="col-lg-4">
                <div class="card card-eco">
                        <div class="card-body">
                                <h4 class="title-text mt-0">Total Requests</h4>
                                <div class="d-flex justify-content-between">
                                        <h3 class="font-weight-bold">{{ $total_request ?? '' }}</h3>
                                        <i class="dripicons-cart card-eco-icon text-black align-self-center"></i>
                                </div>
                                <p class="mb-0 text-muted text-truncate"><span class="text-success">{{ $d ?? ''}}
                                        </span>
                                        till Now</p>
                        </div>
                        <!--end card-body-->
                </div>
                <!--end card-->
        </div>
        <!--end col-->
        <div class="col-lg-4">
                <div class="card card-eco">
                        <div class="card-body">
                                <h4 class="title-text mt-0">Totol Products</h4>
                                <div class="d-flex justify-content-between">
                                        <h3 class="font-weight-bold">{{ $total_product ?? ''}}</h3>
                                        <i class="dripicons-tag card-eco-icon text-pink align-self-center"></i>
                                </div>
                                <p class="mb-0 text-muted text-truncate"><span class="text-success">{{ $latest_product
                                                ?? '' }}</span> till Now</p>
                        </div>
                        <!--end card-body-->
                </div>
                <!--end card-->
        </div>
        <!--end col-->
        <div class="col-lg-4">
                <div class="card card-eco">
                        <div class="card-body">
                                <h4 class="title-text mt-0">Stock In</h4>
                                <div class="d-flex justify-content-between">
                                        <h3 class="font-weight-bold">{{ $stockIn ?? '' }}</h3>
                                        <i class="dripicons-user-group card-eco-icon text-pink align-self-center"></i>
                                </div>
                                <p class="mb-0 text-muted text-truncate"><span class="text-success">
                                                {{ $latest_stockIn ?? '' }}</span> till Now</p>
                        </div>
                        <!--end card-body-->
                </div>
                <!--end card-->
        </div>
        <!--end col-->
        <div class="col-lg-4">
                <div class="card card-eco">
                        <div class="card-body">
                                <h4 class="title-text mt-0">Stock Out</h4>
                                <div class="d-flex justify-content-between">
                                        <h3 class="font-weight-bold">{{ $stockOut ?? '' }}</h3>
                                        <i class="dripicons-user-group card-eco-icon text-pink align-self-center"></i>
                                </div>
                                <p class="mb-0 text-muted text-truncate"><span class="text-success">

                                                {{ $latest_stockOut ?? ' ' }}</span> till Now</p>
                        </div>
                        <!--end card-body-->
                </div>
                <!--end card-->
        </div>
        <!--end col-->
</div>
@endsection