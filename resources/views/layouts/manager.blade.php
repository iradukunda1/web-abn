<!DOCTYPE html>
<html lang="en">
<meta content="text/html;charset=UTF-8" http-equiv="content-type"/><!-- /Added by HTTrack -->
<head>
    <title>ABN @yield("title") </title>
    <!--[if lt IE 10]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" name="viewport">
    <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
    <meta name="description"
          content="ABN International is an online modern, secure system where you make orders and buy your needs online for your business stock, easily and in a flash.">
    <meta name="keywords"
          content="ABN, store market , market place , market , africa ,   e commerce, rwanda, online, modern, shop, secure, clothes, accessories, watches, women, jewels, stocks, constructions, electronics, dropshipping, kigali">
    <meta name="author" content="ABN International">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <link rel="shortcut icon" type="image/x-icon" href="/img/no_image.png"/>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-175795975-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-175795975-1');
    </script>
    <link href="/img/no_image.png" rel="icon" type="image/x-icon">

    <title>@yield('title')</title>
    @include('partials.style_manager')

</head>
<body>
    
    @include('partials.top_menu')
    <div class="page-wrapper">
        @include('includes.stock-manager-side-bar')

        {{-- @include('sweetalert::alert') --}}

        <div class="page-content">


            <div class="container-fluid">
                {{--Error Alert Area--}}
                @if($errors->any())
                    <div class="alert alert-danger border-0 alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>

                            @foreach($errors->all() as $er)
                                <span><i class="icon-arrow-right5"></i> {{ $er }}</span> <br>
                            @endforeach

                    </div>
                @endif
                <div id="ajax-alert" style="display: none"></div>
                @include('partials.header-manager')

                @yield('content')
            </div>


        </div>
    </div>
   

    @include('partials.inc_bottom')

    @yield('scripts')

</body>
</html>
