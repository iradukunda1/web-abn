@extends('layouts.admin')
@section('title', 'Agent | Products-List')
@section('content')
    <div class="container" id="app">
        <vue-progress-bar></vue-progress-bar>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        List All Available Products
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                        <button class="btn btn-primary "
                            >Select Product To Make Request</button >
                        </div>
                        <app-products-list-card :products="{{$available_products}}" @product-details="showModal"></app-products-list>
                   </div>
                   @if($unavailable_products->count() < 0)
                        <div class="card-header font-weight-bold">
                            List All UnAvailable Products In Stock
                        </div>
                        <div class="card-body">
                            <app-products-list-card :products="{{$unavailable_products}}" @product-details="showModal"></app-products-list>
                    </div>
                   @endif
                </div>
            </div>
        </div>
        <div class="modal fade" id="productModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg animate-top" role="document">
                <div class="modal-content" style="max-height:95vh !important">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold" id="exampleModalLabel">
                            Product Details
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="overflow: auto !important;">
                        <center v-if="product==null">
                            <img src="/img/loader.gif">
                        </center>
                        <div v-else class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><b>Title:</b> @{{ product.title}} </p>
                                    <p><b>Price:</b> @{{ product.price}} Rwf </p>
                                    <p><b>Sale Price:</b> @{{ product.sale_price}} Rwf </p>
                                    <p><b>Maximum Quantity:</b> @{{ product.quantity}} </p>
                                </div>
                                <div class="col-md-6">
                                    <p><b>Category:</b> <span v-for="category in product.categories"
                                                              class="badge badge-primary ml-2">@{{ category.name}}</span>
                                    </p>
                                    <p v-if="product.tags && product.tags.length>0">
                                        <b>Tags:</b><span
                                            v-for="tag in product.tags"
                                            class="badge badge-success ml-2">@{{ tag }}</span>
                                    </p>
                                    <p><b>Created At:</b> @{{ product.created_at }} </p>
                                </div>

                                <div class="col-md-12" style="overflow: auto !important;">
                                    <b>Description: </b>
                                    <div v-html="product.description"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push("scripts")
    <script type="text/javascript" src="/js/app.js"></script>
@endpush
