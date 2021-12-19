@extends('layouts.admin')
@section('title', '| All Agents List')
@section('content')
    <div class="container" id="app">
        <vue-progress-bar></vue-progress-bar>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <app-user :auth="{{$auth}}" role="agent"></app-user>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    @include("includes.datatable")
    <script type="text/javascript" src="/js/app.js?update=true"></script>
@endpush
