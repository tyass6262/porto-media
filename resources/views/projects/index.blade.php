@extends('layouts.app')

@section('content')

<h2>Gallery</h2>

<a href="/projects/create" class="btn btn-success mb-3">Tambah</a>

@foreach($projects as $project)
    <div class="card mb-2 p-2">
        <h5>{{ $project->title }}</h5>
        <a href="/projects/{{ $project->id }}">Detail</a>
    </div>
@endforeach

@endsection