@extends('layouts.admin')
@section('title', '| District Requests')
@section('content')
<div class="row justify-content-center" id="app">
     <vue-progress-bar></vue-progress-bar>
     <div class="col-md-12">
                <div class="card">
                    <div class="card-header row mx-0 w-100">
                        <h5>List All Request In {{$province}} {{$district}} District</h5>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-stripped" style="width: 100%">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Order_ID</th>
                                <th>Price</th>
                                <th>Items</th>
                                <th>Customer_Names</th>
                                <th>Customer_Phone</th>
                                <th>Created_Date</th>
                                <th>Recieved</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order )
                                    <tr>
                                        <td>{{ $loop->iteration}}</td>
                                        <td>
                                            <a @click.prevent="showOrderProducts({{ $order }})" href="#"
                                            class="text-primary"
                                            data-toggle="tooltip" data-placement="top"
                                            title="Click To View Order Products">#{{$order->order_id}}</a>
                                        </td>
                                        <td>{{ number_format($order->price)}} Rwf</td>
                                        <td> {{$order->products->count()}}</td>
                                        <td>
                                                {{$order->customer->first_name}} {{$order->customer->last_name}}
                                        </td>
                                        <td>{{$order->customer->phone_number}}</td>
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
                        <div class="d-flex justify-content-end">
                                {!!  $orders->appends($_GET)->links() !!}
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
                                <p v-if="order.merchant_id"><strong>Names:</strong> @{{order.customer.first_name + " " + order.customer.last_name}}</p>
                                <!-- <p v-if="order.customer_id"><strong>Merchant Names:</strong> @{{order.customer.first_name + " " + order.customer.last_name}}</p> -->
                                <p><strong>Merchant Phone:</strong> @{{ order.customer.phone_number }}</p>
                                <p v-if="order.merchant_id"><strong>Merchant Tin:</strong> @{{ order.customer.tin_number }}</p>
                                <p><strong>Price:</strong> <span class="badge badge-primary">@{{ order.price }} Rwf</span>
                                </p>
                                <div class="agent-container" v-if="order.agent_id">
                                <h6 class="font-weight-bold pb-3 text-center fa-2x">Agent Details Info</h6>                                    
                                    <p><strong>Agent Name:</strong>@{{ order.agent.first_name + " " + order.agent.last_name}}</p>
                                    <p><strong>Agent Phone Number:</strong>@{{ order.agent.phone_number }}</p>
                                    <p><strong>Agent Email:</strong>@{{ order.agent.phone_number }}</p>
                                </div>
                            </div>
                            <div class="col-md-6" v-if="order.merchant_id">
                                <h6 class="font-weight-bold pb-3">Customer Address Information</h6>
                                <p><strong>Province:</strong>@{{order.customer.province }}</p>
                                <p><strong>District:</strong>@{{order.customer.district }}</p>
                                <p><strong>Sector:</strong>@{{order.customer.sector }}</p>
                                <p><strong>Village:</strong>@{{order.customer.village }}</p>
                                <p><strong>Cell:</strong>@{{order.customer.cell }}</p>
                            </div>
                            <hr>
                            <div class="col-sm-12 table-responsive">
                                <table class="table cart-table table-responsive-xs">
                                    <thead>
                                    <tr class="table-head">
                                        <th scope="col">Product</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody v-for="product in order_products">
                                    <tr>
                                        <td>
                                            <a class="image_link" :href="product.product_image">
                                                <img :src="product.product_image" class="product_image" alt="Image">
                                            </a>
                                            <a href="#">@{{ product.product }}</a>
                                        </td>
                                        <td>
                                            <h5>@{{ product.price}} Rwf</h5>
                                        </td>
                                        <td>
                                            <span v-if="product.tags.length !=0 ">Tags: <span v-for="tag in product.tags" class="badge badge-success ml-1">@{{tag}}</span></span>
                                            <br>
                                            <span>Qty: @{{ product.quantity }}</span>
                                        </td>
                                        <td>
                                                <button  v-if="order.seen"
                                                        class="btn-icon btn-icon-only btn-pill btn btn-outline-success"
                                                ><i
                                                        class="feather icon-check btn-icon-wrapper"> </i></button>
                                                <button  v-if="!order.seen"
                                                        class="btn-icon btn-icon-only btn-pill btn btn-outline-danger"
                                                ><i
                                                        class="feather icon-check btn-icon-wrapper"> </i></button>
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

