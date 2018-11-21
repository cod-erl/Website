<?php

namespace App;

use Auth;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $fillable=['body', 'user_id'];

    protected $appends=['selfMessage'];

    public function selfMessageAttribute()
    {
        return $this->user_id === Auth()->user()->id;
    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }
}
