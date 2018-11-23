<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Yuansir\Toastr\Facades\Toastr;
use AfricasTalking\SDK\AfricasTalking;
use App\Cart;
use App\Product;
use Auth;
use App\Order;
use App\Transaction;
use App\User;

class CheckOutController extends Controller
{
    public function checkoutPage()
    {

       $cart_item = Cart::where('user_id',Auth::user()->id)->where('checked',false)->get();
       foreach ($cart_item as $key => $cart) {
           $cart['total'] = $cart->quantity * $cart->product->price;
       }
       $cart = Cart::where('user_id',Auth::user()->id)->where('checked',false)->first();
       $seller = $cart->product->user;

        return view('checkout')->withCarts($cart_item)->withSeller($seller);
    }

    public function makeOrder(Request $request)
    {
        $validatedData = $request->validate([
            'city' => 'required',
            'address' => 'required',
            'seller_id' => 'required|integer',
            'amount' => 'required|integer',
            'phone' => 'required|regex:/^07\d{8}$/',
        ]);
        $user = Auth::user();
        $carts = Cart::where('user_id',$user->id)->where('checked',false)->get();
        
        $phone = '254'.substr($request->phone,-9);
        $order_no = rand(10000,999999);
        $response = \STK::request($request->amount)
            ->from($phone)
            ->usingReference(env('APP_NAME'),$order_no)
            ->push();
            
        if($response){
            $payload = json_decode(json_encode($response), true);
            \Log::notice($payload);
            if(array_has($payload,'ResponseCode')){
                if($payload['ResponseCode'] == 0){
                    $order = new Order;
                    $order->CheckoutRequestID = $payload['CheckoutRequestID'];
                    $order->MerchantRequestID = $payload['MerchantRequestID'];
                    $order->amount = $request->amount;
                    $order->city = $request->city;
                    $order->address = $request->address;
                    $order->order_no = $order_no;
                    $order->user_id = $user->id;
                    $order->seller_id = $request->seller_id;
                    $order->save();

                    foreach ($carts as $key => $cart) {
                        $cart = Cart::find($cart->id);
                        $cart->order_id = $order->id;
                        $cart->checked = true;
                        $cart->save();
                    }
                    Toastr::success('Payment Intitiated, finish payment', $title = 'Payment Error', $options = []);
                    return back();
                }else{
                    Toastr::error('Error Occured while initiating payment, try again', $title = 'Payment Error', $options = []);
                    return redirect()->back();
                }
            }else{
                Toastr::error('Error Occured while initiating payment, try again', $title = 'Payment Error', $options = []);
                return redirect()->back();
            }
        }
    }

    public function repayOrder(Order $order)
    {
        $phone = '254'.substr(Auth::user()->telephone_no,-9);
        $response = \STK::request($order->amount)
            ->from($phone)
            ->usingReference(env('APP_NAME'),$order->order_no)
            ->push();
            
        if($response){
            $payload = json_decode(json_encode($response), true);
            \Log::notice($payload);
            if(array_has($payload,'ResponseCode')){
                if($payload['ResponseCode'] == 0){
        
                    $order->CheckoutRequestID = $payload['CheckoutRequestID'];
                    $order->MerchantRequestID = $payload['MerchantRequestID'];
                    $order->save();

                    Toastr::success('Payment Intitiated, finish payment', $title = 'Payment Error', $options = []);
                    return back();
                }else{
                    Toastr::error('Error Occured while initiating payment, try again', $title = 'Payment Error', $options = []);
                    return redirect()->back();
                }
            }else{
                Toastr::error('Error Occured while initiating payment, try again', $title = 'Payment Error', $options = []);
                return redirect()->back();
            }
        }
    }

    public function removeOrder(Order $order)
    {
        $order->carts()->delete();
        $order->delete();
         Toastr::success('Order removed', $title = 'Order', $options = []);
        return redirect()->back();
    }

    public function paymentResult()
    {
        $payload = file_get_contents('php://input');
        $result = json_decode($payload, true);
       if($result['Body']['stkCallback']['ResultCode'] == 0)
        {
            $trans_no = $result['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value'];
            $trans = Transaction::where('mpesa_receipt_no',$trans_no)->first();
            if(!$trans)
            {
                $status = false;
                $order = Order::where('CheckoutRequestID',$result['Body']['stkCallback']['CheckoutRequestID'])->where('MerchantRequestID', $result['Body']['stkCallback']['MerchantRequestID'])->first();
                if ($order) {
                   $order->payment_status = true;
                   $order->save();
                   $status = true;

                   //reduce quantity
                   $carts = Cart::where('order_id', $order->id)->get();
                   foreach ($carts as $key => $cart) {
                       $product = $cart->product;
                       $quantity = $product->quantity;
                       $product->quantity = $quantity - $cart->quantity;
                       $product->save();
                   }

                   //send message
                    $username = 'sandbox'; 
                    $apiKey   = '7cc40fbfb821f5a899b9d25be4e56a69a97b450d62982e37c16857b92b7b4248'; 
                    $AT       = new AfricasTalking($username, $apiKey);
                    $phone = $seller->telephone_no;
                    
                    // Get one of the services
                    $sms      = $AT->sms();

                    // Use the service
                    $result   = $sms->send([
                        'to'      => '+254'. $phone,
                        'message' => 'your products {{}} have been ordered. Proceed with deievery ASAP!!'
                    ]);

                    print_r($result);
                }
                $mpesa = new Transaction;
                $mpesa->merchant_id = $result['Body']['stkCallback']['MerchantRequestID'];
                $mpesa->checkout_id = $result['Body']['stkCallback']['CheckoutRequestID'];
                $mpesa->result_code = $result['Body']['stkCallback']['ResultCode'];
                $mpesa->phone_no = $result['Body']['stkCallback']['CallbackMetadata']['Item'][4]['Value'];
                $mpesa->amount = $result['Body']['stkCallback']['CallbackMetadata']['Item'][0]['Value'];
                $mpesa->mpesa_receipt_no = $result['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value'];
                $mpesa->status = $status;
                $mpesa->save();
            }else{
                \Log::error('Duplicate Entries');
            }
        }
        \Log::error('Wrong Payment Response');
    }
}
