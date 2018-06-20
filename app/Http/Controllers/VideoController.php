<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Storage;

use Response;

use App\Video;
use App\Comment;


class VideoController extends Controller
{
    //
    public function create()
    {
      // code...
      return view('video.create');
    }

    public function store(Request $request)
    {
      // code...
      $validator = $this->validate($request, [
        'title' => 'required|min:5',
        'description' => 'required',
        'video' => 'mimes:mp4'
      ]);
    }
}
