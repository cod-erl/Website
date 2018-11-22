<?php

namespace App\Http\Controllers;
use  Yuansir\Toastr\Facades\Toastr;

use Illuminate\Http\Request;
use App\Product;
use App\Admin;
use App\User;

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

    public function create()
    {
        return view('auth.admin-login');
    }
    
    public function Sellers()
    {
        
        return view('admin.sellers');
    }

    public function Buyers()
    {
        return view('admin.buyers');
    }

    public function Products()
    {
        return view('admin.products');
    }
}

    