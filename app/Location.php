<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class location extends Model
{
    //relationships
    public function users(){
        return $this->hasMany('App\User');
    }
    public function products(){
        return $this->hasMany('App\Product');
    }    
    public function county(){
        return $this->belongsTo('App\County');
    }
}