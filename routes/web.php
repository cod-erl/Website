<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*returning page views*/

// Route::get('/', function(){
//     return view('welcome');
// });

//Admin auth routes

Auth::routes();


//User auth routes

Auth::routes();

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login');

//pages routes
Route::get('/', 'PagesController@index')->name('default');
Route::get('/about', 'PagesController@about')->name('about');
Route::get('/products/all', 'PagesController@products');


//Contact routes
Route::post('contact', 'ContactController@store')->name('contact.store');
Route::get('contact', 'ContactController@create')->name('contact.create');


//setting the home page to prevent backhistory after log out
Route::group(['middleware' => 'auth', 'PreventBackHistory'],function(){
    Route::get('/home', 'HomeController@index')->name('home');
});

Route::group(['middleware' => 'auth'],function(){
    Route::get('/edit_profile/{user_id}', 'UserController@edit')->name('forms.edit_profile');
    Route::post('/update_profile/{user_id}', 'UserController@update')->name('users.update');
    //displaying the messages view
    Route::get('/chat', 'ChatController@index')->name('chat');
    Route::get('/message', 'MessageController@index')->name('message');
    Route::post('/message', 'MessageController@store')->name('message.store');//store message in database
    
}); 

    
    
Route::group(['middleware' => 'buyer'],function(){ 
    Route::post('cart/add/{product}', 'CartController@add')->name('cart.add');
    Route::any('cart/remove/{cart}', 'CartController@remove')->name('cart.remove');
    Route::delete('emptyCart/{cart}', 'CartController@destroy')->name('cart.delete');
    Route::get('/cart','CartController@viewCart');
    Route::get('/checkout', 'CheckOutController@checkoutPage')->name('checkout');
    Route::post('/order', 'CheckOutController@makeOrder')->name('order');
    Route::any('/order/repay{order}', 'CheckOutController@repayOrder')->name('order.repay');
    Route::get('/orders/all', 'OrderController@orders')->name('orders.all');
    Route::delete('/orders/destroy/{order}', 'CheckOutController@removeOrder')->name('orders.destroy');
});
    

Route::group(['middleware' => 'seller'],function(){
        Route::resource('products','productController'); 
        Route::post('product', 'ProductController@store')->name('product.store');
     });


/*
Route::get('/cart', 'CartController')->name('cart');
Route::delete('emptyCart', 'CartController@destroyAll');
*/

Route::get('/sms', function () {
    return view('SMS.index');
});

Route::post('/send-sms', [
   'uses'   =>  'SmsController@getUserNumber',
   'as'     =>  'sendSms'
]);