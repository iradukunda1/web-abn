@extends('layouts.manager')
@section('title','Add Stock')
@section('page_title', 'Add stock')
@section('content')
<div class="card">
    <div class="card-header">Edit Stock</div>
    <vue-progress-bar></vue-progress-bar>
    <div class="card-body">
        <form action="{{ route('manager.stockIn.update',$stock_edit->slug) }}" method="post" class="form-parsley"
            novalidate>
            @method('PUT')
            @csrf

            <div class="row">
                <div class="col col-md-4">
                    <div class="form-group">
                        <input type="hidden" value="{{ $stock_edit->id }}" name="id">
                        <label for="Product Name" class="">Product Name</label>
                        <input type="text" name="product_name" id="" class="form-control" placeholder="" required
                            value="{{ $stock_edit->product_name }}">
                        @if ($errors->has('product_name'))
                        <span class="invalid feedback text-danger" role="alert">
                            <strong>{{ $errors->first('product_name') }}.</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-4">
                    <div class="form-group">
                        <label for="Price" class=" ">Price</label>
                        <input type="number" name="price" id="" class="form-control" placeholder="" required
                            value="{{ $stock_edit->price }}">
                        @if ($errors->has('price'))
                        <span class="invalid feedback text-danger" role="alert">
                            <strong>{{ $errors->first('price') }}.</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-4">
                    <div class="form-group">
                        <label for="Quantity" class=" ">Quantity</label>
                        <input type="number" name="quantity" id="" class="form-control" placeholder="" required
                            value="{{ $stock_edit->quantity }}">
                        @if ($errors->has('quantity'))
                        <span class="invalid feedback text-danger" role="alert">
                            <strong>{{ $errors->first('quantity') }}.</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-4">
                    <div class="form-group">
                        <label for="Category">Category</label>
                        <select name="category_id" id="{{ $stock_edit->category_id }}"
                            class="form-control custom-select select2 " placeholder="" required>

                            @foreach ($categories as $category )
                            <option {{ $category->id == $stock_edit->category_id ? 'selected' : '' }}
                                value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('category'))
                        <span class="invalid feedback text-danger" role="alert">
                            <strong>{{ $errors->first('category') }}.</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-8 mt-4">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary  waves-effect waves-light">
                            Update
                        </button>

                        <button type="reset" class="btn btn-danger waves-effect m-l-5">
                            Cancel
                        </button>
                    </div>
                </div>

        </form>
    </div>

</div>

</div>
@endsection
@section('scripts')
<script src="{{ asset('manager/plugins/parsley.min.js') }}"></script>
<script src="{{ asset('manager/plugins/jquery.validation.init.js') }}"></script>
<script src="{{ asset('manager/plugins/select2.min.js') }}"></script>

@endsection
@section('style')
<link href="{{ asset('manager/plugins/select2.min.css') }}" rel="stylesheet" type="text/css" />
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
    }
</style>
@endsection