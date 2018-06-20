@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container">
          @if (session('message'))
            <div class="alert alert-success">
              {{session('message')}}
            </div>
          @endif

          <ul id="videos-list">
            @foreach ($videos as $video)
              <li class="video-item col-md-4 pull-left">

                <div class="data">
                  <h4>{{$video->}}</h4>
                </div>
              </li>

            @endforeach
          </ul>
        </div>
    </div>
</div>
@endsection
