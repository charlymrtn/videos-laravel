<hr>
<h4>Comentarios</h4>
<hr>

@if (session('message'))
  <div class="alert alert-success">
    {{session('message')}}
  </div>
@endif

@if (Auth::check())
<form class="col-md-4" action="{{url('comment')}}" method="post">
  {{ csrf_field() }}
  <input type="hidden" class="" name="video-id" value="{{$video->id}}" required>
  <p>
    <textarea class="form-control" name="body" required></textarea>
  </p>
  <input type="submit" name="" value="Comentar" class="btn btn-success">
</form>
@endif

@if (isset($video->comments))
  <br>
  <div id="comments" class="">
    @foreach ($video->comments as $comment)
      <br>
      <div class="comment-item col-md-12 pull-left">
        <div class="card comment-data">
          <div class="card-body">
            <div class="card-title">
                <strong>{{$comment->user->name}}</strong> {{ \FormatTime::LongTimeFilter($comment->created_at) }}
            </div>
            <p class="card-text">
              {{$comment->body}}

              @if (Auth::check() && (Auth::user()->id == $comment->user->id || Auth::user()->id == $video->user->id))
                <div class="pull-right">
                  <!-- Botón en HTML (lanza el modal en Bootstrap) -->
                  <a href="#victorModal{{$comment->id}}" role="button" class="btn btn-small btn-danger" data-toggle="modal">Eliminar</a>

                  <!-- Modal / Ventana / Overlay en HTML -->
                  <div id="victorModal{{$comment->id}}" class="modal fade">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">¿Estás seguro?</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                              </div>
                              <div class="modal-body">
                                  <p>¿Seguro que quieres borrar este comentario del video {{$video->title}}?</p>
                                  <p class="text-warning"><small>{{$comment->body}}</small></p>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                  <a href="{{route('delete-comment',['id'=>$comment->id])}}" type="button" class="btn btn-danger">Eliminar</a>
                              </div>
                          </div>
                      </div>
                  </div>
                </div>

              @endif
            </p>
          </div>
        </div>

      </div>
    @endforeach
  </div>
@endif
