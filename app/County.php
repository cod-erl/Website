<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    //relationships
    public function users(){
        return $this->hasMany('App\User');
    }
    public function products(){
        return $this->hasMany('App\Product');
    }
    public function reviews(){
        return $this->hasMany('App\Review');
    }
    
    public function locations(){
        return $this->hasMany('App\Location');
    }
}
