<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Menu</title>
</head>
<body>
    <h1>Tambah Menu</h1>
    <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="name">Nama Menu:</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="description">Deskripsi:</label>
            <textarea name="description" id="description" required></textarea>
        </div>
        <div>
            <label for="price">Harga:</label>
            <input type="number" name="price" id="price" required>
        </div>
        <div>
            <label for="category_id">Kategori:</label>
            <select name="category_id" id="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="image">Gambar Menu:</label>
            <input type="file" name="image" id="image" accept="image/*" required>
        </div>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
