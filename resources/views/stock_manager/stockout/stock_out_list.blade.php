@extends('layouts.manager')
@section('title','|List Stock Out')
@section('page_title','List Stock Out')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="mt-0 header-title">List of Stock out</h4>

                <table class="table mb-0" id="#editor">
                    <thead>
                        <tr>
                            <th>No</th>

                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Quantity</th>

                            <th>Quantinty Consumed</th>
                            <th>Date</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $stockOuts as $stockout )


                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $stockout->stockIn->product_name}}</td>
                            <td>{{ $stockout->stockIn->price }}</td>
                            <td>{{ $stockout->stockIn->category->name }}</td>
                            <td>{{ $stockout->stockIn->quantity }}</td>

                            <td>{{ $stockout->quantity }}</td>
                            <td>{{ $stockout->created_at->format('d/m/Y') }}</td>
                            {{-- <td>
                                <a href="{{ route('manager.stockOut.edit',$stockout->id) }}" class="mr-2"
                                    id="editor-modal"><i class="fas fa-edit text-info font-16"></i></a>
                                {{-- <a href="#"><i class="fas fa-trash-alt text-danger font-16"></i></a> --}}


                            </td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!--end table-->

            </div>
            <!--end card-body-->
        </div>
        <!--end card-->
    </div> <!-- end col -->
</div> <!-- end row -->




<!--Editor-->
<div class="modal fade" id="editor-modal" tabindex="-1" role="dialog" aria-labelledby="editor-title">

    <div class="modal-dialog" role="document">
        <form class="modal-content form-horizontal" id="editor">
            <div class="modal-header">
                <h5 class="modal-title" id="editor-title">Add Row</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">

                <div class="form-group required row">
                    <label for="firstName" class="col-sm-3 control-label">First Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name"
                            required>
                    </div>
                </div>
                <div class="form-group require row">
                    <label for="lastName" class="col-sm-3 control-label">Last Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name"
                            required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jobTitle" class="col-sm-3 control-label">Job Title</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="jobTitle" name="jobTitle" placeholder="Job Title">
                    </div>
                </div>
                <div class="form-group required row">
                    <label for="startedOn" class="col-sm-3 control-label">Started On</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="startedOn" name="startedOn" placeholder="Started On"
                            required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="dob" class="col-sm-3 control-label">Date of Birth</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="dob" name="dob" placeholder="Date of Birth">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-gradient-primary">Save changes</button>
                <button type="button" class="btn btn-gradient-danger" data-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>
<!--end modal-->
</div>
<!--end card-body-->
</div>
<!--end card-->


@endsection
@push('scripts')

<script src="{{ asset('manager/plugins/footable.js') }}"></script>

@endpush