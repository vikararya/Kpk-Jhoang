
<div class="container">
    <h2>Tambah Data Untuk User</h2>

    <form action="{{ route('untukuser.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Logo</label>
            <input type="file" name="logo" class="form-control">
        </div>

        <div class="mb-3">
            <label>Gambar</label>
            <input type="file" name="gambar" class="form-control">
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>

