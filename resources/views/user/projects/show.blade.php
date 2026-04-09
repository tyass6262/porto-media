<!DOCTYPE html>
<html>
<head>
    <title>Detail Project</title>
</head>
<body>

<h2>{{ $project->title }}</h2>

<p>{{ $project->description }}</p>

<p>Status: {{ $project->status }}</p>

<hr>

<h3>Kategori</h3>
@foreach($project->categories as $cat)
<span style="background:#ddd; padding:5px;">
    {{ $cat->name }}
</span>
@endforeach

<hr>

<h3>Media</h3>
@foreach($project->media as $media)
<div style="margin-bottom:10px;">
    <p>{{ $media->file_name }}</p>
    <img src="{{ asset('storage/'.$media->file_path) }}" width="200">
</div>
@endforeach

</body>
</html>