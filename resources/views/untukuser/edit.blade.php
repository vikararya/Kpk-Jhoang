
<div class="container">
    <h2>Edit Data Untuk User</h2>

    <form action="{{ route('untukuser.update', $untukuser->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Logo</label>
            <input type="file" name="logo" class="form-control">
            <img src="{{ asset('storage/' . $untukuser->logo) }}" width="100">
        </div>

        <div class="mb-3">
            <label>Gambar</label>
            <input type="file" name="gambar" class="form-control">
            <img src="{{ asset('storage/' . $untukuser->gambar) }}" width="100">
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ $untukuser->deskripsi }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    </form>
</div>
