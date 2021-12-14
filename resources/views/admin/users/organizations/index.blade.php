@extends('layouts.admin')
@section('title', '| Organizations List')
@section('content')
<div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header row mx-0 w-100">
                        <h5>List All Organizations</h5>
                        <!-- <a href="/admin/organizations/create" class="btn btn-primary ml-auto">Create Organization</a> -->
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-stripped" style="width: 100%">
                            <thead>
                            <tr>
                                <th>Code</th>
                                <th>Names</th>
                                <th>District</th>
                                <th>Sector</th>
                                <th>Cell</th>
                                <th>Village</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Registed_by</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Joined_At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#253DFG</td>
                                    <td>
                                        <a href="#">
                                            Abn International
                                        </a>
                                    </td>
                                    <td>  Kicukiro </td>
                                    <td>  Kicukiro </td>
                                    <td>  Kagarama </td>
                                    <td>  Niboye </td>
                                    <td>  abn@gmail.com </td>
                                    <td>  078885637233  </td>
                                    <td> 07808457454 </td>
                                    <td>   association </td>
                                    <td>
                                        <span
                                            class="badge badge-primary">Active</span>
                                        <!-- <br>
                                        <span class="badge badge-success">Disactive</span> -->
                                     </td>
                                    <td> 2021-12-01 </td>
                                    <td> 
                                        <a href="#" class="btn-icon btn-icon-only btn-pill btn btn-outline-info"><i
                                            class="feather icon-edit btn-icon-wrapper"> </i>
                                        </a>
                                        <a href="#" class="btn-icon btn-icon-only btn-pill btn btn-outline-danger">
                                            <i class="feather icon-trash btn-icon-wrapper"> </i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection
@push("scripts")
    <script src="/js/app.js" type="text/javascript"></script>
    @include("includes.datatable")
@endpush