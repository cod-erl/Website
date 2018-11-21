@extends('layouts.app')

@section('content')
<div class="container">
    <div class=" row">
        <table class='table table-responsive table-stripped'>
            <thead >
                <tr>
                    <th>#</th>
                <th class="item">Order No</th>
                <th>Amount</th>
                <th class="price">Delivery Status</th>
                <th class="quantity">Payment Status</th>
                <th class="total">Seller Name</th>
                <th class="total">Seller No</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody style='margin:0px; height:10px;'>
                @forelse($orders as $key => $order)
                <tr style='margin:0px!important; padding: 2px;'>
                    <td>{{$key +1}}</td>
                    <td>{{$order->order_no}}</td>
                    <td class="item"> {{$order->amount}}
                    </td>
                    <td class="price"> {{$order->delivery_status == true ? 'Delivered' : 'Not Delivered'}}
                    </td>
                    <td class="total">{{$order->payment_status == true ? 'Paid' : 'Payment Pending'}}</td>
                     <td class="item"> {{$order->seller->name}}
                    </td>
                    <td class="item"> {{$order->seller->telephone_no}}
                    </td>
                    <td>
                        @if($order->payment_status == false)
                        <form method='post' action='{{route('order.destroy',$order->id)}}'>
                            @csrf 
                            @method('delete')
                            <button type='submit' class='' ><i class='fa fa-trash text-danger'></i></button>
                        </form> OR
                        <a href='{{route('order.repay',$order->id)}}' class='btn btn-sm btn-success'>Attempt Repay</a>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <p> No Orders yet</p>
                </tr>
                @endforelse
            
            
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