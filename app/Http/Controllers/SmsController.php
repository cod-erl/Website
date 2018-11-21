<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use AfricasTalking\SDK\AfricasTalking;

use App\Product;
Use App\User;
use App\Cart;

class SmsController extends Controller
{
    private $RESPONSE_TYPE = 'json';
    private $username = 'Erl3';
    PRIVATE $api_key='3nbVeweOegHLNswMoDrVxKfxkUhjyk6cGkGWSpjhlnlcC4hXlo';
    private $sender = 'dairyyetu';
    private $to='$phone_number';
    private $message='$message';
    private $msgtype= '5';
    private $dlr = '0';

    public function getUserNumber(Request $request)
    {
        $phone_number = $request->input('phone_number');

        $message = "A message has been sent to you";

        $this->initiateSmsActivation($phone_number, $message);

        return redirect()->back()->with('message', 'Message has been sent successfully');
    }

    public function initiateSmsActivation($phone_number, $message){
        $isError = 0;
        $errorMessage = true;

        //Preparing post parameters
        $postData = array(
            'username' => $this->username,
            'api_key' => $this->api_key,
            'message' => $message,
            'sender' => $this->sender,
            'to' => $phone_number,
            'response' => $this->RESPONSE_TYPE
        );

        $url = "https://sms.movesms.co.ke/api/compose?";

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
        ));

        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        //get response
        $output = curl_exec($ch);

        //Print error if any
        if (curl_errno($ch)) {
            $isError = true;
            $errorMessage = curl_error($ch);
        }
        curl_close($ch);

        if($isError){
            return array('error' => 1 , 'message' => $errorMessage);
        }else{
            return array('error' => 0 );
        }
    }
}



