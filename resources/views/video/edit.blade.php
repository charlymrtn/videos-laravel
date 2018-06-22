@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <h3>edit video {{$video->title}}</h3>
      <hr>
      <form class="col-lg-7" action="{{url('update-video/'.$video->id)}}" method="post" enctype="multipart/form-data">

        {{ csrf_field() }}
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
              @endforeach
            </ul>
          </div>
        @endif
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" id="title" name="title" value="{{$video->title}}" class="form-control">
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <textarea id="description" class="form-control" name="description" rows="8" cols="80">{{$video->description}}</textarea>
        </div>
        <div class="form-group">
          <label for="image">Image</label>
          @if (Storage::disk('images')->has($video->image))
          <img class="card-img-top" src="{{url('miniatura/'.$video->image)}}" alt="">
          @endif
          <input type="file" id="image" name="image" value="" class="form-control">
        </div>
        <div class="form-group">
          <label for="title">Video File</label>
          <video controls id="video-player">
            <source src="{{url('file/'.$video->video_path)}}">
              tu navegador no es compatible con html 5
          </video>

          <input type="file" id="video" name="video" value="" class="form-control">
        </div>

        <button type="submit" class="btn btn-success" name="button">edit video</button>
      </form>
    </div>
  </div>
@endsection
