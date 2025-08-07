@extends('layouts.admin')

@section('title', 'Nomor Rekening Caffe')

@section('content')
<div class="w-full overflow-x-hidden border-t flex flex-col">
    <main class="w-full flex-grow p-6">
        <div class="max-w-5xl mx-auto">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="bg-gray-700 text-white text-center py-4 px-6 rounded-t-lg">
                    <h2 class="text-2xl font-semibold">Daftar Nomor Rekening</h2>
                </div>

                <div class="px-6 py-4">
                  <button 
    type="button"
    class="inline-block mb-6 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded shadow transition"
    data-modal-target="modalRekening"
    data-modal-toggle="modalRekening">
    + Tambah Rekening
</button>

<!-- Modal -->
<div id="modalRekening" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
        <!-- Close button -->
        <button onclick="document.getElementById('modalRekening').classList.add('hidden')" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
            &times;
        </button>

        <h3 class="text-lg font-semibold mb-4">Tambah Rekening</h3>

        <form action="{{ route('rekening.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="block text-sm">No Rekening</label>
                <input type="text" name="norek" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-3">
    <label class="block text-sm">Nama Bank / Pemilik</label>
    <input type="text" id="editNama" name="nama" class="w-full border px-2 py-1 rounded" required>
</div>

            <div class="mb-3">
                <label class="block text-sm">Gambar</label>
                <input type="file" name="gambar" class="w-full border rounded px-3 py-2">
            </div>
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
        </form>
    </div>
</div>

<script>
    document.querySelectorAll('[data-modal-toggle]').forEach(button => {
        button.addEventListener('click', () => {
            const modalId = button.getAttribute('data-modal-target');
            document.getElementById(modalId).classList.remove('hidden');
        });
    });
</script>

                    @forelse($rekenings as $rekening)
                        <div class="flex flex-col md:flex-row items-center justify-between border-b border-gray-200 py-4">
                            <div class="flex items-center mb-4 md:mb-0">
                                @if($rekening->gambar)
                                    <img src="{{ asset('storage/' . $rekening->gambar) }}"
                                         class="w-24 h-24 object-cover rounded shadow mr-4" alt="Bank Logo">
                                @endif
                                <div>
<div>
    <p class="text-lg font-semibold">Nama: {{ $rekening->nama }}</p>
    <p class="text-gray-700">No. Rekening: {{ $rekening->norek }}</p>
</div>

                                </div>
                            </div>
                            <div class="flex space-x-2">
                              <!-- Tombol Edit -->
<button 
    onclick="openEditModal({{ $rekening->id }}, '{{ $rekening->norek }}', '{{ $rekening->nama }}', '{{ asset('storage/' . $rekening->gambar) }}')"
    class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded shadow transition">
    Edit
</button>


<!-- Modal -->
<div id="editModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <h3 class="text-lg font-semibold mb-4">Edit Rekening</h3>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="block text-sm">No Rekening</label>
                <input type="text" id="editNorek" name="norek" class="w-full border px-2 py-1 rounded" required>
            </div>
            <div class="mb-3">
    <label class="block text-sm">Nama Bank / Pemilik</label>
    <input type="text" id="editNama" name="nama" class="w-full border px-2 py-1 rounded" required>
</div>

            <div class="mb-3">
                <label class="block text-sm">Gambar</label>
                <div id="currentImage" class="mb-2"></div>
                <input type="file" name="gambar" class="w-full border px-2 py-1 rounded">
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeEditModal()" class="mr-2 px-4 py-2 bg-gray-300 rounded">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
  function openEditModal(id, norek, nama, gambarUrl) {
    document.getElementById('editModal').classList.remove('hidden');
    document.getElementById('editNorek').value = norek;
    document.getElementById('editNama').value = nama;
    document.getElementById('editForm').action = `{{ route('rekening.update', '') }}/${id}`;

    const imgHtml = gambarUrl ? `<img src="${gambarUrl}" width="100">` : '';
    document.getElementById('currentImage').innerHTML = imgHtml;
}


    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }
</script>


                                <form action="{{ route('rekening.destroy', $rekening->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus rekening ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded shadow transition">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500">Belum ada data rekening.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
