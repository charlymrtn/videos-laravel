<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    //
    use SoftDeletes;

    protected $table = 'videos';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'status'
    ];

    public function comments()
    {
      // code...
      return $this->hasMany('App\Comment','video_id')->orderBy('id','desc');
    }

    public function user()
    {
      // code...
      return $this->belongsTo('App\User','user_id');
    }
}
