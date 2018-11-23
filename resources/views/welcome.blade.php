@extends('layouts.app')

@section('content')
<!-- banner -->
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row" >
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						<div class="carousel-inner responsive" >
							<div class="item active" style="background-image: url(images/design/master-slide-01.jpg);">
								<div class="container">
									<h1 style="color:black">dairyYetu</h1>
									<h2>Your one stop solution for dairy products</h2>
									<button type="button" class="btn btn-default shop">Shop...</button>
								</div>
							</div>
							<div class="item" style="background-image: url(images/design/master-slide-02.jpg);">
								<div class="container">
									<h1 style="color:black">dairyYetu</h1>
									<h2>Don't let your home run short of dairy products</h2>
									<button type="button" class="btn btn-default shop">Shop...</button>
								</div>
							</div>
							
							<div class="item" style="background-image: url(images/design/master-slide-03.jpg); img-responsive">
								<div class="container">
									<h1 stye="color:black">dairyYetu</h1>
									<h2>Are you a die-hard of healthy living?</h2>
									<button type="button" class="btn btn-default shop">Shop</button>
								</div>
							</div>
							
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->

<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-2">
					<div class="left-sidebar">
						<h2>County</h2>
						<div class="panel-group category-products" id="accordian">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											Migori
										</a>
									</h4>
								</div>
								<div id="sportswear" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											<li><a href="#">suna East </a></li>
											<li><a href="#">Suna West</a></li>
											<li><a href="#">Suna North </a></li>
											<li><a href="#">Suna South </a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#mens">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											HOMABAY
										</a>
									</h4>
								</div>
								<div id="mens" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											<li><a href="#">Homabay East</a></li>
											<li><a href="#">Homabay West</a></li>
											<li><a href="#">Homabay North</a></li>
											<li><a href="#">Homabay South</a></li>
										</ul>
									</div>
								</div>
							</div>
							
						</div><!--/category-products-->	
						
						<div class="shipping text-center"><!--shipping-->
							<img src="images/home/shipping.jpg" alt="" />
                        </div><!--/shipping-->
                    </div>
                </div>
                        
                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center black">Featured Products</h2>
                            @foreach ($products->chunk(4) as $items)
                            <div class="row">
                                @foreach ($items as $product)
                                    <div class="col-md-3">
                                        <div class="thumbnail">
                                                        <img src="{{asset($product->filename)}}" class="image-responsive" alt="img">
                                                        <br />
                                                            <div class="caption">
                                                                <h4>{{$product->name}}</h4>
                                                                    <p>Quantity : <b>{{$product->quantity}}</b></p>
                                                                    <p>Price : <b>{{$product->price}}</b></p>
																	<p><b>Seller:</b> {{$product->user_name}}</p>
																	<p><b>Location: </b>{{$product->location}}, {{$product->county}} county</p>
                                                                    <form action='{{route('cart.add',$product->id)}}' method='post'> 
                                                                    @csrf
                                                                        <button type='submit' class="btn btn-success btn-sm">
                                                                        <i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                                    </form><br>
                                                            </div>
                                                            
                                                </div> 
                                    </div> <!-- end col-md-3 -->
                                @endforeach
                            </div> <!-- end row -->
							@endforeach
                    </div><!--featured items-->
				</div>
			</div>
        </div>
    </section>   
@endsection





