<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //inverse relationships
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
    public function location()
    {
        return $this->belongsTo('App\Location');
    }
    public function county()
    {
        return $this->belongsTo('App\County');
    }
    
}
