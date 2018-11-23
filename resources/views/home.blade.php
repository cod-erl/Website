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
										<a href="{{route('migori.items')}}">
											Migori
										</a>
									</h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a href="{{route('homabay.items')}}">
											HOMABAY
										</a>
									</h4>
								</div>
							</div>
						</div><!--/category-products-->
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
                                                                        <button type='submit' class="btn btn-sm" style="background-color: #dfc12a; color: white">
                                                                        <i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                                    </form><br>
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



