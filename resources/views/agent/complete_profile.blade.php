@extends('layouts.admin')
@section('title', 'Agent | Profile')
@section('content')
    <div class="container" id="app">
        <vue-progress-bar></vue-progress-bar>
        <div class="row justify-content-center">
            <div class="col-md-10">
               @if(session("error_login"))
                    <div class="alert alert-danger tx-f12 mt-2">
                        {{ session("error_login") }}
                    </div>
                @endif
                @if(session("message"))
                    <div class="alert alert-success tx-f15 mt-2">
                        {{ session("message") }}
                    </div>
                @endif
                <app-complete-profile></app-complete-profile>
            </div>
        </div>
    </div>
@endsection
@push("scripts")
    <script type="text/javascript" src="/js/app.js"></script>
@endpush
