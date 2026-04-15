<!DOCTYPE html>
<html>
<head>
    <title>Portfolio</title>
</head>
<body>

<h2>Gallery Portfolio</h2>

<!-- FILTER -->
<form method="GET">
    <select name="category">
        <option value="">Semua Kategori</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}">
                {{ $cat->name }}
            </option>
        @endforeach
    </select>

    <button type="submit">Filter</button>
</form>

<hr>

<!-- LIST PROJECT -->
@forelse($projects as $project)

    <div style="border:1px solid #ccc; padding:15px; margin-bottom:15px;">

        <h3>{{ $project->title }}</h3>
        <p>{{ $project->description }}</p>
        <p>By: {{ $project->user->name }}</p>

        <!-- PREVIEW MEDIA -->
        @if($project->media->first())

            @php $media = $project->media->first(); @endphp

            @if($media->type == 'image')
                <img src="{{ asset('storage/'.$media->file_path) }}" width="200">
            @elseif($media->type == 'video')
                <video width="200" controls>
                    <source src="{{ asset('storage/'.$media->file_path) }}">
                </video>
            @elseif($media->type == 'embed')
                <iframe width="200" height="120" src="{{ $media->embed_url }}"></iframe>
            @endif

        @endif

        <br><br>

        <a href="{{ route('portfolio.show', $project->id) }}">
            Lihat Detail
        </a>

    </div>

@empty
    <p>Tidak ada project</p>
@endforelse

</body>
</html>