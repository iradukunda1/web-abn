@extends('layouts.admin')
@section('title', '| Province District Managers')
@section('content')
<div class="row justify-content-center">
     <div class="col-md-12">
                <div class="card">
                    <div class="card-header row mx-0 w-100">
                        <h5>List All Of District Managers In {{$province}} Province</h5>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-stripped" style="width: 100%">
                            <thead>
                            <tr>
                                <th>Index</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Address</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($district_managers as $mananger )
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-capitalize">{{ $mananger->user->first_name . "  " . $mananger->user->last_name }}</td>
                                    <td>{{ $mananger->user->email }}</td>
                                    <td>{{ $mananger->user->phone_number }}</td>
                                    <td class="text-capitalize">{{ $mananger->user->country .", ".$mananger->province . " ," . $mananger->district}}
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                                {!!  $district_managers->appends($_GET)->links() !!}
                        </div>
                    </div>
                </div>
            </div>
</div>
@endsection
@push("scripts")
    <script src="/js/app.js" type="text/javascript"></script>
    @include("includes.datatable")
@endpush

