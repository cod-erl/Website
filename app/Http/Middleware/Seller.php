<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Seller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // dd( Auth::user());
        if (Auth::check() && Auth::user()->role->name === 'seller') {
            return $next($request);
        }
        return redirect('/');
    }
}