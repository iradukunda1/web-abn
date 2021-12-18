@extends('layouts.Admin')
@section('title','Agent | Order List')
@section('content')
    <div class="container" id="app">
        <vue-progress-bar></vue-progress-bar>
        <div class="row justify-content-center">
            <div class="col-md-12">
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
                                <th>Customer</th>
                                <th>Done_At</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{$loop->iteration}}</td>

                                    <td>
{{--                                        <div--}}
{{--                                            style="display: none"> {{ $order->customer }}{{ $order->paymentMode }}{{ $order->deliveryFee }}{{ $order->province }}--}}
{{--                                            {{ $order->district }}{{ $order->sector }}{{ $order->cell }}{{ $order->village }}</div>--}}
                                        <a @click.prevent="showOrderProducts({{ $order }})" href="#"
                                           class="text-primary"
                                           data-toggle="tooltip" data-placement="top"
                                           title="Click To View Products">#{{ $order->order_id }}</a>
                                    </td>
                                    <td>{{ number_format($order->price) }}Rwf</td>
                                    <td> {{ $order->products->count() }}</td>
                                    <td>
                                        @if($order->customer)
                                            <a href="/chatbox/seller?customer={{ $order->customer_id }}" class="text-primary">
                                                @if($order->information)
                                                    {{ $order->information->name }}
                                                    <br> {{ $order->information->phone }}
                                                @else
                                                    {{ $order->customer->email }}
                                                    <br> {{ $order->customer->phone }}
                                                @endif
                                            </a>
                                        @endif
                                    </td>
{{--                                    <td>--}}
{{--                                        @foreach($order->sellers as $seller)--}}
{{--                                            {{ $seller->name }},--}}
{{--                                        @endforeach--}}
{{--                                    </td>--}}
                                    <td>
                                        @if($order->information)
                                            {{ $order->information->address }}
                                        @else
                                            <span class="text-danger">No address found</span>
                                        @endif
                                    </td>
                                    <td>{{$order->created_at->toDateString()}}</td>
                                    <td>
                                        @if(!$order->delivered)
                                            <form method="post" onsubmit="return confirm('Deliver the order?')"
                                                  action="/order/delivered/{{$order->id}}">
                                                {{ method_field("PUT") }}
                                                @csrf
                                                <button type="submit" data-toggle="tooltip" data-placement="top"
                                                        title="Deliver The Order" href="#"
                                                        class="btn-icon btn-icon-only btn-pill btn btn-outline-success"
                                                ><i
                                                        class="feather icon-check btn-icon-wrapper"> </i></button>
                                            </form>
                                        @else
                                            @if($order->delivered)
                                                <span
                                                    class="badge badge-primary">Delivered At {{ $order->delivered_at }}</span>
                                                <br>
                                            @endif
                                            @if($order->status)
                                                <span
                                                    class="badge badge-success">Received At {{ $order->received_at }}</span>
                                            @endif
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
                                <p><strong>Customer Name:</strong> @{{order.customer.name}}</p>
                                <p><strong>Customer Email:</strong> @{{ order.customer.email }}</p>
                                <p><strong>Customer Phone:</strong> @{{ order.customer.phone }}</p>
                                <p><strong>Payment Mode:</strong> @{{ order.payment_mode.name }}</p>
                                <p><strong>Price:</strong> <span class="badge badge-primary">@{{ order.price | currency("Rwf") }}</span>
                                </p>
                                <p><strong>Done At:</strong> @{{ order.created_at }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Shipping:</strong><span class="badge badge-primary">@{{ order.deliveryFee.title }}</span>
                                </p>
                                <p><strong>Address:</strong>@{{order.customer.address }}</p>
                                <p>
                                    <a :href="'/chatbox/seller?customer='+order.customer_id"> <span
                                            class="fa fa-comment"></span> Chat with customer</a>
                                </p>
                            </div>
                            <hr>
                            <div class="col-sm-12 table-responsive">
                                <table class="table cart-table table-responsive-xs">
                                    <thead>
                                    <tr class="table-head">
                                        <th scope="col">product</th>
                                        <th scope="col">price</th>
                                        <th scope="col">Seller</th>
                                        <th scope="col">description</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody v-for="product in order_products">
                                    <tr>
                                        <td>
                                            <a class="image_link" :href="product.product_image">
                                                <img :src="product.product_image" class="product_image" alt="Image">
{{--                                                <img src="/img/no-image.jpg" class="product_image" alt="Image">--}}
                                            </a>
                                            <a :href="'/item/'+product.slug">@{{ product.product }}</a>
                                        </td>
                                        <td>
                                            <h5>@{{ product.price | currency("Rwf") }}</h5>
                                        </td>
                                        <td>
                                            @{{ product.seller.email }}
                                        </td>
                                        <td>
                                            <span v-if="product.size">Size: @{{product.size}}</span>
                                            <br>
                                            <span>Qty: @{{ product.quantity }}</span>
                                        </td>
                                        <td>
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
                                        </td>
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
