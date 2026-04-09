@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-4">Gallery Project</h1>

<div class="grid grid-cols-3 gap-4">
@foreach($projects as $p)
    <div class="bg-white p-4 shadow rounded">
        <h3 class="font-bold">{{ $p->title }}</h3>

        @if($p->media->first() && $p->media->first()->file_path)
            <img src="{{ asset('storage/'.$p->media->first()->file_path) }}" class="mt-2">
        @endif

        <a href="/project/{{ $p->id }}" class="text-blue-500 mt-2 inline-block">Detail</a>
    </div>
@endforeach
</div>

@endsection