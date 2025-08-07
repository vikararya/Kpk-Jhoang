@extends('layouts.admin')

@section('title', 'Pesanan ')

@section('content')
    
    <div class="w-full overflow-x-auto border-t flex flex-col">
    <main class="w-full flex-grow p-6">    
        <!-- Content -->
        <div class="container mx-auto my-4 w-full max-w-7xl">
            <div class="flex justify-center">
                <div class="w-full lg:w-full">
                    
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-8">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="bg-green-600 border border-green-600 shadow-lg text-white text-center py-3 rounded-t-lg mb-0">
                        <h4 class="font-semibold text-xl">Untuk Tampilan User KPK Jhoang</h4>
                    </div>

                    <div class="p-6 w-full border border-green-600 shadow-lg rounded-b-lg overflow-x-auto">
                        <table class="min-w-full table-fixed border-collapse border border-gray-300 text-center align-middle">
                            <thead class="bg-green-400 text-white">
                                <tr>
                                    <th class="border border-gray-300 px-4 py-2 w-32">Logo</th>
                                    <th class="border border-gray-300 px-4 py-2 w-32">Gambar</th>
                                    <th class="border border-gray-300 px-4 py-2">Deskripsi</th>
                                    <th class="border border-gray-300 px-4 py-2 w-24">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white text-gray-800">
                                @foreach($untukuser as $item)
                                <tr class="hover:bg-green-50">
                                    <td class="border border-gray-300 px-4 py-2">
                                        <img src="{{ asset('storage/' . $item->logo) }}" alt="Logo" class="mx-auto w-24 h-auto object-contain">
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="Gambar" class="mx-auto w-24 h-auto object-contain">
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 text-left px-6">
                                        {{ $item->deskripsi }}
                                    </td>
                                                                        <td class="border border-gray-300 px-4 py-2 align-middle">
<div class="flex justify-end items-center space-x-2" x-data="{ open: false }">
        <!-- Tombol Edit -->
        <button 
            @click="open = true" 
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300"
        >
            Edit
        </button>

        <!-- Tombol Hapus -->
        <form action="{{ route('untukuser.destroy', $item->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button 
                type="submit" 
                class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md shadow-sm transition duration-200"
                onclick="return confirm('Apakah Anda yakin ingin menghapus untuk user ini?');"
            >
                Hapus
            </button>
        </form>

       <!-- Modal Edit -->
<div 
    x-show="open" 
    x-cloak 
    class="fixed inset-0 bg-gray-900 bg-opacity-60 flex items-center justify-center z-50"
>
  <div 
    class="bg-white rounded-lg shadow-lg w-full max-w-lg p-4 relative mx-auto"
    @click.away="open = false"
    role="dialog"
    aria-modal="true"
    aria-labelledby="modal-title"
    style="max-height: 90vh; overflow-y: auto;"
>
    <h2 id="modal-title" class="text-xl font-semibold mb-4 text-gray-800 text-center">Edit Data Untuk User</h2>

    <form action="{{ route('untukuser.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="logo" class="block text-gray-700 font-medium mb-1">Logo</label>
            @if($item->logo)
                <img src="{{ asset('storage/' . $item->logo) }}" alt="Logo" class="mt-1 mb-2 w-20 rounded-md shadow-sm object-contain">
            @endif
            <input 
                type="file" 
                name="logo" 
                id="logo"
                class="block w-full text-gray-700 border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <div>
            <label for="gambar" class="block text-gray-700 font-medium mb-1">Gambar</label>
            @if($item->gambar)
                <img src="{{ asset('storage/' . $item->gambar) }}" alt="Gambar" class="mt-1 mb-2 w-20 rounded-md shadow-sm object-contain">
            @endif
            <input 
                type="file" 
                name="gambar" 
                id="gambar"
                class="block w-full text-gray-700 border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <div>
            <label for="deskripsi" class="block text-gray-700 font-medium mb-1">Deskripsi</label>
            <textarea 
                name="deskripsi" 
                id="deskripsi" 
                rows="3" 
                class="block w-full border border-gray-300 rounded-md p-2 resize-y focus:outline-none focus:ring-2 focus:ring-blue-500"
                >{{ $item->deskripsi }}</textarea>
        </div>

        <div class="flex justify-end space-x-3 pt-2">
            <button 
                type="button" 
                class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-100 transition"
                @click="open = false"
            >
                Batal
            </button>
            <button 
                type="submit" 
                class="px-4 py-2 rounded-md bg-blue-600 text-white font-semibold hover:bg-blue-700 transition"
            >
                Simpan Perubahan
            </button>
            </div>
        </form>
    </div>
</div>
<style>
    [x-cloak] {
        display: none !important;
    }
</style>
@endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>

<script>
  // Toggle Sidebar on Mobile
  const menuToggle = document.getElementById('menu-toggle');
  const sidebar = document.querySelector('.lg\\:hidden');

  menuToggle.addEventListener('click', () => {
      sidebar.classList.toggle('hidden');
  });
</script>
                    
  <!-- AlpineJS -->
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <!-- Font Awesome -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
  <!-- ChartJS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>
</body>
</html>

@endsection