<!DOCTYPE html>
<html>
<head>
    <title>My Projects</title>
</head>
<body>

<h2>My Projects</h2>

<a href="{{ route('user.projects.create') }}">+ Tambah Project</a>

<hr>

@foreach($projects as $project)
<div style="border:1px solid #000; padding:10px; margin:10px;">
    <h3>{{ $project->title }}</h3>
    <p>{{ $project->description }}</p>

    <a href="{{ route('user.projects.show', $project->id) }}">Detail</a>

    <form action="{{ route('user.projects.destroy', $project->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Hapus</button>
    </form>
</div>
@endforeach

</body>
</html>