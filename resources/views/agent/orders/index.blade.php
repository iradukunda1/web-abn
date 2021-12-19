@extends('layouts.admin')
@section('title','Agent | Order List')
@section('content')
    <div class="container" id="app">
        <vue-progress-bar></vue-progress-bar>
        <div class="row justify-content-center">
            <div class="col-md-12 px-0">
                <div class="card">
                    <div class="card-header">
                        <h5>List All Orders</h5>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-stripped" style="width: 100%">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Order_ID</th>
                                <th>Price</th>
                                <th>Items</th>
                                <th>Merchant_Address</th>
                                <th>Merchant_Names</th>
                                <th>Merchant_Phone</th>
                                <th>Done_At</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{$loop->iteration}}</td>

                                    <td>
                                        <a @click.prevent="showOrderProducts({{ $order }})" href="#"
                                           class="text-primary"
                                           data-toggle="tooltip" data-placement="top"
                                           title="Click To View Order Products">#{{$order->order_id}}</a>
                                    </td>
                                    <td>{{ number_format($order->price)}} Rwf</td>
                                    <td> {{$order->products->count()}}</td>
                                    <td>
                                            {{$order->merchant->sector}},{{$order->merchant->village}} {{$order->merchant->cell}}
                                    </td>
                                    <td>
                                               {{$order->merchant->first_name}} {{$order->merchant->last_name}}
                                    </td>
                                    <td>{{$order->merchant->phone_number}}</td>
                                    <td>{{$order->created_at->toDateString()}}</td>
                                    <td>
                                        @if($order->seen != 0)
                                            <span class="badge badge-success">Seen</span>
                                        @else
                                            <span class="badge badge-danger">Not Yet Seen</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade orders" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Order #@{{ order?order.order_id:'' }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <center v-if="order_products==null">
                            <img src="/img/loader.gif">
                        </center>
                        <div v-else class="row">
                            <div class="col-md-6">
                                <p><strong>Merchant Names:</strong> @{{order.merchant.first_name + " " + order.merchant.last_name}}</p>
                                <p><strong>Merchant Phone:</strong> @{{ order.merchant.phone_number }}</p>
                                <p><strong>Price:</strong> <span class="badge badge-primary">@{{ order.price }} Rwf</span>
                                </p>
                                <p><strong>Done At:</strong> @{{ order.created_at }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Province:</strong>@{{order.merchant.province }}</p>
                                <p><strong>District:</strong>@{{order.merchant.district }}</p>
                                <p><strong>Sector:</strong>@{{order.merchant.sector }}</p>
                                <p><strong>Village:</strong>@{{order.merchant.village }}</p>
                                <p><strong>Cell:</strong>@{{order.merchant.cell }}</p>
                            </div>
                            <hr>
                            <div class="col-sm-12 table-responsive">
                                <table class="table cart-table table-responsive-xs">
                                    <thead>
                                    <tr class="table-head">
                                        <th scope="col">Product</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Description</th>
                                    </tr>
                                    </thead>
                                    <tbody v-for="product in order_products">
                                    <tr>
                                        <td>
                                            <a class="image_link" :href="product.product_image">
                                                <img :src="product.product_image" class="product_image" alt="Image">
                                            </a>
                                            <a :href="'/item/'+product.slug">@{{ product.product }}</a>
                                        </td>
                                        <td>
                                            <h5>@{{ product.price}} Rwf</h5>
                                        </td>
                                        <td>
                                            <span v-if="product.tags.length !=0 ">Tags: <span v-for="tag in product.tags" class="badge badge-success ml-1">@{{tag}}</span></span>
                                            <br>
                                            <span>Qty: @{{ product.quantity }}</span>
                                        </td>
                                        <!-- <td>
                                            <form v-if="!product.delivered" method="post"
                                                  onsubmit="return confirm('Product Delivered?')"
                                                  :action="'/order/product/delivered/'+product.id">
                                                {{ method_field("PUT") }}
                                                @csrf
                                                <button type="submit" data-toggle="tooltip" data-placement="top"
                                                        title="Deliver A single product" href="#"
                                                        class="btn-icon btn-icon-only btn-pill btn btn-outline-success"
                                                ><i
                                                        class="feather icon-check btn-icon-wrapper"> </i></button>
                                            </form>
                                            <div v-else>
                                                <span v-if="product.delivered" class="badge badge-primary">Delivered At @{{ product.delivered_at }}</span>
                                                <br>
                                                <span v-if="product.received" class="badge badge-success">Received At @{{ product.received_at }}</span>
                                            </div>
                                        </td> -->
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push("scripts")
    <script src="/js/app.js" type="text/javascript"></script>
    @include("includes.datatable")
@endpush
