<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ABN International | @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
          href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>
    <!-- <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}"> -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/slick-theme.css') }}"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/slick.css') }}"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/nouislider.min.css') }}"/>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
		.header-logo{
			color: white;
			text-transform: uppercase;
			font-size: 24px;
			font-weight: bold;
		}
		.header-logo:hover{
			color: yellowgreen;
			text-transform: uppercase;
			font-size: 24px;
			font-weight: bold;
		}
        .header-links{
            text-transform: uppercase;
            font-size: 18px;
            font-weight: bold;
        }
        .tx-f15{
            font-size: 1.5em !important;
        }
        .tx-f20{
            font-size: 2em !important;
        }
        .tx-f12{
            font-size: 1.2em !important;
        }
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
	</style>
    @stack("style")
</head>
<body>
    <div id="app">
            
        <header>
        <div id="top-header" style="background: linear-gradient(135deg,#6394ff 0%,#0a193b 100%);color: white;" class="pb-0">
            <div class="container d-flex">
                <div class="header-logo pl-4"> 
                    ABN. International                         
                </div>
                <!-- <ul class="header-links pull-right">
                    <li><a href="/login"  class="text-decoration-none"><i class="fa fa-user-o"></i> Login</a></li>
                </ul>
                 -->
                <div class="header-menu-nav ml-auto">

                <ul class="row justify-content-around mx-0 mb-0">
                    @guest
                        <li class="tx-f20"><a href="/login" class="text-white">Sign in</a></li>
                        <li class="tx-f20 mx-4"><a href="/user/register" class="text-white">Register</a></li>
                    @else
                        <li class="mx-3 tx-f20">
                            <div class="dropdown">
                                <button type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false" class="border-0" style="background:none">{{auth()->user()->email}}<i
                                        class="border-0 fa fa-caret-down"></i></button>
                                <ul class="dropdown-menu animation slideDownI"
                                    aria-labelledby="dropdownMenuButton">
                                    @role("user")
                                    <li class="tx-f15"><a href="#">Request</a></li>
                                    <li class="tx-f15"><a href="#">My account</a></li>
                                    @endrole
                                    @role("admin")
                                    <li class="tx-f15"><a href="/admin">Dashboard</a></li>
                                    @endrole
                                    @role("agent")
                                    <li class="tx-f15"><a href="/agent/profile">Account</a></li>
                                    <li class="tx-f15"><a href="#">My Commissions</a></li>
                                    @endrole
                                    <li class="tx-f15"><a href="/logout">Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    @endguest
                    <!-- <li class="pr-0 tx-f20">
                        <div class="dropdown">
                            <button type="button" id="dropdownMenuButton-2" data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false">FRW<i
                                    class="ion-ios-arrow-down ml-1"></i></button>
                            <ul class="dropdown-menu animation slideDownIn"
                                aria-labelledby="dropdownMenuButton-2">
                                <li class="tx-f20"><a href="#">RWF F</a></li>
                                <li class="tx-f20"><a href="#">USD $</a></li>
                                <li class="tx-f20"><a href="#">Dirham</a></li>
                            </ul>
                        </div>
                    </li> -->
                </ul>
                </div>               

            </div>
        </div>
        
        <div id="header" style="background: linear-gradient(135deg,#6394ff 0%,#0a193b 100%);color: white;">
            <div class="container">
                <div class="row mx-0 w-100">
                    <div class="col-md-12 px-0">   
                        <div class="header-links pull-left py-2">
                            <ul class="main-nav nav">
                                <li><a href="/home" class="text-decoration-none"><i class="fa fa-home"></i> Home</a></li>
                                <li><a href="/products" class="text-decoration-none">Products</a></li>
                                <li><a href="#" class="text-decoration-none">Make Request</a></li>
                                @role("agent")
                                    <li class="show-on-hover">
                                        <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown">Register</a> -->
                                        <a class="dropdown" href="#" style="font-size:13px">
                                            <button type="button" id="dropdownMenuButton-2" data-toggle="dropdown"  class="border-0 px-0" style="background:none"
                                                    aria-haspopup="true"
                                                    aria-expanded="false">Register<i
                                                    class="ion-ios-arrow-down ml-1"></i></button>
                                            <ul class="dropdown-menu animation slideDownIn"
                                                aria-labelledby="dropdownMenuButton-2">
                                                <li class="tx-f15"><a class="text-black-50" href="#">User</a></li>
                                                <li class="tx-f15"><a class="text-black-50" href="/agent/merchants/create">Merchants</a></li>
                                                <li class="tx-f15"><a class="text-black-50" href="#">Organization</a></li>
                                            </ul>
                                        </a>
                                    </li>
                                @endrole
                                <li><a href="/about-us"  class="text-decoration-none"><i class="fa fa-account"></i> About us</a></li>
                                <li><a href="/contact-us"  class="text-decoration-none"><i class="fa fa-servicestack"></i> contact us</a></li>
                                <li><a href="/services"  class="text-decoration-none"><i class="fa fa-servicestack"></i> Services</a></li>
                                <li><a href="#"  class="text-decoration-none"><i class="fa fa-servicestack"></i>Advertise</a></li>
                                <li><a href="#"  class="text-decoration-none"><i class="fa fa-servicestack"></i> Help Me!</a></li>
                            </ul>
                        </div>
                    </div>        
                </div>
            </div>
        </div>
    </header>

        <main class="py-4">
            @yield('content')
        </main>
        <footer id="footer" style="background: linear-gradient(135deg,#6394ff 0%,#0a193b 100%);color: white;">
            <div class="section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-xs-6">
                            <div class="footer">
                                <h3 class="footer-title font-weight-bold">About Us</h3>
                                <p style="font-size:14px">ABN International connects member buyers to women and Men -owned sellers based outside of the Country, enhances their capabilities to transact business and instills confidence that sellers meet buyers’ standards for women and Men -owned businesses.</p>
                                
                                <div class="divider"></div>
                                <ul class="footer-links">
                                    <li><a href="#" class="fa-2x"><i class="fa fa-map-marker"></i>kk318 st kicukiro Rwanda</a></li>
                                    <li><a href="#" class="fa-2x"><i class="fa fa-phone"></i>+250-788-999-909</a></li>
                                    <li><a href="#" class="fa-2x"><i class="fa fa-envelope-o"></i>abncompany@gmail.com</a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="col-md-3 col-xs-6">
                            <div class="footer">
                                <h3 class="footer-title font-weight-bold">Services</h3>
                                <ul class="footer-links">
                                    <li class="fa-2x"><a href="#">Advocacy & Contraction</a></li>
                                    <li class="fa-2x"><a href="#">Construction</a></li>
                                    <li class="fa-2x"><a href="#">IT & computer electronics </a></li>
                                    <li class="fa-2x"><a href="#">Tourism & Hospitality</a></li>
                                    <li class="fa-2x"><a href="#">Logistics & Dropshipping</a></li>
                                    <li class="fa-2x"><a href="#">Training & Educations</a></li>
                                    <li class="fa-2x"><a href="#">Advertising & Entertainment</a></li>
                                    <li class="fa-2x"><a href="#">Support services & Rescue funding</a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="clearfix visible-xs"></div>
                        <div class="col-md-3 col-xs-6">
                            <div class="footer">
                                <h3 class="footer-title font-weight-bold">Information</h3>
                                <ul class="footer-links">
                                    <li class="fa-2x"><a href="/home">Home</a></li>
                                    <li class="fa-2x"><a href="/about">About Us</a></li>
                                    <li class="fa-2x"><a href="/contact-us">Contact Us</a></li>
                                    <li class="fa-2x"><a href="#">Orders and Returns</a></li>
                                    <li class="fa-2x"><a href="#">Terms & Conditions</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3 col-xs-6">
                            <div class="footer">
                                <h3 class="footer-title font-weight-bold">Categories</h3>
                                <ul class="footer-links">
                                    <li class="fa-2x"><a href="#">Agents</a></li>
                                    <li class="fa-2x"><a href="#">Merchants</a></li>
                                    <li class="fa-2x"><a href="#">Organization</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div id="bottom-footer" class="section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <ul class="footer-payments">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-google"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                            </ul>
                            <span class="copyright">
                                Copyright &copy; <?php echo date("Y"); ?> All rights reserved | <i class="fa fa-heart-o" aria-hidden="true"></i>ABN International.
                            </span>
                        </div>
                    </div>
                </div>
            </div>
    </footer>
    </div>
    <script src="/assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="/assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/assets/js/slick.min.js" type="text/javascript"></script>
    <script src="/assets/js/nouislider.min.js" type="text/javascript"></script>
    <script src="/assets/js/jquery.zoom.min.js" type="text/javascript"></script>
    <script src="/assets/js/main.js" type="text/javascript"></script>
@stack("scripts")
</body>
</html>
