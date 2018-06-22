<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Storage;
use Auth;
use File;

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

      $video = new Video();
      $user = Auth::user();

      $video->user_id = $user->id;
      $video->title = $request->input('title');
      $video->description = $request->input('description');
      $video->status = '1';

      //
      $image = $request->file('image');
      if ($image) {
        // code...
        $image_path = time().$image->getClientOriginalName();
        Storage::disk('images')->put($image_path, File::get($image));
        $video->image = $image_path;
      }

      //
      $video_file = $request->file('video');
      if ($video_file) {
        // code...
        $video_path = time().$video_file->getClientOriginalName();
        Storage::disk('videos')->put($video_path, File::get($video_file));
        $video->video_path = $video_path;
      }

      $video->save();
      return redirect()->route('home')->with(['message'=> 'el video se ha subido correctamente']);
    }

    public function image($filename)
    {
      // code...
      $file = Storage::disk('images')->get($filename);
      return Response($file,200);
    }

    public function video($filename)
    {
      // code...
      $file = Storage::disk('videos')->get($filename);
      return Response($file,200);
    }

    public function show($id)
    {
      // code...
      $video = Video::find($id);
      return view('video.video',compact('video'));
    }
}
