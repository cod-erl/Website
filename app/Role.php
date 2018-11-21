<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //inverse relationships
    public function user()
    {
        return $this->hasMany('App\User');
    }
}