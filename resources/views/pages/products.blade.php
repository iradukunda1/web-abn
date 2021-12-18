@extends('layouts.app')
@section('title', 'Products')
@section('content')
<div class="section">
				<div class="row mx-0 w-100">
					
					<div id="store" >
						<div class="row w-100 mx-0 justify-content-around">
						@if($products->count()>0)	
						@foreach($products as $product)
							<div class="product-card w-25">
								<div class="product">
									<div class="product-img">
									<img src="https://media.istockphoto.com/photos/personal-safety-workwear-and-construction-blueprint-shot-directly-picture-id470172604?b=1&k=20&m=470172604&s=170667a&w=0&h=X7Yk9E_OM0zGEDuAYjtzDGJQe2ur-KR2EPEzJA12uAI=">
										<div class="product-label">
											<span class="sale">-30%</span>
											<span class="new">NEW</span>
										</div>
									</div>
									<div class="product-body">
										
										<h3 class="product-name"><a href="#">{{ str_limit($product->title,10) }}</a></h3>
										<p class="product-category">{{$product->categories[0]->name}}</p>
										<h4 class="product-price">{{ number_format($product->sale_price) }} Rwf </h4>
										<div class="product-rating">
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</div>
										<div class="product-btns">
											<a href="/productdetail/{{$product->id}}"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>View details</button></a>
										</div>
									</div>
								</div>
							</div>
							@endforeach
							@else
							<div class="alert alert-info">No Product Available</div>
							@endif	
								
							<!-- <div class="product-card w-25">
								<div class="product">
									<div class="product-img">
									<img src="https://media.istockphoto.com/photos/personal-safety-workwear-and-construction-blueprint-shot-directly-picture-id470172604?b=1&k=20&m=470172604&s=170667a&w=0&h=X7Yk9E_OM0zGEDuAYjtzDGJQe2ur-KR2EPEzJA12uAI=">
										<div class="product-label">
											<span class="sale">-30%</span>
											<span class="new">NEW</span>
										</div>
									</div>
									<div class="product-body">
										<p class="product-category">Construction</p>
										<h3 class="product-name"><a href="#">Tool Kit</a></h3>
										<h4 class="product-price">2000 &nbsp;RWF</h4>
										<div class="product-rating">
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</div>
										<div class="product-btns">
											<a href="/productdetail"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>View details</button></a>
										</div>
									</div>
								</div>
							</div>							 -->
						</div>
						<!-- <div class="store-filter clearfix">
							<span class="store-qty">Showing 20-100 products</span>
							<ul class="store-pagination">
								<li class="active">1</li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">4</a></li>
								<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
							</ul>
						</div> -->
					</div>
				</div>
		</div>

@endsection