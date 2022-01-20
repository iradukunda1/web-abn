@extends('layouts.manager')
@section('title','Add Stock')
@section('page_title', 'Edit stock out')
@section('content')
<div class="card">
    <div class="card-header" Edit Stock Out"</div>
        <vue-progress-bar></vue-progress-bar>
        <div class="card-body">
            <form action="{{ route('manager.stockOutStore') }}" method="POST" class="form-parsley" novalidate>
                @csrf

                <div class="row">
                    <div class="col col-md-4">
                        <div class="form-group">
                            <label for="Category">Category</label>
                            <select name="category_id" id="category_id" class="form-control mb-3  custom-select select2"
                                placeholder="Choose Category" required>
                                @foreach ($categories as $category )
                                <option {{ $stock_edit->stockin->category->id==$category->id ?'selected':'' }}value="{{
                                    $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('category'))
                            <span class="invalid feedback text-danger" role="alert">
                                <strong>{{ $errors->first('category') }}.</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col col-md-4">
                        <div class="form-group">
                            <label for="Product Name" class="">Product Name</label>
                            <select name="product_name" id="product_name" class="form-control  custom-select select2"
                                placeholder="Product Name" required aria-describedby="helpId">
                            </select>
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
                            <input type="number" name="price" id="price" class="form-control" placeholder="" required
                                readonly />
                            @if ($errors->has('price'))
                            <span class="invalid feedback text-danger" role="alert">
                                <strong>{{ $errors->first('price') }}.</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col col-md-4">
                        <div class="form-group">
                            <label for="Quantity" class="quantity">Quantity</label>
                            <input type="number" name="quantity" id="quantity" readonly class="form-control"
                                placeholder="" required aria-describedby="helpId">
                            @if ($errors->has('quantity'))
                            <span class="invalid feedback text-danger" role="alert">
                                <strong>{{ $errors->first('quantity') }}.</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col col-md-4">
                        <div class="form-group">
                            <label for="Quantity" class="quantity">Quantity Needed</label>
                            <input type="number" name="quantity_needed" id="product_needed" class="form-control"
                                placeholder="" required aria-describedby="helpId">
                            @if ($errors->has('quantity_needed'))
                            <span class="invalid feedback text-danger" role="alert">
                                <strong>{{ $errors->first('quantity_needed') }}.</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="col col-md-4 mt-4">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary  waves-effect waves-light">
                                Submit
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
@push('scripts')
<script src="{{ asset('manager/plugins/select2.min.js') }}"></script>
<script src="{{ asset('manager/plugins/jquery.forms-advanced.js') }}"></script>
<script>
    $.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $(document).ready(function () {
    $('#category_id').on('change',function(e) {
    var category_id = e.target.value;
    
    $.ajax({
    url:"{{ route('manager.stockSearch') }}",
    type:"POST",
    data: {
    category_id: category_id
    },
    success:function (data) {

if(data){
                            $('#product_name').empty();
                            $('#price').val('');
                            $('#quantity').val('');
                            
                            $('#product_name').append('<option hidden>Choose Product Name</option>');
                            $.each(data.stockIn,function(key, stock){
                                $('select[name="product_name"]').append('<option value="'+ stock.slug +'">' + stock.product_name+ '</option>');

                            });
                            }else{
                            $('#product_name').empty();
    }
    }
    })
    });
    });

    // product name
      $(document).ready(function () {
    $('#product_name').on('change',function(e) {
    var product_name = e.target.value;
    var empys="";
    
    $.ajax({
    url:"{{ route('manager.stockSearchProduct') }}",
    type:"POST",
    data: {
    product_name: product_name
    },
    success:function (data) {

if(data){
                            
                                
                           $("#price").val($("#price").val() + data.product.price);
                            $('#quantity').val($('#quantity').val()+data.product.quantity);
                           
                            }else{
                            $('#price').val($('#price').val()+empys);
                            $('#quantity').val($('#quantity').val()+empys);
    }
    }
    })
    });
    });
    // check for quantity
    $(document).ready(function(){
        $('#quantity_needed').on('change',function(e){
            var prod=e.target.value;
            console.log(prod);
            var product=$('#quantiy').val();

        });
    });

</script>

@endpush
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