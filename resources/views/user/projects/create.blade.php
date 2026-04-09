<!DOCTYPE html>
<html>
<head>
    <title>Tambah Project</title>
</head>
<body>

<h2>Tambah Project</h2>

<form action="{{ route('user.projects.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<label>Title</label><br>
<input type="text" name="title"><br><br>

<label>Description</label><br>
<textarea name="description"></textarea><br><br>

<label>Status</label><br>
<select name="status">
    <option value="draft">Draft</option>
    <option value="published">Published</option>
</select><br><br>

<label>Kategori</label><br>
@foreach($categories as $cat)
<input type="checkbox" name="categories[]" value="{{ $cat->id }}">
{{ $cat->name }}<br>
@endforeach

<br>

<label>Upload Media</label><br>
<input type="file" name="media[]" multiple><br><br>

<button type="submit">Simpan</button>

</form>

</body>
</html>