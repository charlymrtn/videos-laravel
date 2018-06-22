<div id="videos-list">
  @if (count($videos) >= 1)
    @foreach ($videos as $video)
      <br>
    <div class="video-item col-md-10 pull-left card">
      @if (Storage::disk('images')->has($video->image))
      <img class="card-img-top" src="{{url('miniatura/'.$video->image)}}" alt="Card image cap">
      @endif
      <div class="card-body">
        <h4 class="card-title"> <a href="{{url('video/'.$video->id)}}">{{$video->title}}</a></h4>
        <p class="card-text">{{$video->user->name}}</p>
      </div>

    </div>

    <a href="{{url('video/'.$video->id)}}" class="btn btn-success">Ver</a>
    @if (Auth::check() && Auth::user()->id == $video->user->id)
      <a href="{{url('edit-video/'.$video->id)}}" class="btn btn-warning">Editar</a>
      <!-- Botón en HTML (lanza el modal en Bootstrap) -->
      <a href="#victorModal{{$video->id}}" role="button" class="btn btn-danger" data-toggle="modal">Eliminar</a>

      <!-- Modal / Ventana / Overlay en HTML -->
      <div id="victorModal{{$video->id}}" class="modal fade">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">¿Estás seguro?</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                  </div>
                  <div class="modal-body">
                      <p>¿Seguro que quieres borrar el video {{$video->title}}?</p>
                      <p class="text-warning"><small>{{$video->user->name}}</small></p>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <a href="{{route('delete-video',['id'=>$video->id])}}" type="button" class="btn btn-danger">Eliminar</a>
                  </div>
              </div>
          </div>
      </div>

    @endif
  @endforeach
  @else
    <div class="alert alert-warning">
      No hay videos con esa busqueda
    </div>
  @endif

  <div class="clearfix">

  </div>
  <br>
  {{$videos->links()}}
</div>
