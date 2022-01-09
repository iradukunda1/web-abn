@extends('layouts.admin')
@section('title', '| Province Agents')
@section('content')
<div class="row justify-content-center">
     <div class="col-md-12">
                <div class="card">
                    <div class="card-header row mx-0 w-100">
                        <h5>List All Of Agents In {{$province}} Province</h5>
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
                                @foreach ($agents as $agent )
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $agent->user->first_name . "  " . $agent->user->last_name }}</td>
                                    <td>{{ $agent->user->email }}</td>
                                    <td>{{ $agent->user->phone_number }}</td>
                                    <td>{{ $agent->user->country .", ".$agent->province . "," . $agent->district. "." .$agent->sector }}
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                                {!!  $agents->appends($_GET)->links() !!}
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

