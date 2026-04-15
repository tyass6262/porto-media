<!DOCTYPE html>
<html>
<head>
    <title>Project Saya</title>
</head>
<body>

<h2>Project Saya</h2>

@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

<a href="{{ route('user.projects.create') }}">+ Buat Project</a>

<hr>

@forelse($projects as $project)

    <div style="border:1px solid #ccc; padding:15px; margin-bottom:15px;">

        <h3>{{ $project->title }}</h3>

        <p>{{ $project->description }}</p>

        <p>Status: <b>{{ $project->status }}</b></p>

        <b>Kategori:</b>
        @foreach($project->categories as $cat)
            {{ $cat->name }},
        @endforeach

        <br><br>

        <b>Media Preview:</b><br>

        @foreach($project->media->take(2) as $media)

            @if($media->type == 'image')
                <img src="{{ asset('storage/'.$media->file_path) }}" width="100">
            @elseif($media->type == 'video')
                <video width="120" controls>
                    <source src="{{ asset('storage/'.$media->file_path) }}">
                </video>
            @elseif($media->type == 'embed')
                <iframe width="150" height="100" src="{{ $media->embed_url }}"></iframe>
            @endif

        @endforeach

        <br><br>

        <!-- tombol detail -->
        <a href="{{ route('user.projects.show', $project->id) }}">
            Lihat Detail
        </a>

    </div>

@empty
    <p>Belum ada project</p>
@endforelse

</body>
</html>