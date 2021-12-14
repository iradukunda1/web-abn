@extends('layouts.admin')
@section('title', 'Agent Dashboard | Edit Merchant')
@section('content')
    <div class="container" id="app">
        <vue-progress-bar></vue-progress-bar>
        <div class="row justify-content-center bg-white pt-4">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h5> Edit Merchant</h5>
                    </div>
                    <div class="card-body">
                         <app-edit-merchant :merchant="{{ $merchant }}" :category="{{ $category }}"></app-edit-merchant>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push("scripts")
    <script type="text/javascript" src="/js/app.js"></script>
@endpush
