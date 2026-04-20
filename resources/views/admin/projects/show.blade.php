<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $project->title }}</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

<style>
body{
    font-family:'Inter',sans-serif;
    background:#0a0f1a;
    color:#f1f5f9;
    margin:0;
}
.container{
    max-width:1000px;
    margin:auto;
    padding:30px;
}
.card{
    background:#111827;
    padding:25px;
    border-radius:12px;
}
.badge{
    padding:5px 10px;
    border-radius:6px;
    font-size:12px;
}
.published{background:#10b98133;color:#10b981;}
.draft{background:#f59e0b33;color:#f59e0b;}

.media-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(250px,1fr));
    gap:15px;
}
.media-card{
    background:#020617;
    border-radius:10px;
    overflow:hidden;
}
.media-card img,
.media-card video,
.media-card iframe{
    width:100%;
    height:200px;
    object-fit:cover;
    border:none;
}
.file-box{
    padding:20px;
    text-align:center;
}
.btn{
    padding:8px 14px;
    border:none;
    border-radius:6px;
    cursor:pointer;
    color:#fff;
}
.btn-danger{background:#ef4444;}
.btn-warning{background:#f59e0b;}
.btn-success{background:#10b981;}
</style>
</head>

<body>

<div class="container">

<a href="{{ route('admin.projects.index') }}">← Kembali</a>

<div class="card">

<h1>{{ $project->title }}</h1>

<p>
Status:
<span class="badge {{ $project->status == 'published' ? 'published' : 'draft' }}">
{{ $project->status }}
</span>
</p>

<p><b>User:</b> {{ $project->user->name }}</p>

<p>{{ $project->description }}</p>

<h3>Kategori</h3>
@foreach($project->categories as $cat)
<span>{{ $cat->name }}</span>
@endforeach

<hr style="margin:20px 0; border-color:#1f2937;">

<h3>Media</h3>

@if($project->media->count())

<div class="media-grid">

@foreach($project->media as $media)

<div class="media-card">

{{-- IMAGE --}}
@if($media->file_type == 'image')
<img src="{{ asset('storage/'.$media->file_path) }}">

{{-- VIDEO --}}
@elseif($media->file_type == 'video')
<video controls>
<source src="{{ asset('storage/'.$media->file_path) }}">
</video>

{{-- EMBED --}}
@elseif($media->file_type == 'embed')

@php
function convertEmbed($url){
    // YouTube
    if(str_contains($url,'watch?v=')){
        return str_replace('watch?v=','embed/',$url);
    }
    if(str_contains($url,'youtu.be/')){
        return str_replace('youtu.be/','youtube.com/embed/',$url);
    }

    // TikTok
    if(str_contains($url,'tiktok.com')){
        preg_match('/video\/(\d+)/',$url,$m);
        return isset($m[1]) ? "https://www.tiktok.com/embed/".$m[1] : $url;
    }

    // Instagram
    if(str_contains($url,'instagram.com')){
        return $url.'/embed';
    }

    return $url;
}
@endphp

<iframe src="{{ convertEmbed($media->embed_url) }}" allowfullscreen></iframe>

{{-- FILE --}}
@else
<div class="file-box">
<a href="{{ asset('storage/'.$media->file_path) }}" target="_blank">
Download File
</a>
</div>
@endif

</div>

@endforeach

</div>

@else
<p>Tidak ada media</p>
@endif

<hr style="margin:20px 0; border-color:#1f2937;">

{{-- ACTION ADMIN --}}
<form action="{{ route('admin.projects.destroy',$project->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger">🗑️ Hapus Project</button>
</form>

</div>
</div>

</body>
</html>