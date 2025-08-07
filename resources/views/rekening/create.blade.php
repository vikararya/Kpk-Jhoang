
<div class="container">
    <h3>Tambah Rekening</h3>
    <form action="{{ route('rekening.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>No Rekening</label>
            <input type="text" name="norek" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Gambar</label>
            <input type="file" name="gambar" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
