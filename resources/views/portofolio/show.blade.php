<!DOCTYPE html>
<html>
<head>
    <title>Detail Portfolio</title>
</head>
<body>

<a href="{{ route('portfolio') }}">← Kembali</a>

<h1>{{ $project->title }}</h1>
<p>{{ $project->description }}</p>
<p>By: {{ $project->user->name }}</p>

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

    @if($media->type == 'image')
        <img src="{{ asset('storage/'.$media->file_path) }}" width="300">

    @elseif($media->type == 'video')
        <video width="400" controls>
            <source src="{{ asset('storage/'.$media->file_path) }}">
        </video>

    @elseif($media->type == 'file')
        <a href="{{ asset('storage/'.$media->file_path) }}">Download File</a>

    @elseif($media->type == 'embed')
        <iframe width="400" height="250" src="{{ $media->embed_url }}"></iframe>
    @endif

@endforeach

</body>
</html>