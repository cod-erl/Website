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

Route::get('login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::get('login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

Route::prefix('admin')->group(function(){
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard'); 
    Route::get('/manage/buyers', 'AdminController@Buyers')->name('manage.buyers');
    Route::get('/manage/sellers', 'AdminController@Sellers')->name('manage.sellers');
    Route::get('/manage/products', 'AdminController@Products')->name('manage.products'); 
    Route::any('/manage/sellers/destroy/{$id}', 'AdminController@destroy')->name('user.destroy');
    Route::any('/manage/buyers/destroy/{$id}', 'AdminController@destroy')->name('user.destroy');
    Route::any('/manage/products/product/{$id}', 'AdminController@destroyProduct')->name('adminproducts.destroy');
});


//User auth routes

Auth::routes();

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login');

//pages routes
Route::get('/', 'PagesController@index')->name('default');
Route::get('/about', 'PagesController@about')->name('about');
Route::get('/products/all', 'PagesController@products');
Route::get('/Homabay/Items', 'PagesController@homabay')->name('homabay.items');
Route::get('/Migori/Items', 'PagesController@migori')->name('migori.items');
Route::post('/send', 'EmailController@send');


//Contact routes
Route::post('contact', 'ContactController@store')->name('contact.store');
Route::get('contact', 'ContactController@create')->name('contact.create');


//setting the home page to prevent backhistory after log out
Route::group(['middleware' => 'auth', 'PreventBackHistory'],function(){
    Route::get('/home', 'HomeController@index')->name('home');
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
    Route::delete('/orders/destroy/{order}', 'CheckOutController@removeOrder')->name('order.destroy');
});
    

Route::group(['middleware' => 'seller'],function(){
        Route::resource('products','productController'); 
        Route::post('product', 'ProductController@store')->name('product.store');
     });


Route::get('/sms', function () {
    return view('SMS.index');
});

Route::post('/send-sms', [
   'uses'   =>  'SmsController@getUserNumber',
   'as'     =>  'sendSms'
]);