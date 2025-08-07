
<div class="container">
    <h3>Edit Rekening</h3>
    <form action="{{ route('rekening.update', $rekening->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>No Rekening</label>
            <input type="text" name="norek" class="form-control" value="{{ $rekening->norek }}" required>
        </div>
        <div class="mb-3">
            <label>Gambar</label><br>
            @if($rekening->gambar)
                <img src="{{ asset('storage/' . $rekening->gambar) }}" width="100" class="mb-2"><br>
            @endif
            <input type="file" name="gambar" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
