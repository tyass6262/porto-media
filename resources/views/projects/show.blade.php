@extends('layouts.app')

@section('content')

<h2>{{ $project->title }}</h2>

@foreach($project->media as $media)
    @if($media->file_type == 'embed')
        <iframe src="{{ $media->file_path }}"></iframe>
    @else
        <img src="{{ asset('storage/'.$media->file_path) }}" width="200">
    @endif

    @if(auth()->user()->isAdmin())
    <form method="POST" action="/media/{{ $media->id }}">
        @csrf
        @method('DELETE')
        <button>Hapus</button>
    </form>
    @endif

@endforeach

@endsection