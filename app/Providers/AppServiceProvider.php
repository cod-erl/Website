<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider

{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        view()->composer('layouts.app', function($view){
            if (\Auth::check()) {
                $cart = \App\Cart::where('user_id',\Auth::user()->id)->where('checked', false)->get();
                $view->with('cartItems',$cart);
            }
        });
        view()->composer('layouts.admin', function($view){
            if (\Auth::check()){
                $cart = \App\Account::where('admin_id',\Auth::admin())->where('checked', false)->get();
                $view->with('paymentTotal', $transaction);
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
