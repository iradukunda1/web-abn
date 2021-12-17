@extends('layouts.app')
@section('title', 'Checkout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="billing-card card">
            <div class="card-header">
                <h3 class="text-center">Billing Address</h3>
                <hr>
            </div>
            <div class="billing-body card-body">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <label for="firstname">First name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control input-sm" placeholder="First Name"/>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <label for="lastname">Last name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control input-sm" placeholder="Last Name"/>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <label for="tinnumber">Tin Number:</label>
                            <input type="text" name="tinnumber" id="tinnumber" class="form-control input-sm" placeholder="tin number"/>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <label for="phone">Phone number:</label>
                            <input type="text" name="phone" id="phone" class="form-control input-sm" placeholder="Mobile no"/>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="details">Details:</label>
                            <textarea class="form-control">
                                
                            </textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="form-group">
                            <label for="district">District:</label>
                            <input type="text" name="district" id="district" class="form-control input-sm" placeholder="district">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="form-group">
                            <label for="city">City:</label>
                            <input type="text" name="city" id="city" class="form-control input-sm" placeholder="city">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="form-group">
                            <label for="sector">Sector:</label>
                            <input type="text" name="sector" id="sector" class="form-control input-sm" placeholder="sector">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="col-md-12">
                    <button class="btn btn-primary pull-right">Place order</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection