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

    public function delete($id)
    {
      // code...
      $user = Auth::user();
      $video = Video::find($id);
      $comments = Comment::where('video_id',$id)->get();

      if ($user && $video->user_id == $user->id) {
        // code...
        $comments->each->delete();

        Storage::disk('images')->delete($video->image);
        Storage::disk('videos')->delete($video->video_path);

        $video->delete();

        $message = ['message'=> 'video eliminado'];
      }else {
        // code...
        $message = ['message'=> 'problema al eliminar video'];
      }
      return redirect()->route('home')->with($message);
    }

    public function edit($id)
    {
      // code...
      $video = Video::findOrFail($id);
      $user = Auth::user();
      if ($user && $video->user_id == $user->id) {
          return view('video.edit',compact('video'));
      }else {
        return redirect('home');
      }


    }

    public function update(Request $request, $id)
    {
      // code...
      $validator = $this->validate($request, [
        'title' => 'required|min:5',
        'description' => 'required',
        'video' => 'mimes:mp4'
      ]);

      $video = Video::findOrFail($id);
      $user = Auth::user();

      $video->user_id = $user->id;
      $video->title = $request->input('title');
      $video->description = $request->input('description');

      $image = $request->file('image');
      if ($image) {
        // code...
        if (Storage::disk('images')->has($video->image)) {
          // code...
            Storage::disk('images')->delete($video->image);
        }

        $image_path = time().$image->getClientOriginalName();
        Storage::disk('images')->put($image_path, File::get($image));
        $video->image = $image_path;
      }

      //
      $video_file = $request->file('video');
      if ($video_file) {
        // code...
        if (Storage::disk('videos')->has($video->video_path)) {
          // code...
          Storage::disk('videos')->delete($video->video_path);
        }

        $video_path = time().$video_file->getClientOriginalName();
        Storage::disk('videos')->put($video_path, File::get($video_file));
        $video->video_path = $video_path;
      }

      $video->update();

      return redirect('home')->with(['message' => 'video editado']);

    }

    public function search($search = null)
    {
      // code...
      if (is_null($search)) {
        // code...
        $search = \Request::get('search');
        return redirect()->route('search-video',['search' => $search]);
      }
      $videos = Video::where('title','LIKE',"%$search%")->paginate(2);

      return view('video.search',compact('videos','search'));
    }
}
