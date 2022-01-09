@extends('layouts.admin')
@section('title', '| All District Manager List')
@section('content')
    <div class="container" id="app">
        <vue-progress-bar></vue-progress-bar>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h5>District Manager</h5>
                        <a href="{{ route('user.district.create') }}" class="btn btn-primary float-right">Create District Manager</a>
                    </div>
                    <div class="card-body">
                         <app-district></app-district>
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
