{{-- File: resources/views/home.blade.php --}}
@extends('layouts.main')

@section('title', 'Beranda')

@section('content')

<!-- Popup Rating -->
<div id="ratingPopup" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl p-6 w-[90%] max-w-md text-center">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Terima Kasih!</h3>
        <p class="text-gray-700 mb-6">Apakah Anda pernah memesan? Bisa isi rating pada menu kami yaa.  Terima kasih.</p>
        <div class="flex justify-center gap-4">
            <button id="closePopupBtn" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">
                Nanti saja
            </button>
            <a href="{{ url('/reviews') }}" class="bg-blue-600  text-white px-4 py-2 rounded">
                Beri Rating
            </a>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const popup = document.getElementById('ratingPopup');
        const closeBtn = document.getElementById('closePopupBtn');

        // Tampilkan popup setelah 3 detik
        setTimeout(() => {
            popup.classList.remove('hidden');
        }, 3000);

        // Tutup popup saat tombol diklik
        closeBtn.addEventListener('click', () => {
            popup.classList.add('hidden');
        });
    });
</script>

<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-semibold text-white text-center mb-4">Pesanan Masuk</h2>
    <p class="text-white text-center mb-6">Tanggal: {{ \Carbon\Carbon::today()->format('d F Y') }}</p>

       <form method="GET" action="{{ route('orders.my') }}" class="mb-8 flex justify-center">
        <input
            type="text"
            name="search"
            placeholder="🔍 Cari nama pelanggan..."
            value="{{ request()->search }}"
            class="p-2 w-full max-w-md border border-gray-300 rounded-l-lg focus:outline-none focus:ring focus:border-blue-300"
        >
        <button type="submit" class="bg-blue-600 text-white px-4 rounded-r-lg hover:bg-blue-700">
            Cari
        </button>
    </form>


    <div class="flex overflow-x-auto space-x-6 pb-6" id="orders-container">
        @forelse ($orders as $order)
            <div class="bg-white shadow-lg rounded-lg p-4 min-w-[300px] max-w-[350px] flex-shrink-0 order-card ml-6">
                <div class="flex flex-col justify-between mb-4 text-left">
                    <div class="text-gray-800">
                        <h3 class="text-lg font-semibold mb-2">Informasi Pelanggan</h3>
                        <p><strong>Nama:</strong> {{ $order->customer_name }}</p>
@php
    $alamat = $order->alamat;

    // Masking langsung di callback
    $maskedAlamat = preg_replace_callback('/Desa (\w+)/i', function ($matches) {
        $nama = $matches[1];
        return 'Desa ' . substr($nama, 0, 3) . str_repeat('*', max(strlen($nama) - 3, 0));
    }, $alamat);

    $maskedAlamat = preg_replace_callback('/Kecamatan (\w+)/i', function ($matches) {
        $nama = $matches[1];
        return 'Kecamatan ' . substr($nama, 0, 2) . str_repeat('*', max(strlen($nama) - 2, 0));
    }, $maskedAlamat);
@endphp

<p><strong>Alamat:</strong> {{ $maskedAlamat }}</p>

                    </div>
                    <div class="mt-4">
                        <p><strong>Status Pesanan:</strong>
                            @if ($order->status === 'approved')
                                <span class="inline-block bg-green-100 text-green-800 text-xs font-semibold px-2 py-1 rounded">Disetujui</span>
                            @elseif ($order->status === 'rejected')
                                <span class="inline-block bg-red-100 text-red-800 text-xs font-semibold px-2 py-1 rounded">Ditolak</span><br>
                                <strong>Alasan:</strong> {{ $order->alasan_penolakan }}
                            @else
                                <span class="inline-block bg-yellow-100 text-yellow-800 text-xs font-semibold px-2 py-1 rounded">Menunggu</span>
                            @endif
                        </p>
                        <p><strong>Metode Pembayaran:</strong> {{ $order->payment_method }}</p>
                        <p><strong>Status Pengiriman:</strong> {{ $order->delivery_status ?? 'Belum dikirim' }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-gray-800 text-white shadow-lg rounded-lg p-4 min-w-[300px] max-w-[350px] flex-shrink-0 flex items-center ml-[84vh] justify-center">
                <p class="text-center font-bold">Tidak ada pesanan ditemukan.</p>
            </div>
        @endforelse
    </div>
</div>

<script>
    function filterOrders() {
        const searchQuery = document.getElementById('search').value.toLowerCase();
        const orders = document.querySelectorAll('.order-card');

        orders.forEach(order => {
            const customerName = order.querySelector('p strong').textContent.toLowerCase();
            if (customerName.includes(searchQuery)) {
                order.style.display = 'block';
            } else {
                order.style.display = 'none';
            }
        });
    }
</script>

@endsection
