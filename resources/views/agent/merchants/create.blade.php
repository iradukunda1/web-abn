@extends('layouts.admin')
@section('title', 'Agent Dashboard | Register Merchant')
@section('content')
    <div class="container" id="app">
        <vue-progress-bar></vue-progress-bar>
        <div class="row justify-content-center bg-white pt-4">
            <div class="col-md-10">
                <app-create-merchant></app-create-merchant>
            </div>
        </div>
    </div>
@endsection
@push("scripts")
    <script type="text/javascript" src="/js/app.js"></script>
@endpush
