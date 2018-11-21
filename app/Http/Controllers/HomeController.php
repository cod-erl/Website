<?php

namespace App\Http\Controllers;
use  Yuansir\Toastr\Facades\Toastr;

use Illuminate\Http\Request;
use App\Product;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::whereStatus(true)->orderByDesc('created_at')->paginate(12);
        return view('home')->withProducts($products);
    }

    public function create()
    {
        return view('auth.login');
    }
    
    public function store()
    {
        $input = request()->validate([
                'name' => 'required',
                'password' => 'required|min:5',
                'email' => 'required|email|unique:users'
            ], [
                'name.required' => 'Name is required',
                'password.required' => 'Password is required'
            ]);

        $input = request()->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        return back()->with('success', 'User created successfully.');
    }
}

    