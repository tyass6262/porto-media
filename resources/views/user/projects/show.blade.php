<!DOCTYPE html>
<html>
<head>
    <title>Detail Project</title>
</head>
<body>

<h2>Detail Project</h2>

<a href="{{ route('user.projects.index') }}">← Kembali</a>

<hr>

<h1>{{ $project->title }}</h1>
<p>{{ $project->description }}</p>
<p>Status: <b>{{ $project->status }}</b></p>
<p>Dibuat oleh: {{ $project->user->name }}</p>

<hr>

<h3>Kategori:</h3>
<ul>
    @foreach($project->categories as $cat)
        <li>{{ $cat->name }}</li>
    @endforeach
</ul>

<hr>

<h3>Media:</h3>

@foreach($project->media as $media)

    <div style="margin-bottom:20px;">

        {{-- IMAGE --}}
        @if($media->type == 'image')
            <img src="{{ asset('storage/'.$media->file_path) }}" width="300">

        {{-- VIDEO --}}
        @elseif($media->type == 'video')
            <video width="400" controls>
                <source src="{{ asset('storage/'.$media->file_path) }}">
            </video>

        {{-- FILE --}}
        @elseif($media->type == 'file')
            <a href="{{ asset('storage/'.$media->file_path) }}" target="_blank">
                Download File
            </a>

        {{-- EMBED --}}
        @elseif($media->type == 'embed')
            <iframe width="400" height="250"
                src="{{ $media->embed_url }}"
                frameborder="0"
                allowfullscreen>
            </iframe>
        @endif

    </div>

@endforeach

<hr>

@if($project->media->count() == 0)
    <p>Tidak ada media</p>
@endif

</body>
</html>