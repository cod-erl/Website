<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function confirmation($trackingid,$status,$payment_method,$merchant_reference)
    {
        $payments = Payments::where('tracking',$trackingid)->first();
        $payments -> payment_status = $status;
        $payments -> payment_method = $payment_method;
        $payments -> save();
    }       
}
