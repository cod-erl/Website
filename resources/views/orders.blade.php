@extends('layouts.app')

@section('content')
<div class="container">
        <table class="table table-responsive table-stripped center">
            <thead >
                <tr>
                <th>#</th>
                <th>Order No</th>
                <th>Amount</th>
                <th>Delivery Status</th>
                <th>Payment Status</th>
                <th>Seller Name</th>
                <th></th>
                <th>Action</th>
                <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $key => $order)
                <tr>
                    <td>{{$key +1}}</td>
                    <td>{{$order->order_no}}</td>
                    <td> {{$order->amount}}</td>
                    <td> {{$order->delivery_status == true ? 'Delivered' : 'Not Delivered'}}</td>
                    <td>{{$order->payment_status == true ? 'Paid' : 'Payment Pending'}}</td>
                    <td> {{$order->seller->name}}</td>
                    <td>
                        @if($order->payment_status == false)
                        <form method='post' action='{{route('order.destroy',$order->id)}}'>
                            @csrf 
                            @method('delete')
                            <button type='submit'class='btn btn-sm btn-warning'>Delete</button>
                        </form>
                        </td>
                        <td> OR </td>
                        <td>
                        <a href='{{route('order.repay',$order->id)}}' class='btn btn-sm btn-success'>Repay</a>
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
                <a href="{{ url('products/all') }}" class="btn btn-sm pull-left " style="background-color: #dfc12a; color: white"  role="button">Continue Shopping</a>
            </div>
            <div class=col-md-6>
                <a href="{{ url('checkout') }}" class="btn btn-sm pull-right" style="background-color:#dfc12a; color: white" role="button">Proceed to Checkout</a>
            </div>
        </div>
</div>
            

@endsection