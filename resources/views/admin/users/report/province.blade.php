@extends('layouts.admin')
@section('title', '| All Province Manager List')
@section('content')
    <div class="container" id="app">
        <vue-progress-bar></vue-progress-bar>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h5>Province Manager</h5>
                        <a href="{{ route('user.province.create') }}" class="btn btn-primary float-right">Create Province Manager</a>
                    </div>
                    <app-province></app-province>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    @include("includes.datatable")
    <script type="text/javascript" src="/js/app.js?update=true"></script>
@endpush
