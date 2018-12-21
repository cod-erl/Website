<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Mail\ContactEmail;
use Mail;
use  Yuansir\Toastr\Facades\Toastr;

class ContactController extends Controller
{

    public function create()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);
        // dd($request);

        $contact=[];
        $contact['name'] = $request->name;
        $contact['email'] = $request->email;
        $contact['message'] = $request->message;

        //mail logic
        Mail::to(env('MAIL_ACCOUNT'))->send(new ContactEmail($contact));
        Toastr::success('Thank you for contacting us', $title = 'Contact Sent', $options = []);
        return back();
        
    }

}

