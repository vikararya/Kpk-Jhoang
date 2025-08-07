@extends('layouts.main')

@section('title', 'Kirim Saran')

@section('content')
<style>
    .blur-overlay {
        backdrop-filter: blur(10px);
    }
</style>

{{-- Overlay fullscreen --}}
<div id="overlay" class="fixed inset-0 bg-white/60 flex items-center justify-center blur-overlay {{ session('success') ? 'hidden' : '' }}">
    <div class="text-center">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Masukkan Saran & Masukkan</h1>
        <button onclick="showForm()" class="bg-black text-white px-6 py-2 rounded hover:bg-gray-800 transition">
            Mulai Isi Form
        </button>
    </div>
</div>

{{-- Form Saran --}}
<div id="form-container" class="max-w-lg mx-auto mt-10 p-6 backdrop-blur-md bg-white/20 shadow-md rounded-lg {{ session('success') ? '' : 'hidden' }}">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">📬 Kirim Saran & Masukkan</h2>

 @if(session('success'))
    <div id="success-message" class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

    <form action="{{ route('saran.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="nama" class="block text-gray-700 font-medium">Nama Anda</label>
            <input type="text" name="nama" id="nama" required
                   class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label for="isi" class="block text-gray-700 font-medium">Saran / Masukkan</label>
            <textarea name="isi" id="isi" rows="5" required
                      class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
        </div>
<div class="flex gap-4 justify-end">
    <button type="submit"
            class="bg-white text-black font-semibold px-4 py-2 rounded transition duration-150">
        Kirim Saran
    </button>
    <button type="button" onclick="cancelForm()"
            class="bg-red-500 text-white font-semibold px-4 py-2 rounded hover:bg-red-600 transition">
        Batalkan
    </button>
</div>
    </form>
</div>

{{-- JavaScript untuk transisi --}}
<script>
    function showForm() {
        document.getElementById('overlay').classList.add('hidden');
        document.getElementById('form-container').classList.remove('hidden');
    }

    function cancelForm() {
        document.getElementById('form-container').classList.add('hidden');
        document.getElementById('overlay').classList.remove('hidden');
    }

    // Jika ada pesan sukses, tunggu beberapa detik lalu kembali ke overlay
    window.addEventListener('DOMContentLoaded', () => {
        const successMessage = document.getElementById('success-message');
        if (successMessage) {
            setTimeout(() => {
                document.getElementById('form-container').classList.add('hidden');
                document.getElementById('overlay').classList.remove('hidden');
            }, 3000); // 3 detik
        }
    });
</script>

@endsection
