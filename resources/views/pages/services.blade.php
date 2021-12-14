@extends('layouts.app')
@section('title', 'Services')
@push('style')
<style>
    section {
        padding-top: 4rem;
        padding-bottom: 5rem;
    }
    .wrap {
        display: flex;
        background: white;
        padding: 1rem 1rem 1rem 1rem;
        border-radius: 0.5rem;
        box-shadow: 7px 7px 30px -5px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
    }

    .wrap:hover {
        background: linear-gradient(135deg,#6394ff 0%,#0a193b 100%);
        color: white;
    }

    .ico-wrap {
        margin: auto;
    }

    .mbr-iconfont {
        font-size: 4.5rem !important;
        color: #313131;
        margin: 1rem;
        padding-right: 1rem;
    }
    .vcenter {
        margin: auto;
    }

    .mbr-section-title3 {
        text-align: left;
    }
    h2 {
        margin-top: 0.5rem;
        margin-bottom: 0.5rem;
    }
    .display-5 {
        font-family: 'Source Sans Pro',sans-serif;
        font-size: 1.4rem;
    }
    .mbr-bold {
        font-weight: 700;
    }

    p {
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
        line-height: 25px;
    }
    .display-6 {
        font-family: 'Source Sans Pro',sans-serif;
        font-size: 1re}
</style>
@endpush
@section('content')

<section>
    <div class="services-container">
        <div class="row justify-content-center mx-0">
            <a href="#">
                <div class="col-md-10">
                    <div class="wrap">
                        <div class="ico-wrap">
                            <span class="mbr-iconfont fa-volume-up fa"></span>
                        </div>
                        <div class="text-wrap vcenter">
                            <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">Advocacy & Contraction</h2>
                            <p class="mbr-fonts-style text1 mbr-text display-6">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum</p>
                        </div>
                    </div>
                </div>
            </a>
            <a href="#">
                <div class="col-md-10">
                    <div class="wrap">
                        <div class="ico-wrap">
                            <span class="mbr-iconfont fa-calendar fa"></span>
                        </div>
                        <div class="text-wrap vcenter">
                            <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">IT & computer electronics</h2>
                            <p class="mbr-fonts-style text1 mbr-text display-6">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum</p>
                        </div>
                    </div>
                </div>
            </a>
            <a href="#">
                <div class="col-md-10">
                    <div class="wrap">
                        <div class="ico-wrap">
                            <span class="mbr-iconfont fa-globe fa"></span>
                        </div>
                        <div class="text-wrap vcenter">
                            <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">Tourism & Hospitality</h2>
                            <p class="mbr-fonts-style text1 mbr-text display-6">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="row justify-content-center mx-0">
            <a href="#">
                <div class="col-md-10">
                    <div class="wrap">
                        <div class="ico-wrap">
                            <span class="mbr-iconfont fa-volume-up fa"></span>
                        </div>
                        <div class="text-wrap vcenter">
                            <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">Construction</h2>
                            <p class="mbr-fonts-style text1 mbr-text display-6">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum</p>
                        </div>
                    </div>
                </div>
            </a>
            <a href="#">
                <div class="col-md-10">
                    <div class="wrap">
                        <div class="ico-wrap">
                            <span class="mbr-iconfont fa-calendar fa"></span>
                        </div>
                        <div class="text-wrap vcenter">
                            <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">Advertising & Entertainment</h2>
                            <p class="mbr-fonts-style text1 mbr-text display-6">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum</p>
                        </div>
                    </div>
                </div>
            </a>
            <a href="#">
                <div class="col-md-10">
                    <div class="wrap">
                        <div class="ico-wrap">
                            <span class="mbr-iconfont fa-globe fa"></span>
                        </div>
                        <div class="text-wrap vcenter">
                            <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">Training & Educations</h2>
                            <p class="mbr-fonts-style text1 mbr-text display-6">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum</p>
                        </div>
                    </div>
                </div>
            </a>
            <a href="#">
                <div class="col-md-10">
                    <div class="wrap">
                        <div class="ico-wrap">
                            <span class="mbr-iconfont fa-trophy fa"></span>
                        </div>
                        <div class="text-wrap vcenter">
                            <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">Support services & Rescue funding</h2>
                            <p class="mbr-fonts-style text1 mbr-text display-6">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum</p>
                        </div>
                    </div>
                </div>
            </a>
            <a href="#">
                <div class="col-md-10">
                    <div class="wrap">
                        <div class="ico-wrap">
                            <span class="mbr-iconfont fa-trophy fa"></span>
                        </div>
                        <div class="text-wrap vcenter">
                            <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">Logistics & Dropshipping</h2>
                            <p class="mbr-fonts-style text1 mbr-text display-6">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>
@endsection