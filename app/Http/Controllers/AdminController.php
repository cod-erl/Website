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
        $users = User::whererole_id(2)->orderByDesc('created_at')->get();  

        return view('admin.sellers')->with('users', $users);
    }

    public function Buyers()
    {
        $users = User::whererole_id(1)->orderByDesc('created_at')->get();  
        return view('admin.buyers')->with('users', $users);
    }

    public function Products()
    {
        $products = Product::wherestatus(true)->orderByDesc('created_at')->get();
        return view('admin.products')->with('products', $products);
    }

    public function destroy($id)
    {
        $user = \App\User::find($id);
        $user->delete();
        return redirect('admin/dashboard')->with('success','User has been  deleted');
    }
    public function destroyProduct($id)
    {
        $product = \App\Product::find($id);
        // $product->deleted = true;
        // $product->save();
        $oldImagePath = $product->filename;
        \File::delete($oldImagePath);
        $product->delete();
        return redirect('admin/dashboard')->with('success','Product has been  deleted');
    }
}

    