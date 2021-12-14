@extends('layouts.app')
@section('title', 'Contact-Us')
@section('content')
<div class="container">
<div class="jumbotron jumbotron-sm">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <h1 class="h1"><small>Feel free to contact us</small></h1>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="well well-sm">
                <form method="POST" name="agent_help">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">User Name</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="user name" required="required" />
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required="required"/></div>
                                </div>
                                <div class="form-group">
                                    <label for="help_type">Help Subject?</label>
                                    <select id="help_type" name="help_type" class="form-control" required="required">
                                        <option value="na" selected="">Choose One:</option>
                                        <option value="General Customer Service">General Customer Service</option>
                                        <option value="suggestions">Suggestions</option>
                                        <option value="product support">Product Support</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Message</label>
                                    <textarea name="message" id="message" class="form-control" rows="9" cols="25" required="required" placeholder="Message"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary pull-right" id="btnContactUs" name="submit">
                                    Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <legend>
                    <span class="fa fa-home"></span> Our office
                </legend>
                <address>
                    <span class="fa fa-twitter"></span><strong>Twitter, Inc.</strong><br>
                    <span class="fa fa-location"></span>kk 318 st, kicukiro, Rwanda<br>
                    <span class="fa fa-phone"></span><abbr title="Phone"></abbr>(250) 788-789-230
                </address>
                <address>
                    <strong>ABN International</strong><br>
                    <a href="mailto:abninternational@gmail.com">abninternational@gmail.com</a>
                </address>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
