@extends('layouts.app')
@section('title', 'Product-detail')
@section('content')

<section>
    <div class="container">
        <div class="products-card card w-100 mx-0">
            <div class="container-fluid">
                <div class="product-wrapper row">
                    <div class="product-preview col-md-6">
                        <div class="preview-pic tab-content">
                            <div class="tab-pane active" id="pic-1"><img src="{{ $product->product_image }}" /></div>
                            @if($product->images && count(json_decode($product->images)) > 0)
                                @foreach(array_slice(json_decode($product->images),1, 100) as $image)
                                    <div class="tab-pane" id="pic-{{($loop->iteration) - 1}}"><img src="{{$image}}" /></div>
                                @endforeach
                            @endif
                        </div>
                        <ul class="preview-thumbnail nav nav-tabs">
                            <li class="active"><a data-target="#pic-1" data-toggle="tab"></a><img src="{{ $product->product_image }}" /></li>
                            @if($product->images && count(json_decode($product->images)) > 0)
                                @foreach(array_slice(json_decode($product->images),1, 100) as $image)
                                    <li class="cursor-pointer"><a data-target="#pic-{{($loop->iteration) - 1}}" data-toggle="tab"></a><img src="{{$image}}" /></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="product-details col-md-6">
                        <h3 class="product-title">{{$product->title}}</h3>
                        <h4 class="product-category py-3"><b>Category: </b>{{$product->categories[0]->name}}</h4>
                        <h4 class="product-category py-3"><b>Available Quantity: </b>{{$product->quantity}}</h4>
                        <div class="product-description fa-2x">Product Description: <br>
                            <p class="fa-2x text-justify">{!! $product->description !!}</p>
                    </div>
                    <div class="mb-4 fa-2x d-flex">
                                    <div class="product-size ml-0">
                                        @if($product->tags && json_decode($product->tags))
                                                <span>Tags </span> 
                                                @foreach(json_decode($product->tags) as $tag)
                                                    <span  class="cursor-pointer badge badge-primary">{{ $tag }}</span>
                                                @endforeach
                                        @endif
                                    </div>
                                </div>
                        <h4 class="price">Price:&nbsp;<span>{{ number_format($product->sale_price) }}Rfw</span></h4>
                        <div class="action">
                            <!-- <a href="#"><button class="add-to-cart btn btn-default" type="button">Buy Now</button></a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>

    @if($recommended_products->count()>0)
            <div class="feature-area single-product-responsive  mb-30px">
                <div class="mx-5">
                    <div class="section-title">
                        <h2 class="section-heading pl-4">{{$count_products}} Other Products In The Same
                            Category:</h2>
                    </div>
                    <div class="feature-slider-wrapper swiper-wrapper row mx-0 w-100">
                        @foreach($recommended_products as $recommended_product)
                        <div class="product-card col-md-4">
                            <div class="product">
                                <div class="product-img w-100" style="height:30em">
                                <img src="{{ $recommended_product->product_image }}" class="w-100 h-100">
                                    <div class="product-label">
                                        <span class="new">{{$recommended_product->categories[0]->name}}</span>
                                    </div>
                                </div>
                                <div class="product-body">
                                    
                                    <h3 class="product-name">{{ str_limit($recommended_product->title,40) }}</h3>
                                    <h4 class="product-price">{{ number_format($recommended_product->sale_price) }} Rwf </h4>
                                    <div class="product-btns">
                                        <a href="/product-detail/{{$recommended_product->slug}}"><button class="add-to-cart-btn"><i class="fa fa-eye"></i>View details</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                        {!!  $recommended_products->appends($_GET)->links() !!}
                </div>
            </div>
        @endif
</section>
@endsection