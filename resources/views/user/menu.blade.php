@extends('layouts.main')

@section('title', 'Beranda')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 flex flex-col lg:flex-row gap-8">

   {{-- Sidebar Kategori --}}
<aside class="hidden lg:block fixed top-40 left-8 w-64 h-auto max-h-[calc(100vh-10rem)] overflow-y-auto bg-gray-800 border border-gray-300 text-white rounded-xl shadow-lg p-6 z-40">
    <h3 class="text-2xl font-bold mb-4 text-white">Kategori</h3>
    <ul class="space-y-3">
        @foreach ($categories as $category)
            <li>
                <a href="#category-{{ $category->id }}" 
                   class="block px-4 py-2 bg-white/20 text-white rounded-lg hover:bg-white/30 transition duration-200 font-semibold">
                    {{ $category->name }}
                </a>
            </li>
        @endforeach
    </ul>
</aside>

    {{-- Daftar Menu --}}
<main class="w-full lg:w-3/4 ml-0 lg:ml-72 -mt-8">
        <h2 class="text-3xl font-bold text-center mb-6 text-white" style="text-shadow: 2px 2px 0 #000;">
            Daftar Menu
        </h2>

        <form action="{{ route('user.cart.store') }}" method="POST">
            @csrf

            @foreach ($categories as $category)
                <div id="category-{{ $category->id }}" class="mb-12 scroll-mt-24">
                    <h3 class="text-2xl font-semibold text-white mb-6 border-b border border-gray-300 px-4 py-2 bg-[#d2b48c] border-gray-300 pb-2">
                        {{ $category->name }}
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
                        @foreach ($category->menus as $menu)
<div class="rounded-xl overflow-hidden transition duration-300 
    {{ $menu->stock == 0 ? 'bg-gray-800 text-white opacity-70 cursor-not-allowed' : 'bg-white shadow-lg hover:shadow-xl' }}">
                                <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}"
                                     class="w-full h-48 object-cover">
                                <div class="p-3">
                                    <h4 class="text-lg font-bold text-gray-900">{{ $menu->name }}</h4>
                                    <p class="text-sm text-gray-600 mt-1">{{ $menu->description }}</p>
<p class="text-sm text-gray-600">Stok: {{ $menu->stock }}</p>

@php
    $averageRating = $menu->reviews->avg('rating');
@endphp

@if ($averageRating)
    <a href="{{ url('/review?menu_id=' . $menu->id) }}" class="flex items-center mt-1 hover:underline">
        @for ($i = 1; $i <= 5; $i++)
            @if ($i <= $averageRating)
                <span class="text-yellow-400 text-sm">★</span>
            @else
                <span class="text-gray-300 text-sm">★</span>
            @endif
        @endfor
        <span class="ml-2 text-xs text-gray-500">({{ number_format($averageRating, 1) }})</span>
    </a>
@else
    <a href="{{ url('/review?menu_id=' . $menu->id) }}" class="text-xs text-gray-400 mt-1 hover:underline block">
        Belum ada ulasan
    </a>
@endif

                                    @if ($menu->stock == 0)
    <p class="text-red-400 font-semibold mt-1">Stok Habis</p>
@endif
                                    <p class="text-red-600 font-bold mt-2">Rp{{ number_format($menu->price, 0, ',', '.') }}</p>

                                    <div class="mt-2">
                                        <label for="qty-{{ $menu->id }}" class="text-sm text-gray-700">Jumlah</label>
                                      <input 
    type="number" 
    id="qty-{{ $menu->id }}" 
    name="menus[{{ $menu->id }}][quantity]" 
    value="0" 
    min="0" 
    class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-red-300
           {{ $menu->stock == 0 ? 'bg-gray-300 cursor-not-allowed' : '' }}"
    {{ $menu->stock == 0 ? 'disabled' : '' }}
>

{{-- Hidden input agar quantity tetap dikirim saat disabled --}}
@if ($menu->stock == 0)
    <input type="hidden" name="menus[{{ $menu->id }}][quantity]" value="0">
@endif

<input type="hidden" name="menus[{{ $menu->id }}][price]" value="{{ $menu->price }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

    <!-- Tombol Lihat Pesanan (fixed di pojok kanan bawah) -->
<div class="fixed bottom-6 right-12 z-50">
    <button id="openModalBtn"
        class=" bg-[#d2b48c] border border-gray-300 text-white font-semibold px-6 py-2 rounded-full shadow-lg" type="button">
        Lihat Menu Yang Dipilih
    </button>
</div>

<!-- Modal -->
<div id="menuModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-96 max-w-full p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Menu yang Dipilih</h2>
            <button id="closeModalBtn" class="text-gray-500 hover:text-red-500 text-xl font-bold" type="button">&times;</button>
        </div>

        <!-- Daftar menu -->
        <ul id="modalMenuList" class="space-y-2 text-gray-700 max-h-60 overflow-y-auto mb-6">
            <li class="text-sm italic text-gray-500">Belum ada menu yang dipilih.</li>
        </ul>

      <!-- Tombol Checkout -->
<div class="text-center">
    <button 
        id="checkoutBtn"
        type="submit" 
        class="w-full bg-black border border-gray-300 text-white font-bold py-3 px-6 rounded-full shadow-lg transition duration-300 cursor-not-allowed"
        disabled
    >
        Checkout
    </button>
        </div>
    </div>
</div>

<script>
    const menuInputs = document.querySelectorAll('input[type="number"][name^="menus"]');
    const openModalBtn = document.getElementById('openModalBtn');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const menuModal = document.getElementById('menuModal');
    const modalMenuList = document.getElementById('modalMenuList');

   function updateModalMenuList() {
    modalMenuList.innerHTML = '';
    let hasSelected = false;

    menuInputs.forEach(input => {
        const quantity = parseInt(input.value);
        if (quantity > 0 && !input.disabled) {
            const card = input.closest('.p-3');
            const name = card.querySelector('h4').textContent.trim();

            const listItem = document.createElement('li');
            listItem.textContent = `${name} - ${quantity} porsi`;
            modalMenuList.appendChild(listItem);
            hasSelected = true;
        }
    });

    const checkoutBtn = document.getElementById('checkoutBtn');

    if (hasSelected) {
        checkoutBtn.disabled = false;
        checkoutBtn.classList.remove('bg-black', 'cursor-not-allowed');
        checkoutBtn.classList.add('bg-[#d2b48c]', 'cursor-pointer');
    } else {
        modalMenuList.innerHTML = '<li class="text-sm italic text-gray-500">Belum ada menu yang dipilih.</li>';
        checkoutBtn.disabled = true;
        checkoutBtn.classList.remove('bg-[#d2b48c]', 'cursor-pointer');
        checkoutBtn.classList.add('bg-black', 'cursor-not-allowed');
    }
}

    openModalBtn.addEventListener('click', () => {
        updateModalMenuList();
        menuModal.classList.remove('hidden');
    });

    closeModalBtn.addEventListener('click', () => {
        menuModal.classList.add('hidden');
    });

    window.addEventListener('click', (e) => {
        if (e.target === menuModal) {
            menuModal.classList.add('hidden');
        }
    });
</script>

{{-- Smooth Scroll --}}
<script>
    document.querySelectorAll('a[href^="#category-"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
</script>

@endsection
