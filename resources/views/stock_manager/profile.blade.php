@extends('layouts.manager')
@section('title','Profile')
@section('page_title', 'User Profile')
@section('content')
<div id="app">
    <vue-progress-bar></vue-progress-bar>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <app-user-profile></app-user-profile>
        </div>
    </div>
</div>
@endsection
@push('script')
<script type="text/javascript" src="/js/app.js?update=true"></script>
<script src="{{ asset('js/app.js') }}" defer></script>
@endpush
@section('style')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection