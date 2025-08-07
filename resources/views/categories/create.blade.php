<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori</title>
</head>
<body>
    <h1>Tambah Kategori</h1>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Nama Kategori:</label>
            <input type="text" name="name" id="name" required>
        </div>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
