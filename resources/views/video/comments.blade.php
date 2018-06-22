<hr>
<h4>Comentarios</h4>
<hr>
<form class="col-md-4" action="" method="post">
  {{ csrf_field() }}
  <input type="hidden" class="" name="video-id" value="{{$video->id}}" required>
  <p>
    <textarea class="form-control" name="body" required></textarea>
  </p>
  <input type="submit" name="" value="Comentar" class="btn btn-success">
</form>
