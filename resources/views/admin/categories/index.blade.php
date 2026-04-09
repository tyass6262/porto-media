<!DOCTYPE html>
<html>
<head>
    <title>Kelola Kategori</title>
</head>
<body>

<h2>Kelola Kategori</h2>

<form action="{{ route('admin.categories.store') }}" method="POST">
@csrf

<input type="text" name="name" placeholder="Nama kategori"><br><br>
<input type="text" name="slug" placeholder="Slug"><br><br>

<button type="submit">Tambah</button>
</form>

<hr>

@foreach($categories as $cat)
<div style="border:1px solid #000; padding:10px; margin:10px;">
    <b>{{ $cat->name }}</b>
    ({{ $cat->is_active ? 'Aktif' : 'Nonaktif' }})

    <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Hapus</button>
    </form>
</div>
@endforeach

</body>
</html>