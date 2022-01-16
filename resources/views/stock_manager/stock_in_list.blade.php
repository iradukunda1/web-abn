@extends('layouts.manager')
@section('title','|Stock In')
@section('page_title','Stock In')
@section('content')
<div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
    
                                    <h4 class="mt-0 header-title">Edit Table With Button</h4>
                                    <p class="text-muted mb-3">Add toolbar column with edit and delete buttons.</p>
    
                                    <table class="table mb-0" id="my-table">
                                        <thead>
                                          <tr>
                                            <th>No</th>
                                            <th>Product Image</th>

                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ( $products as $product )
                                                
                                            
                                          <tr>
                                              <td>{{ $loop->iteration }}</td>
                                              <td><img src=" {{ $product->product_image[0] }}" /></td>
                                              <td>{{ $product->title }}</td>
                                              <td>{{ $product->price }}</td>
                                              <td>{{ $product->quantity }}
                                          </tr>
                                          @endforeach
                                        </tbody>
                                    </table><!--end table-->     
                                </div><!--end card-body-->
                            </div><!--end card-->
                        </div> <!-- end col -->
                    </div> <!-- end row -->


@endsection
@section('scripts')
 <script src="{{ asset('manager/plugins/jquery.tabledit.js') }}"></script> 
 <script src="{{ asset('manager/plugins/jquery.tabledit.init.js') }}"></script> 
@endsection