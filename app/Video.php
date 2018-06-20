<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    //
    protected $table = 'videos';

    public function comments()
    {
      // code...
      return $this->hasMany('App\Comment');
    }

    public function user()
    {
      // code...
      return $this->belongsTo('App\User','user_id');
    }
}
