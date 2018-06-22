<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    //
    use SoftDeletes;

    protected $table = 'comments';

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'video_id', 'body'
    ];

    public function user()
    {
      // code...
      return $this->belongsTo('App\User','user_id');
    }

    public function video()
    {
      // code...
      return $this->belongsTo('App\Video','video_id');
    }
}
