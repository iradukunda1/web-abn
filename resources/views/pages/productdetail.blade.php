@extends('layouts.app')
@section('title', 'Productdetail')


@section('content')

<section>
    <div class="container">
        <div class="products-card card">
            <div class="container-fluid">
                <div class="product-wrapper row">
                    <div class="product-preview col-md-6">
                        <div class="preview-pic tab-content">
                            <div class="tab-pane active" id="pic-1"><img src="https://media.istockphoto.com/photos/personal-safety-workwear-and-construction-blueprint-shot-directly-picture-id470172604?b=1&k=20&m=470172604&s=170667a&w=0&h=X7Yk9E_OM0zGEDuAYjtzDGJQe2ur-KR2EPEzJA12uAI=" /></div>
                            <div class="tab-pane" id="pic-2"><img src="https://media.istockphoto.com/photos/personal-safety-workwear-and-construction-blueprint-shot-directly-picture-id470172604?b=1&k=20&m=470172604&s=170667a&w=0&h=X7Yk9E_OM0zGEDuAYjtzDGJQe2ur-KR2EPEzJA12uAI=" /></div>
                            <div class="tab-pane" id="pic-3"><img src="https://media.istockphoto.com/photos/personal-safety-workwear-and-construction-blueprint-shot-directly-picture-id470172604?b=1&k=20&m=470172604&s=170667a&w=0&h=X7Yk9E_OM0zGEDuAYjtzDGJQe2ur-KR2EPEzJA12uAI=" /></div>
                            <div class="tab-pane" id="pic-4"><img src="https://media.istockphoto.com/photos/personal-safety-workwear-and-construction-blueprint-shot-directly-picture-id470172604?b=1&k=20&m=470172604&s=170667a&w=0&h=X7Yk9E_OM0zGEDuAYjtzDGJQe2ur-KR2EPEzJA12uAI=" /></div>
                        </div>
                        <ul class="preview-thumbnail nav nav-tabs">
                            <li class="active"><a data-target="#pic-1" data-toggle="tab"></a><img src="https://media.istockphoto.com/photos/personal-safety-workwear-and-construction-blueprint-shot-directly-picture-id470172604?b=1&k=20&m=470172604&s=170667a&w=0&h=X7Yk9E_OM0zGEDuAYjtzDGJQe2ur-KR2EPEzJA12uAI=" /></li>
                            <li><a data-target="#pic-2" data-toggle="tab"></a><img src="https://media.istockphoto.com/photos/personal-safety-workwear-and-construction-blueprint-shot-directly-picture-id470172604?b=1&k=20&m=470172604&s=170667a&w=0&h=X7Yk9E_OM0zGEDuAYjtzDGJQe2ur-KR2EPEzJA12uAI=" /></li>
                            <li><a data-target="#pic-3" data-toggle="tab"></a><img src="https://media.istockphoto.com/photos/personal-safety-workwear-and-construction-blueprint-shot-directly-picture-id470172604?b=1&k=20&m=470172604&s=170667a&w=0&h=X7Yk9E_OM0zGEDuAYjtzDGJQe2ur-KR2EPEzJA12uAI=" /></li>
                            <li><a data-target="#pic-4" data-toggle="tab"></a><img src="https://media.istockphoto.com/photos/personal-safety-workwear-and-construction-blueprint-shot-directly-picture-id470172604?b=1&k=20&m=470172604&s=170667a&w=0&h=X7Yk9E_OM0zGEDuAYjtzDGJQe2ur-KR2EPEzJA12uAI=" /></li>
                        </ul>
                    </div>
                    <div class="product-details col-md-6">
                        <h3 class="product-title">{{$product->title}}</h3>
                        <h4 class="product-category">{{$product->categories[0]->name}}</h4>
                        <p class="product-description">Product details</p>
                        <h4 class="price">current price:&nbsp;<span>{{ number_format($product->sale_price) }}</span></h4>
                        <div class="action">
                            <a href="/checkout"><button class="add-to-cart btn btn-default" type="button">Buy Now</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection