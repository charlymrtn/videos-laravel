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

          <div id="videos-list">
            @foreach ($videos as $video)
              <div class="video-item col-md-10 pull-left card">
                @if (Storage::disk('images')->has($video->image))
                <img class="card-img-top" src="{{url('miniatura/'.$video->image)}}" alt="Card image cap">
                @endif
                <div class="card-body">
                  <h4 class="card-title"> <a href="#">{{$video->title}}</a></h4>
                  <p class="card-text">{{$video->user->name}}</p>
                </div>

              </div>
              <a href="#" class="btn btn-success">ver</a>
              @if (Auth::check() && Auth::user()->id == $video->user->id)
                <a href="#" class="btn btn-warning">editar</a>
                <a href="#" class="btn btn-danger">eliminar</a>
              @endif
            @endforeach
          </div>
        </div>
        {{$videos->links()}}
    </div>
</div>
@endsection
