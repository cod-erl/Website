<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Cart;
use App\Product;
use Auth;
use  Yuansir\Toastr\Facades\Toastr;

class CartController extends Controller
{
   public function add(Product $product)
   {
       if ($product->quantity < 1) {
           Toastr::error('Product Out of Stock', $title = 'Cart Error', $options = []);
                return redirect()->back();
       }
       $cart = Cart::where('user_id',Auth::user()->id)->where('checked',false)->first();
       if($cart){
           if($cart->product->user_id != $product->user_id){
               Toastr::warning('Kindly order items from same seller', $title = 'Cart Error', $options = []);
                return redirect()->back();
           }
       }
       $cart_item = Cart::where('user_id',Auth::user()->id)->where('product_id',$product->id)->where('checked',false)->first();
       if ($cart_item) {
           $q = $cart_item->quantity +1;
            if ($q > $product->quantity) {
                Toastr::error('Product Out of Stock', $title = 'Cart Error', $options = []);
                return redirect()->back();
            }
           $quantity = $cart_item->quantity;
           $cart_item->quantity = $quantity +1;
           $cart_item ->save();
           Toastr::success('Product  added to cart', $title = 'Cart', $options = []);
           return redirect()->back();
       }
        $cart = new Cart;
        $cart->user_id = Auth::user()->id;
        $cart->product_id = $product->id;
        $cart->quantity = 1;
        $cart->save();
        Toastr::success('Product  added to cart', $title = 'Cart', $options = []);

        return redirect()->back();
   }

   public function remove(Cart $cart)
   {
        if($cart->quantity < 2){
            $cart->delete();
        }else{
            $quantity = $cart->quantity;
            $cart->quantity = $quantity - 1;
            $cart->save(); 
        }
        Toastr::error('Product  removed from cart', $title = 'Cart', $options = []);
        return redirect()->back();
   }
   

   public function viewCart()
   {
       $cart_item = Cart::where('user_id',Auth::user()->id)->where('checked',false)->get();
       foreach ($cart_item as $key => $cart) {
           $cart['total'] = $cart->quantity * $cart->product->price;
       }
    //    dd($cart_item->sum('total'));
       return view('cart')->withCarts($cart_item);
   }

   public function destroy(Cart $cart)
   {
       $cart->delete();
        Toastr::error('Product  deleted from cart', $title = 'Cart', $options = []);       
       return redirect()->back();
   }
    
}