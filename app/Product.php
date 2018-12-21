<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];


    public function reviews(){
        return $this->hasMany('App\Review');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function location()
    {
        return $this->belongsTo('App\Location');
    }
    public function county()
    {
        return $this->belongsTo('App\County');
    }
    
    public function carts()
    {
        $this->belongsToMany(Cart::class);
    }
}
