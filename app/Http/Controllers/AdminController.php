<?php

namespace App\Http\Controllers;
use  Yuansir\Toastr\Facades\Toastr;

use Illuminate\Http\Request;
use App\Product;

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

    