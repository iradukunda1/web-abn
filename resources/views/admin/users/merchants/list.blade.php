@extends('layouts.admin')
@section('title', 'Admin | Merchants List')
@section('content')
<div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header row mx-0 w-100">
                        <h5>List All Merchants</h5>
                        <!-- <a href="/admin/organizations/create" class="btn btn-primary ml-auto">Create Organization</a> -->
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-stripped" style="width: 100%">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>Bussiness_Name</th>
                                <th>Merchant_Phone</th>
                                <th>Province</th>
                                <th>District</th>
                                <th>Sector</th>
                                <th>Cell</th>
                                <th>Village</th>
                                <th>Agent_Phone</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Joined_At</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($merchants as $merchant)
                                <tr>
                                    <td>{{$merchant->id}}</td>
                                    <td>
                                        <a href="#">
                                            {{$merchant->bussiness_name}}
                                        </a>
                                    </td>
                                    <td>   {{$merchant->phone_number}} </td>
                                    <td>  {{$merchant->province}} </td>
                                    <td>  {{$merchant->district}} </td>
                                    <td>  {{$merchant->sector}} </td>
                                    <td>  {{$merchant->cell}} </td>
                                    <td>  {{$merchant->village}} </td>
                                    <td>  {{ $merchant->agent->phone_number }}  </td>
                                    <td>  {{$merchant->category->name}}  </td>
                                    <td>
                                        @if($merchant->active ==1)
                                        <span
                                            class="badge badge-primary">Active</span>
                                        @else
                                        <span class="badge badge-success">Disactive</span>
                                        @endif
                                     </td>
                                    <td> {{$merchant->created_at->toDateString()}} </td>
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