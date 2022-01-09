@extends('layouts.admin')
@section('title', '| Create Province Manager')
@section('content')

    <div class="container" id="app">
        <vue-progress-bar></vue-progress-bar>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h5>Create Province Manager</h5>
                        <a href="{{ route('user.province') }}" class="btn btn-primary float-right">View All Province Manager</a>
                    </div>
                    <div class="card-body">
                        <app-user-province></app-user-province>
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
