@extends('layouts.app')
@section('title', 'Login')
@push("style")
    <style>
        .login-card {
            color:black;
            background: white;
            border-radius: 3rem;
            box-shadow: 7px 7px 30px 5px rgba(0,0,0,0.1);
            margin: 5rem auto;
            width:80%;
        }
        .login-btn{
            border: 1px solid orange;
            border-radius: 10px;
            background-color: #fff;   
            color: orange;
            width: 20%;         
        }
        .login-btn:hover{
            color: #fff;
            background-color: orange
        }
        .form-control{
            height: 34px !important;
            font-size: 1.5em !important;
        }
        .tx-f15{
            font-size: 1.5em !important;
        }
    </style>
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div class="login-card px-5 py-3">
            <div class="header">
                <h3 class="text-center font-weight-light my-4">Account Login</h3>
            </div>
            <div class="form-content">
            <form method="POST" action="{{ route('login') }}">
                        @csrf
                    <div class="form-group mb-3">
                        <label for="inputEmail" class="tx-f15">E-Mail Address</label>
                        <input class="form-control @error('email') is-invalid @enderror" name="email" id="email" type="email" placeholder="name@example.com" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                                    <span class="invalid-feedback tx-f12" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="inputPassword" class="tx-f15">Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="password" name="password" required autocomplete="current-password">
                        @error('password')
                                    <span class="invalid-feedback tx-f12" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    
                    <button class="btn btn-link align-items-center text-decoration-none login-btn tx-f15" name="login" type="submit">Login</button>
                </form>
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
            </div>
            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                @if (Route::has('password.request'))
                    <a class="small text-decoration-none tx-f15" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
            <div class="footer text-center py-3">
                <div class="small">
                    <a href="/user/register" class="tx-f15">Need an account? Sign up!</a>
                </div>
                <div class="small">
                    <a href="#" class="tx-f15">Back to Home</a>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
