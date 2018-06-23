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
use App\User;

class UserController extends Controller
{
    //
    public function channel($id)
    {
      // code...
      $user = User::find($id);
      //$videos = $user->videos;
      //$videos->paginate(2);

      if (!is_object($user)) {
        // code...
        return redirect('home');
      }
      $videos = Video::where('user_id',$id)->paginate(2);

      return view('user.channel',compact('user','videos'));
    }
}
