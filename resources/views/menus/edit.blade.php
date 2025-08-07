<form action="{{ route('menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Nama Menu</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $menu->name }}" required>
    </div>
    <div class="form-group">
        <label for="description">Deskripsi</label>
        <textarea class="form-control" id="description" name="description" required>{{ $menu->description }}</textarea>
    </div>
    <div class="form-group">
        <label for="price">Harga</label>
        <input type="number" class="form-control" id="price" name="price" value="{{ $menu->price }}" required>
    </div>
    <div class="form-group">
        <label for="stock">Stock</label>
        <input type="number" class="form-control" id="stock" name="stock" value="{{ $menu->stock }}" required min="0">
    </div>
    <div class="form-group">
        <label for="category_id">Kategori</label>
        <select class="form-control" id="category_id" name="category_id" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $menu->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="image">Gambar (Kosongkan jika tidak ingin mengubah gambar)</label>
        <input type="file" class="form-control" id="image" name="image">
        @if($menu->image)
            <img src="{{ asset('storage/' . $menu->image) }}" alt="Menu Image" width="150">
        @endif
    </div>
    <button type="submit" class="btn btn-success">Perbarui Menu</button>
</form>
