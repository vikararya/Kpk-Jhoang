@extends('layouts.admin')

@section('title', 'Pesanan ')

@section('content')
    
        <div class="w-full overflow-x-hidden border-t flex flex-col">
    <main class="w-full flex-grow p-6">
        <div class="container mx-auto my-4 w-full">
            <div class="flex justify-center">
                <div class="w-full lg:w-full">
                    <div x-data="{ open: false }">
                        <!-- Tombol Tambah Kategori -->
                        <button @click="open = true"
                            class="bg-green-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-green-700 transition mb-1 -mt-8">
                            + Tambah Kategori
                        </button>

                        <!-- Modal Tambah -->
                        <div x-show="open" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50" x-cloak>
                            <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-lg">
                                <h2 class="text-xl font-bold mb-4">Tambahkan Kategori</h2>
                                <form action="{{ route('categories.store') }}" method="POST">
                                    @csrf
                                    <label class="block text-sm font-medium text-gray-700 mb-1" for="name">Nama Kategori</label>
                                    <input type="text" name="name" id="name" required
                                        class="w-full border border-gray-300 p-2 rounded mb-4">

                                    <div class="flex justify-end gap-2">
                                        <button type="button" @click="open = false"
                                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                                            Batal
                                        </button>
                                        <button type="submit"
                                            class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                                            Simpan Kategori
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <style>[x-cloak] { display: none !important; }</style>

                    <!-- Header -->
                    <div class="bg-gray-700 mt-6 border border-gray-400 shadow-lg text-white text-center py-3 rounded-t-lg">
                        <h4 class="font-semibold text-xl">Daftar Kategori</h4>
                    </div>

                    <!-- Tabel Kategori -->
                    <div class="p-6 w-full border border-gray-400 shadow-lg rounded-b-lg">
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-center table-auto border-collapse">
                                <thead class="bg-green-600 text-white">
                                    <tr>
                                        <th class="px-4 py-2 border">No</th>
                                        <th class="px-4 py-2 border">Nama Kategori</th>
                                        <th class="px-4 py-2 border">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-800">
                                    @foreach($categories as $category)
                                        <tr class="border-b hover:bg-gray-100">
                                            <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                                            <td class="px-4 py-2 border font-semibold">{{ $category->name }}</td>
                                            <td class="px-4 py-2 border">
<!-- Tombol Edit -->
<button onclick="openModal('modalEdit{{ $category->id }}')" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
    Edit
</button>
<!-- Modal Edit -->
<div id="modalEdit{{ $category->id }}" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
    <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg relative">
        <!-- Tombol close -->
        <button onclick="closeModal('modalEdit{{ $category->id }}')" class="absolute top-2 right-2 text-gray-600 hover:text-gray-800">&times;</button>
        
        <h2 class="text-lg font-semibold mb-4">Edit Kategori</h2>
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name{{ $category->id }}" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                <input type="text" id="name{{ $category->id }}" name="name" value="{{ old('name', $category->name) }}" required
                       class="w-full mt-1 p-2 border rounded border-gray-300 focus:ring focus:ring-blue-200 focus:outline-none">
            </div>

            <div class="flex justify-end space-x-2">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                    Perbarui
                </button>
                <button type="button" onclick="closeModal('modalEdit{{ $category->id }}')" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>
<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }
</script>


<form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit"
        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm"
        onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
        Hapus
    </button>
</form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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