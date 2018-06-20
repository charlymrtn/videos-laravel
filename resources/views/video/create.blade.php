@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
<h3>Create a new video</h3>
<hr>
<form class="col-lg-7" action="{{url('save-video')}}" method="post" enctype="multipart/form-data">

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
    <input type="text" id="title" name="title" value="{{old('title')}}" class="form-control">
  </div>
  <div class="form-group">
    <label for="description">Description</label>
    <textarea id="description" class="form-control" name="description" rows="8" cols="80">{{old('description')}}</textarea>
  </div>
  <div class="form-group">
    <label for="image">Image</label>
    <input type="file" id="image" name="image" value="" class="form-control">
  </div>
  <div class="form-group">
    <label for="title">Video File</label>
    <input type="file" id="video" name="video" value="" class="form-control">
  </div>

  <button type="submit" class="btn btn-success" name="button">Create video</button>
</form>
    </div>

  </div>

@endsection
