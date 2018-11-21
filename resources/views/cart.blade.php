@extends('layouts.app')

@section('content')
<div class="container">
    <div class=" row">
        <table class='table table-responsive table-stripped'>
            <thead >
                <tr>
                    <th>#</th>
                     <th>Image</th>
                <th class="item">Item</th>
                <th class="price">Quantity</th>
                <th class="quantity">Price</th>
                <th class="total">Total</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody style='margin:0px; height:10px;'>
                @forelse($carts as $key => $cart)
                <tr style='margin:0px!important; padding: 2px;'>
                    <td>{{$key +1}}</td>
                    <td><img src='{{asset($cart->product->filename)}}' width='75'></td>
                    <td class="item"> {{$cart->product->name}}
                    </td>
                    <td class="quantity">
                        <div class='col-md-12'>
                            <div class='col-md-3'>
                                <form method='post' action='{{route('cart.remove',$cart->id)}}'>
                                    @csrf 
                                    @method('put')
                                    <button type='submit' class='' ><i class='fa fa-minus text-warning'></i></button>
                                </form> 
                            </div>
                            <div class='col-md-6'>
                                {{$cart->quantity}}
                            </div>
                            <div class='col-md-3'>
                                <form method='post' action='{{route('cart.add',$cart->product->id)}}'>
                                    @csrf 
                                    <button type='submit' class='' ><i class='fa fa-plus text-success'></i></button>
                                </form>
                            </div>
                        </div> 
                    </td>
                    <td class="price"> {{$cart->product->price}}
                    </td>
                    <td class="total">{{$cart->quantity * $cart->product->price}}</td>
                    <td>
                        <form method='post' action='{{route('cart.delete',$cart->id)}}'>
                            @csrf 
                            @method('delete')
                            <button type='submit' class='' ><i class='fa fa-trash text-danger'></i></button>
                        </form> 
                    </td>
                </tr>
                @empty
                <tr>
                    <p> No items in your cart</p>
                </tr>
                @endforelse
                <tr colspan='3'>
                    <td><h3 class='h3'>Grand Total : <b>Ksh. {{$carts->sum('total')}}</b></h3></td>
                   
                    
                </tr>
            
            </tbody> 
        </table>
         <div class=col-md-12>
             <div class=col-md-6>
                <a href="{{ url('products/all') }}" class="btn btn-info btn-sm pull-left " role="button">Continue Shopping</a>
            </div>
            <div class=col-md-6>
                <a href="{{ url('checkout') }}" class="btn btn-info btn-sm pull-right" role="button">Proceed to Checkout</a>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
            

@endsection