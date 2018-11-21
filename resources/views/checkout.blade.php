@extends('layouts.app')

@section('content') 
<div class="container checkout_container ">   
    <div class="container-fluid">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><b>Check out</b> items from<b> {{$seller->name}}</b></li>
            </ol>
        </div>
        
        <div class="reminder bar"> Forgetting anything? <a class=' btn-info' href="{{url('products/all')}}">Proceed to products</a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <form action='{{route('order')}}' method='post'>
                    @csrf 
                <div class="step-one">
                    <div class="breadcrumb">
                        <ol class="breadcrumb">
                            <li>Step 1:Verify Delivery address</li>
                        </ol>
                    </div>

                    <div class="checkout_options text-center">
                        <table class='table col-md-12'>
                            <tbody colspan="4">
                                <tr class='form-group'>
                                    <td>Name</td>
                                    <td><input type="text" value='{{Auth::user()->name}}' class='form-control' readonly></td>
                                </tr>
                                <tr class='form-group'>
                                    <td>Email</td>
                                    <td><input type="text" value='{{Auth::user()->email}}' class='form-control' readonly></td>
                                </tr>
                                <tr class='form-group'>
                                    <td>Town/ City</td>
                                    <td><input type="text" name='city' value='{{old('city')}}' class='form-control' required></td>
                                </tr>
                                <tr class='form-group'>
                                    <td>Address</td>
                                    <td><input type="text" name='address' value='{{old('address')}}' class='form-control' required></td>
                                    <input type="hidden" name='seller_id' value='{{$seller->id}}'>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                 <div class="step-two">
                    <div class="breadcrumb">
                        <ol class="breadcrumb">
                            <li>Step 2:Pay with Mpesa</li>
                        </ol>
                    </div>

                    <div class="checkout_options text-left">
                        <ul>
                            <li>1. Enter Mpesa Phone Number</li>
                             <li>2. Enter Mpesa PIN in the STK push sent</li>
                              <li>3. Wait for Mpesa Mpesa</li>
                              <li>4. Confirm Payment</li>
                        </ul>
                    </div>
                </div>
                 <div class="step-three">
                    <div class="breadcrumb">
                        <ol class="breadcrumb">
                            <li>Step 3:Payment Details</li>
                        </ol>
                    </div>

                    <div class="checkout_options text-center">
                        <table class='table col-md-12'>
                            <tbody colspan="4">
                                <tr class='form-group'>
                                    <td>Phone Number</td>
                                    <td><input type="text" required name='phone' value='{{old('phone',Auth::user()->telephone_no)}}' class='form-control' ></td>
                                </tr>
                            
                                <tr>
                                    <td><h3>Total Amount</h3></td>
                                    <td><h3 class='h3'> <b>Ksh. {{$carts->sum('total')}}</b></h3></td>
                                    <input type="hidden" name='amount' value='{{$carts->sum('total')}}'>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                 <div class="step-four">
                    <div class="breadcrumb">
                        <ol class="breadcrumb">
                            <li>Step 3:Check Out</li>
                        </ol>
                    </div>

                    <div class="checkout_options text-center">
                        <table class='table col-md-12'>
                            <tbody colspan="4">
                               <button type='submit'class='btn btn-sm btn-info' >Check Out</button>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
            </div>
        
        </div>
    </div>

</div>
</div>

@endsection