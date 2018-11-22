@extends('layouts.app')

@section('content')
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
											<li><a href="#">Suna South </a></li>
											<li><a href="#">Suna North </a></li>
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
							
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#womens">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											NAIROBI
										</a>
									</h4>
								</div>
							</div>
						</div><!--/category-products-->
				
						
						<div class="price-range"><!--price-range-->
							<h2>Price Range</h2>
							<div class="well text-center">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b class="pull-left">Ksh 0</b> <b class="pull-right">ksh 600</b>
							</div>
						</div><!--/price-range-->
						
						<div class="shipping text-center"><!--shipping-->
							<img src="images/home/shipping.jpg" alt="" />
                        </div><!--/shipping-->
                    </div>
                </div>
                        
                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Products</h2>
                            @foreach ($products->chunk(12) as $items)
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
                                                                    <a href="{{url('product_detail')}}" class="btn btn-success btn-sm">
                                                                    <i class="fa fa-eye"></i>View details
                                                                    </a>
                                                            </div>
                                                            
                                                </div> 
                                    </div> <!-- end col-md-3 -->
                                @endforeach
                            </div> <!-- end row -->
                            @endforeach

                            <ul class="pagination center-align">
                               {{$products->links()}}
                            </ul>
                    </div><!--featured items-->
                </div>
          </div>
        </div>
    </section>   
@endsection



