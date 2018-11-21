<?php

namespace App\Http\Controllers;
use  Yuansir\Toastr\Facades\Toastr;

use Illuminate\Http\Request;
use \App\User;
use \App\County;
use \App\Location;

class productcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $products = \App\Product::where('user_id',\Auth::user()->id)->get();
        //  dd($products);
        return view('seller')->with('products', $products); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            return view('forms.create_product');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'quantity' => 'required',
            'price' => 'required|integer',
            'image' => 'required|mimes:jpg,jpeg,png'
        ]);

        $product= new \App\Product;
        $product->name=$request->name;
        $product->user_id = \Auth::user()->id;
        $product->user_name = \Auth::user()->name;
        $product->location= \Auth::user()->location;
        $product->county= \Auth::user()->county;
        $product->quantity=$request->get('quantity');
        $product->price=$request->get('price');
        if($request->has('image'))
         {
            $file = $request->image;
            $name= time().$file->getClientOriginalName();
            $file->move(public_path().'/images/uploads/', $name);
            $product->filename= '/images/uploads/'.$name;
         }
        $product->save();
        
        return redirect('products')->with('success', 'Product has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = \App\Product::where('id', $id)->firstOrFail();
        return view('product_detail')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = \App\Product::find($id);
        return view('forms.edit_product')->withProduct($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'quantity' => 'required',
            'price' => 'required|integer',
            'status' => 'required',
            'image' => 'sometimes|mimes:jpg,jpeg,png'
        ]);
        // dd($request);

        $product= \App\product::find($id);
        $product->name=$request->name;
        $product->quantity=$request->quantity;
        $product->price=$request->price;
        $product->status = $request->status;
        if($request->has('image'))
         {
             $oldImagePath = $product->filename;
            $file = $request->image;
            $name= time().$file->getClientOriginalName();
            $file->move(public_path().'/images/uploads/', $name);
            $product->filename= '/images/uploads/'.$name;
            \File::delete($oldImagePath);
         }
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = \App\Product::find($id);
        // $product->deleted = true;
        // $product->save();
        $oldImagePath = $product->filename;
        \File::delete($oldImagePath);
        $product->delete();
        return redirect('products')->with('success','Product has been  deleted');
    }
}
