@extends('layouts.app')

@section('content')

<form method="POST" action="/projects" enctype="multipart/form-data">
@csrf

<input name="title" class="form-control mb-2">
<textarea name="description" class="form-control mb-2"></textarea>

<select name="categories[]" multiple class="form-control mb-2">
@foreach($categories as $cat)
<option value="{{ $cat->id }}">{{ $cat->name }}</option>
@endforeach
</select>

<input type="file" name="media[]" multiple class="form-control mb-2">

<input name="embed_url[]" class="form-control mb-2">

<select name="status" class="form-control mb-2">
<option value="draft">Draft</option>
<option value="published">Publish</option>
</select>

<button class="btn btn-success">Simpan</button>

</form>

@endsection