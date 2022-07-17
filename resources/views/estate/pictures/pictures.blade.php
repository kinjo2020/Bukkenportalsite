<form action="{{ route('estate.picture.store', $bukken->id) }}" method="POST" enctype="multipart/form-data">
  {{ csrf_field() }}
  <input type="file" name="img">
  <input type="submit" value="アップロード">
</form>