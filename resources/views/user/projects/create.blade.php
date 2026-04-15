<!DOCTYPE html>
<html>
<head>
    <title>Buat Project</title>
</head>
<body>

<h2>Buat Project</h2>

<form action="{{ route('user.projects.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- TITLE -->
    <label>Judul</label><br>
    <input type="text" name="title" required><br><br>

    <!-- DESC -->
    <label>Deskripsi</label><br>
    <textarea name="description"></textarea><br><br>

    <!-- CATEGORY -->
    <label>Kategori</label><br>
    @foreach($categories as $cat)
        <input type="checkbox" name="categories[]" value="{{ $cat->id }}">
        {{ $cat->name }} <br>
    @endforeach
    <br>

    <!-- MEDIA -->
    <label>Upload Media</label><br>
    <input type="file" name="media[]" multiple><br><br>

    <!-- EMBED -->
    <label>Embed URL (YouTube dll)</label><br>
    <input type="text" name="embed_urls[]"><br>
    <input type="text" name="embed_urls[]"><br>
    <input type="text" name="embed_urls[]"><br><br>

    <!-- STATUS -->
    <label>Status</label><br>
    <select name="status">
        <option value="draft">Draft</option>
        <option value="published">Publish</option>
    </select><br><br>

    <button type="submit">Simpan</button>
</form>

</body>
</html>