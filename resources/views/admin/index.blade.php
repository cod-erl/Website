@extends('layouts.admin')

@section('content')
<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<a href="https://mailtrap.io/inboxes/494396/messages/1010305500"><i class="glyphicon glyphicon-envelope">Mails</i></a>
		<a href="{{route('manage.sellers') }}"><i class="fas fa-user">Sellers</i></a>
		<a href="{{route('manage.buyers') }}"><i class="fas fa-user"></i>Buyers</a>
		<a href="{{route('manage.products') }}"><i class=""></i>Products</a>
	</div>

	<div id="main">
    	<header id="header">		
			<div class="container-fluid">
				<div class="row" style="background-color:#dfc12a">
					<div class="col-sm-3">
						<a style="color:white"class="navbar-brand" href="{{ url('/admin/dashboard') }}">
							{{ config('app.name', 'Laravel') }}
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                             <span class="navbar-toggler-icon"></span>
                        </button>
					</div>

					<div class="col-sm-9">
					<div class="row shop-menu pull-right">
						<ul>
							<li><a href="{{ route('logout') }}" 
											onclick="event.preventDefault();
								                    document.getElementById('logout-form').submit();">
											Logout
								</a>
								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
								</form>
								</li>                                          
                            </ul> 
						</div>
					</div>	
				</div>
				<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>
			</div>
		</div>
	</div>
@endsection