<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Auth;

class CommentController extends Controller
{
    //
    public function store(Request $request)
    {
      // code...
      $validate = $this->validate($request,[
        'body' => 'required'
      ]);

      $user = Auth::user();

      $comment = Comment::create([
        'user_id' => $user->id,
        'video_id' => $request->input('video-id'),
        'body' => $request->input('body')
      ]);

      return redirect()->route('video-detail',['id' => $comment->video_id])->with(['message' => 'comentario añadido']);
    }

    public function delete($id)
    {
      // code...
      $user = Auth::user();
      $comment = Comment::find($id);

      if ($user && ($comment->user_id == $user->id || $comment->video->user_id == $user->id )) {
        // code...
        $comment->delete();
      }

      return redirect()->route('video-detail',['id' => $comment->video_id])->with(['message' => 'comentario borrado']);
    }
}
