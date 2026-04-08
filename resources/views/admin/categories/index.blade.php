@extends('layouts.app')

@section('content')

<h2>Category</h2>

<form method="POST" action="/categories">
@csrf
<input name="name">
<input name="slug">
<button>Tambah</button>
</form>

@foreach($categories as $cat)
<div>
{{ $cat->name }}
<form method="POST" action="/categories/{{ $cat->id }}">
@csrf
@method('DELETE')
<button>Hapus</button>
</form>
</div>
@endforeach

@endsection