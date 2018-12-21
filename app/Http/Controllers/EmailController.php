<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailController extends Controller
{

    //admin mail send
    public function send(Request $request)
    {
    $title = $request->input('title');
        $content = $request->input('content');

        Mail::send('emails.send', ['title' => $title, 'content' => $content], function ($message)
        {

            $message->from('env(MAIL_ACCOUNT)');

            $message->to('env(MAIL_ACCOUNT)');

        });

        return response()->json(['message' => 'Request completed']);       
    }
}
