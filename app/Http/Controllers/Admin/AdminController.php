<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
    }

    public function displayInbox()
    {
        return view('Chats');
    }

    public function displayContacts()
    {
        return view('contacts');
    }

    public function viewUsers()
    {
        return view('users');
    }

    public function destroyUsers()
    {
        return view('admin.index')->withSuccess('user destroyed successfuly');
    }

}
