@extends('layouts.admin')
@section('title', ' Products | Categories List')
@section('content')
    <div class="container" id="app">
        <vue-progress-bar></vue-progress-bar>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <app-category></app-category>
            </div>
        </div>
    </div>
@endsection
@push("scripts")
    <script type="text/javascript" src="/js/app.js"></script>
@endpush
