<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Order;
use App\User;

class OrderController extends Controller
{
    public function orders()
    {
        $orders = Order::where('user_id', Auth::user()->id)->get();
        foreach ($orders as $key => $order) {
            $order['seller'] = User::find($order->seller_id);
        }
        return view('orders',get_defined_vars());
    }
}
