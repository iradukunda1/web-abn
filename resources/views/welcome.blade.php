@extends('layouts.app')
@section('title', 'Welcome')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
        </div>

    </div>
    <h2 style="text-align: center;font: size 14px;">Agent Services</h2>
    <div class="row justify-content-center">
        
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="our-services-wrapper mb-60">
                <div class="services-inner">
                    <div class="our-services-img">
                    <i class="fas fa-calendar-week"></i>
                    </div>
                    <div class="our-services-text">
                        <h4>Advertisment & Event Plan</h4>
                        <p>An agent provide advertisment offers where help in making an advertisment to the Person who needs that service<br/>
                         then help you in creation of it by providing with you more detailed information on how to do it.</p> 
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="our-services-wrapper mb-60">
                <div class="services-inner">
                    <div class="our-services-img">
                        <i class="fa fa-user-plus"></i>
                    </div>
                    <div class="our-services-text">
                        <h4>Registration Services</h4>
                        <p>Here an Agent performs registration services where he/she makes registration of companies that needs to coorparate with ABN in order to join effort in increasing their daily business process</p>
                        <p>Not only business even organizations that needs partnership with ABN, an agent helps them in providing detailed information.</p>  
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="our-services-wrapper mb-60">
                <div class="services-inner">
                    <div class="our-services-img">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="our-services-text">
                        <h4>Buy & Sell</h4>
                        <p>In this section, an agent can make order of product that a customer needs and even may help him to deliver that product. <br/>
                        therefore within a product or a service an agent makes there is an agreed %percent commissions gets in that product which is being given by ABN.
                        and agent works hand in hand with the merchant on the order they made to make sure that the product reached to merchant</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="service-banner">
            <p>Get into main service sector ABN provides &nbsp;<a href="/services" class="service-btn">More Service</a></p>
        </div>
    </div>
</div>
@endsection
