@extends('layouts.admin')
@section('title', '| Province Merchants')
@section('content')
<div class="row justify-content-center">
     <div class="col-md-12">
                <div class="card">
                    <div class="card-header row mx-0 w-100">
                        <h5>List All Province </h5>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-stripped" style="width: 100%">
                            <thead>
                            <tr>
                                <th>Index</th>
                                <th>TIN_Number</th>
                                <th>Bussiness_Name</th>
                                <th>Name</th>
                                <th>Phone_Number</th>
                                <th>Merchant_Address</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($merchants as $merchant )
                                <tr>
                                    <td>{{ $loop->iteration}}</td>
                                    <td>{{ $merchant->tin_number }}</td>
                                    <td>{{ $merchant->bussiness_name }}</td>
                                    <td>{{ $merchant->first_name. " ".$merchant->last_name }}</td>
                                    <td>{{ $merchant->phone_number}}</td>
                                    <td class="text-capitalize">{{ $merchant->country ." , ".$merchant->province." , ". $merchant->district. " , ". $merchant->sector }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                                {!!  $merchants->appends($_GET)->links() !!}
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
