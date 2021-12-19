@extends('layouts.app')
@section('title', 'Products')
@push('style')
	<style>
		.product-list-container{
			padding:3em 15em;
		}
		@media screen and (max-width: 768px) {
			.product-list-container{
				padding:3em 1em;
			}
		}
	</style>
@endpush
@section('content')
<div class="section">
				<div class="row mx-0 w-100">					
					<div>
						<div class="row w-100 mx-0 product-list-container">
						@if($products->count()>0)	
							@foreach($products as $product)
								<div class="product-card col-md-4">
									<div class="product">
										<div class="product-img w-100" style="height:30em">
										<img src="{{ $product->product_image }}" class="w-100 h-100">
											<div class="product-label">
												<span class="new">{{$product->categories[0]->name}}</span>
											</div>
										</div>
										<div class="product-body">
											
											<h3 class="product-name">{{ str_limit($product->title,40) }}</h3>
											<h4 class="product-price">{{ number_format($product->sale_price) }} Rwf </h4>
											<div class="product-btns">
												<a href="/product-detail/{{$product->slug}}"><button class="add-to-cart-btn"><i class="fa fa-eye"></i>View details</button></a>
											</div>
										</div>
									</div>
								</div>
							@endforeach
						@else
							<div class="alert alert-info bg-danger">No Product Available</div>
						@endif	
						</div>
					</div>
				</div>
		</div>
@endsection