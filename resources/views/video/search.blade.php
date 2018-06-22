@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container">
          <h2>busqueda {{$search}}</h2>

          <form class="col-md-3 pull-right" action="{{url('search/'.$search)}}" method="get">
            <label for="filter">ordenar</label>
            <select class="form-control" name="filter">
              <option value="new">mas nuevo primero</option>
              <option value="old">mas antiguo primero</option>
              <option value="alfa">A-Z</option>
            </select>
          </form>

          @include('video.videoList')
        </div>

    </div>
</div>
@endsection)
