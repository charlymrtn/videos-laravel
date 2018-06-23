@extends('layouts.app')

@section('content')

  <div class="container">
    <div class="row">
      <div class="container">
        <h3> canal de {{$user->name}}</h3>
        

        @include('video.videoList')
      </div>
    </div>
  </div>

@endsection
