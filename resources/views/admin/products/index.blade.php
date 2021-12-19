@extends('layouts.admin')
@section('title', '| Products-List')
@section('content')
    <div class="container" id="app">
        <vue-progress-bar></vue-progress-bar>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        List All Products
                        <form action="" method="get">
                            <div class="form-row justify-content-end">
                                <div class="form-group col-md-3">
                                    <label for="sort">Sort By</label>
                                    <select name="sort" id="sort" class="form-control">
                                    <option value="prod_id" {{ request("sort")=="prod_id"?'selected':'' }}>Product
                                            ID
                                        </option>
                                        <option value="prod_name" {{ request("sort")=="prod_name"?'selected':'' }}>
                                            Product Name
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>&nbsp;</label>
                                    <br>
                                    <div class="d-flex justify-content-around">
                                        <input type="submit" class="btn btn-primary btn-sm btn-block" value="FILTER"
                                               style="width: fit-content"/>
                                        <a href="/admin/products/create" class="btn btn-primary float-right">Create product</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body table-responsive">
                    @if($products->count()>0)
                            <table class="table table-stripped" style="width: 100%">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th>Sale_Price</th>
                                    <th>Profit</th>
                                    <th>Seller_Email</th>
                                    <th>Quantity</th>
                                    <th>Category</th>
                                    <th>Created At</th>
                                    <th>Modify</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td data-toggle="tooltip" data-placement="top" title=" {{ $product->title }}">
                                            <a href="{{ $product->product_image }}" class="image_link" target="_blank">
                                                <img src="{{ $product->product_image }}" alt="" class="product_image">
                                            </a>
                                            <a href="#" class="text-primary"
                                               @click.prevent="showModal({{$product->id}})">{{ str_limit($product->title,10) }}</a>
                                        </td>
                                        <td>{{ number_format($product->price) }}
                                            Rwf </td>
                                        <td>{{ number_format($product->sale_price) }}
                                            Rwf </td>
                                        <td>{{ number_format($product->sale_price - $product->price) }}
                                            Rwf </td>
                                        <td> {{ $product->creator->email }}</td>
                                        <td>{{$product->quantity}}</td>
                                        <td>
                                            {{$product->categories[0]->name}}
                                        </td>
                                        <td>{{$product->created_at->toDateString()}}</td>
                                        <td>
                                        <a href="/admin/product/images/{{ $product->slug}}"
                                               data-toggle="tooltip"
                                               data-placement="top" title="Product Images"
                                               class="btn-icon btn-icon-only btn-pill btn btn-outline-success"
                                            ><i class="feather icon-image btn-icon-wrapper"> </i></a>
                                            <a href="/admin/products/{{$product->id}}/edit"
                                               data-toggle="tooltip"
                                               data-placement="top" title="Edit Product"
                                               class="btn-icon btn-icon-only btn-pill btn btn-outline-info"
                                            ><i class="feather icon-edit btn-icon-wrapper"> </i></a>
                                            <a href="#" class="btn-icon btn-icon-only btn-pill btn btn-outline-danger"
                                               data-toggle="tooltip"
                                               data-placement="top" title="Delete Product"
                                               @click="deleteProduct({{ $product}})"><i class="feather icon-trash btn-icon-wrapper"> </i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end">
                                {!!  $products->appends($_GET)->links() !!}
                            </div>
                        @else
                            <div class="alert alert-info">No Products Available</div>
                        @endif
                    </div>
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
