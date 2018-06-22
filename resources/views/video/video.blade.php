@extends('layouts.app')

@section('content')

  <div class="col-md-10 col-md-offset-1">
    <h2>{{$video->title}}</h2>
    <hr>
    <div class="col-md-8">
      <video controls id="video-player">
        <source src="{{url('file/'.$video->video_path)}}">
          tu navegador no es compatible con html 5
      </video>
      <div class="card video-data">
        <div class="card-body">
          <div class="card-title">
              subido por <strong>{{$video->user->name}}</strong> {{ \FormatTime::LongTimeFilter($video->created_at) }}
          </div>
          <p class="card-text">{{$video->description}}</p>
        </div>
      </div>
    </div>
  </div>

@endsection
