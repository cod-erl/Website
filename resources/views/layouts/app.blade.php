<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
	<meta name="author" content="">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
	 crossorigin="anonymous">
	
	<!--loading bootstrap components-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<!--font awesome for glyphicons-->
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' <!-- Load an icon library to show a
	 hamburger menu (bars) on small screens -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	
    <!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	
	<title>{{ config('app.name', 'Laravel') }}</title>

	<!--styles-->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/prettyPhoto.css" rel="stylesheet">
    <link href="/css/price-range.css" rel="stylesheet">
    <link href="/css/animate.css" rel="stylesheet">
	<link href="/css/main.css" rel="stylesheet">
	<link href="/css/responsive.css" rel="stylesheet">

	<!-- Fonts -->
	<link rel="dns-prefetch" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
           
    <link rel="shortcut icon" href="/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/images/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="/images/ico/apple-touch-icon-57-precomposed.png">
	
	<!--chat script-->
	<script>
        window.Laravel = {!! json_encode([
            'csrfToken'=> csrf_token(),
            'user'=> [
                'authenticated' => auth()->check(),
                'id' => auth()->check() ? auth()->user()->id : null,
                'name' => auth()->check() ? auth()->user()->name : null, 
                ]
            ])
        !!};
</script>
</head><!--/head-->
<body>
    <header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +254 753 636 994</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> dairyyetu@mail.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-3">
						<a class="navbar-brand" href="{{ url('/') }}">
							{{ config('app.name', 'Laravel') }}
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                             <span class="navbar-toggler-icon"></span>
                        </button>
					</div>
					<div class="col-sm-9">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav ml-auto">
                                <!--authentication Links-->
								 @guest
                                <li><a href="{{ route('login') }}">Login</a></li>
                                <li>
									@if (Route::has('register'))
									<a href="{{ route('register') }}">Register</a>
									@endif
								</li>
                                @else
                                
								<li class="dropdown">
									<a>
										{{ Auth::user()->name }}<i class="fa fa-angle-down"></i>
									</a>                                    
                                        <ul role="menu" class="sub-menu">
                                            <li><a href="{{route('forms.edit_profile',Auth::user()->id)}}">Update Profile</a>
											</li>
                                                            

											<li>
                                                @if(Auth::user()->role->name === 'seller')
                                                    <a href="{{url('/products/create') }}">Upload Product</a>
                                                @endif
                                            </li> 
                                                 
											<li>
                                                @if(Auth::user()->role->name === 'seller')
										           <a href="{{url('/products')}}">Manage Products</a>
										        @endif
                                            </li>

                                            <li>
                                                    <a href="{{ route('logout') }}" 
											            onclick="event.preventDefault();
								                                document.getElementById('logout-form').submit();">
											        Logout
										            </a>
								
										            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
											        @csrf
										            </form>
                                            </li> 
                                        </ul> 
                                </li>                                               
                            </ul> 
                            <ul>
								@if(Auth::user()->role->name === 'buyer')
								<li>
									<a href="/cart">Cart ({{$cartItems->count()}})</a>
								</li>
                                @endif
                             @endguest
                            </ul>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{ url('home') }}">Home</a></li>
								<li><a href="{{ url('/products/all') }}">Shop</a></li>
								<li><a href="{{ url('about') }}">About</a></li>
								<li><a href="{{ url('contact') }}">Contact Us</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<input type="text" placeholder="Search"/>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->

    <main class="py-4">
            @yield('content')
        </main>

    <footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="companyinfo text-center">
							<h2>dairyYetu</h2>
							<p>Your one stop solution for dairy products</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-3">
						<div class="single-widget">
							<h2>Services</h2>
							<ul>
								<li><a href="{{ url('contact') }}">Contact Us</a></li>
								<li><a href="#">Order Status</a></li>
								<li><a href="#">FAQ’s</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="single-widget">
							<h2>Quick Shop</h2>
							<ul>
								<li><a href="#">Migori</a></li>
								<li><a href="#">Homabay</a></li>
								<li><a href="#">Nairobi</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul>
								<li><a href="#">Terms of Use</a></li>
								<li><a href="#">Privacy Policy</a></li>
								<li><a href="#">Refund Policy</a></li>
								<li><a href="#">Billing System</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="single-widget">
							<h2>About dairYetu</h2>
							<ul>
								<li><a href="{{url('about') }}">Company Information</a></li>
								<li><a href="#">Carers</a></li>
								<li><a href="#">Affillate Program</a></li>
								<li><a href="#">Copyright</a></li>
							</ul>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row ">
					<p class="text-center">|Copyright © 2018. All rights reserved.|</p>
				</div>
			</div>
		</div>
</footer><!--/Footer-->
{!! Toastr::render() !!}
  
<!--scripts-->
<script src="/js/jquery.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/jquery.scrollUp.min.js"></script>
<script src="/js/price-range.js"></script>
<script src="/js/jquery.prettyPhoto.js"></script>
<script src="/js/main.js"></script>
</body>
</html>
