<!-- resources/views/categories/edit.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori</title>
</head>
<body>
    <div style="margin: 20px;">
        <h1>Ubah Kategori</h1>

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
            <!-- Laravel CSRF token -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="PUT">

            <div style="margin-bottom: 10px;">
                <label for="name">Nama Kategori</label>
                <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required style="width: 100%; padding: 8px;">
                <!-- Display errors if any -->
                @if($errors->has('name'))
                    <div style="color: red; font-size: 12px;">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>

            <button type="submit" style="padding: 10px 20px; background-color: green; color: white; border: none;">Perbarui</button>
            <a href="/categories" style="padding: 10px 20px; background-color: gray; color: white; text-decoration: none;">Kembali</a>
        </form>
    </div>
</body>
</html>
