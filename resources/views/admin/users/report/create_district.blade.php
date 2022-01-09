@extends('layouts.admin')
@section('title', '| Create District Manager')
@section('content')
    <div class="container" id="app">
        <vue-progress-bar></vue-progress-bar>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h5>Create Province Manager</h5>
                        <a href="{{ route('user.district') }}" class="btn btn-primary float-right">View All District Manager</a>
                    </div>
                    <div class="card-body">
                        <app-user-district></app-user-district>
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
