@extends('layouts.admin')
@section('title', '| All User List')
@section('content')
    <div class="container" id="app">
        <vue-progress-bar></vue-progress-bar>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <app-user :auth="{{$auth}}" role="all"></app-user>
            </div>
        </div>
    </div>
@endsection
@push("scripts")
    <script type="text/javascript" src="/js/app.js"></script>
    @include("includes.datatable")
@endpush
