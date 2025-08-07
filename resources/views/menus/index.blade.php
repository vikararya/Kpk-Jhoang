@extends('layouts.admin')

@section('title', 'Pesanan ')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

        <div class="w-full overflow-x-hidden  flex flex-col">
            <!-- Wrapper AlpineJS -->
<div x-data="{ open: false }">
    <!-- Tombol Buka Modal -->
    <button @click="open = true"
        class="bg-green-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-green-700 transition mb-2 mt-5">
        + Tambah Menu
    </button>

    <!-- Modal -->
    <div x-show="open" x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6">
            <!-- Header -->
            <div class="flex justify-between items-center border-b pb-2 mb-4">
                <h2 class="text-xl font-bold">Tambahkan Menu</h2>
                <button @click="open = false" class="text-gray-500 hover:text-red-600 text-xl">&times;</button>
            </div>

            <!-- Form -->
            <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-2">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Menu</label>
                    <input type="text" id="name" name="name" required
                        class="w-full border border-gray-300 p-1 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div class="mb-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea id="description" name="description" required rows="3"
                        class="w-full border border-gray-300 p-1 rounded focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
                </div>

                <div class="mb-2">
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                    <input type="number" id="price" name="price" required
                        class="w-full border border-gray-300 p-1 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div class="mb-2">
                    <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Stock</label>
                    <input type="number" id="stock" name="stock" required min="0"
                        class="w-full border border-gray-300 p-1 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div class="mb-2">
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <select id="category" name="category_id" required
                        class="w-full border border-gray-300 p-1 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-2">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
                    <input type="file" id="image" name="image" required
                        class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <!-- Tombol -->
                <div class="flex justify-end gap-2">
                    <button type="button" @click="open = false"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                        Simpan Menu
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>

      <div class="bg-gray-700 mt-4 border border-gray-500 shadow-lg text-white text-center py-4 rounded-t-lg">
    <h4 class="font-semibold text-xl">Menu KPK Jhoang</h4>
</div>

<div class="p-6 w-full border border-gray-300 shadow-lg bg-white">
    <div class="overflow-x-auto">
        <table class="min-w-full border-collapse table-auto text-center">
            <thead class="bg-green-600 text-white">
                <tr>
                    <th class="border px-4 py-2">No</th>
                    <th class="border px-4 py-2">Nama Menu</th>
                    <th class="border px-4 py-2">Deskripsi</th>
                    <th class="border px-4 py-2">Harga</th>
                    <th class="border px-4 py-2">Stock</th>
                    <th class="border px-4 py-2">Kategori</th>
                    <th class="border px-4 py-2">Gambar</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-800 bg-white">
                @foreach($menus as $menu)
                <tr class="hover:bg-gray-100">
                    <td class="border px-4 py-3">{{ $loop->iteration }}</td>
                    <td class="border px-4 py-3 font-semibold">{{ $menu->name }}</td>
                    <td class="border px-4 py-3">{{ $menu->description }}</td>
                    <td class="border px-4 py-3 text-green-600 font-bold">Rp {{ number_format($menu->price, 2) }}</td>
                    <td class="border px-4 py-3 text-blue-500 font-semibold">{{ $menu->stock }}</td>
                    <td class="border px-4 py-3">{{ $menu->category->name }}</td>
                    <td class="border px-4 py-3">
                        <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="w-20 h-auto mx-auto rounded shadow">
                    </td>
                    <td class="border px-4 py-3">
                        <div class="flex justify-center items-center space-x-2">
       <!-- Modal Trigger -->
<div x-data="{ openModal{{ $menu->id }}: false }" class="inline">
    <button @click="openModal{{ $menu->id }} = true"
        class="inline-flex items-center bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium px-3 py-1.5 rounded-lg shadow">
         Edit
    </button>

    <!-- Modal -->
    <div x-show="openModal{{ $menu->id }}" class="fixed inset-0 z-40 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
        <div @click.away="openModal{{ $menu->id }} = false"
            class="bg-white rounded-lg p-6 w-full max-w-2xl shadow-xl relative z-50">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Edit Menu</h2>

          <form action="{{ route('menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
    @csrf
    @method('PUT')

    <div>
        <label class="block text-sm font-medium text-gray-700">Nama Menu</label>
        <input type="text" name="name" value="{{ $menu->name }}" required
            class="w-full px-2 py-1 text-sm border rounded-md focus:ring focus:ring-green-300 focus:outline-none">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
        <textarea name="description" rows="2" required
            class="w-full px-2 py-1 text-sm border rounded-md focus:ring focus:ring-green-300 focus:outline-none">{{ $menu->description }}</textarea>
    </div>

    <div class="grid grid-cols-2 gap-2">
        <div>
            <label class="block text-sm font-medium text-gray-700">Harga</label>
            <input type="number" name="price" value="{{ $menu->price }}" required
                class="w-full px-2 py-1 text-sm border rounded-md focus:ring focus:ring-green-300 focus:outline-none">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Stock</label>
            <input type="number" name="stock" value="{{ $menu->stock }}" min="0" required
                class="w-full px-2 py-1 text-sm border rounded-md focus:ring focus:ring-green-300 focus:outline-none">
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Kategori</label>
        <select name="category_id" required
            class="w-full px-2 py-1 text-sm border rounded-md focus:ring focus:ring-green-300 focus:outline-none">
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $menu->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Gambar</label>
        <input type="file" name="image"
            class="w-full px-2 py-1 text-sm border rounded-md focus:outline-none">
        @if($menu->image)
            <img src="{{ asset('storage/' . $menu->image) }}" class="w-20 mt-2 rounded shadow">
        @endif
    </div>

    <div class="flex justify-end space-x-2 pt-2">
        <button type="button" @click="openModal{{ $menu->id }} = false"
            class="px-3 py-1 text-sm bg-gray-400 hover:bg-gray-500 text-white rounded">Batal</button>
        <button type="submit"
            class="px-3 py-1 text-sm bg-green-600 hover:bg-green-700 text-white rounded">Perbarui</button>
    </div>
</form>
    </div>
    </div>
    </div>


        <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini?');">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-3 py-1.5 rounded-lg shadow">
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