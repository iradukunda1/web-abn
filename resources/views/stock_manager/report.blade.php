@extends('layouts.manager')
@section('title','|Report')
@section('page_title','Report')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="mt-0 header-title">Report List</div>
            </div>

            <div class="card-body">
                @if ($reports->count()>0)



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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $reports as $report )


                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $report->stockIn->product_name }}</td>
                            <td>{{ $report->stockIn->price}}</td>
                            <td>{{ $report->stockIn->category->name }}</td>
                            <td>{{ $report->quantity_stockIn }}</td>
                            <td>{{ $report->quantity_stockOut }}</td>


                            <td>{{ $report->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="#" class="mr-2" id="editor-modal"><i
                                        class="fas fa-edit text-info font-16"></i></a>
                                <a href="#"><i class="fas fa-trash-alt text-danger font-16"></i></a>


                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!--end table-->
                <br>
                <div class="d-flex justify-content-end">
                    {!! $reports->appends($_GET)->links() !!}
                </div>
                @else
                <div class="alert alert-info">No Products Available</div>
                @endif

            </div>
            <!--end card-body-->
        </div>
        <!--end card-->
    </div> <!-- end col -->
</div>





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