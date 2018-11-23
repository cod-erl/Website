@extends('layouts.app')

@section('content')
<div class="container">
        <table class='table table-responsive table-stripped'>
            <thead >
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Item</th>
                    <th></th>
                    <th>Quantity</th>
                    <th></th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($carts as $key => $cart)
                <tr>
                    <td>{{$key +1}}</td>
                    <td><img src='{{asset($cart->product->filename)}}' width='75'></td>
                    <td > {{$cart->product->name}}
                    </td>
                    <td>
                        <div class='col-md-12'>
                            <div class='col-md-3'>
                                <form method='post' action='{{route('cart.remove',$cart->id)}}'>
                                    @csrf 
                                    @method('put')
                                    <button type='submit' class='' ><i class='fa fa-minus text-warning'></i></button>
                                </form> 
                            </div>
                    </td>
                    <td>
                        {{$cart->quantity}}
                    </td>
                    <td>
                        <form method='post' action='{{route('cart.add',$cart->product->id)}}'>
                            @csrf 
                            <button type='submit' class='' ><i class='fa fa-plus text-success'></i></button>
                        </form> 
                    </td>
                    <td> {{$cart->product->price}}</td>
                    <td>{{$cart->quantity * $cart->product->price}}</td>
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
                <a href="{{ url('products/all') }}" class="btn btn-sm pull-left " style="background-color: #dfc12a; color: white" role="button">Continue Shopping</a>
            </div>
            <div class=col-md-6>
                <a href="{{ url('checkout') }}" class="btn btn-sm pull-right" style="background-color: #dfc12a; color: white" role="button">Proceed to Checkout</a>
            </div>
        </div>
    </div>
<div class="clearfix"></div>
@endsection