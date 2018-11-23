<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;

class PagesController extends Controller
{
    public function index()
    {
        $products = Product::whereStatus(true)->orderByDesc('created_at')->take(4)->get();
        return view('welcome',get_defined_vars());
    }
     public function about()
    {
        return view('about');
    }

    public function products()
    {
        $products = Product::whereStatus(true)->orderByDesc('created_at')->paginate(12);
        return view('home',get_defined_vars());
        
    }

    public function homabay()
    {
        $products = Product::wherestatus(true)->whereCounty('Homabay')->orderByDesc('created_at')->paginate(12);
        return view('County.Homabay',get_defined_vars());
    }

    public function migori()
    {
        $products = Product::wherestatus(true)->whereCounty('Migori')->orderByDesc('created_at')->paginate(12);
        return view('County.Migori',get_defined_vars());
    }
}
