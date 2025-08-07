<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Review Semua Menu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .star {
            cursor: pointer;
            font-size: 20px;
            transition: color 0.2s;
        }
    </style>
</head>
<body class="p-6 font-sans bg-[url('/images/tes.jfif')] bg-cover bg-center">
    <h1 class="text-4xl font-extrabold text-center text-black italic mb-10">Review Menu Makanan</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 mb-6 rounded shadow">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($menus as $menu)
            <div class="bg-white rounded-xl shadow-lg p-5 flex flex-col justify-between">
                {{-- Gambar Menu --}}
                @if($menu->image)
                    <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="w-full h-44 object-cover rounded-lg mb-4">
                @else
                    <div class="w-full h-44 bg-gray-200 flex items-center justify-center rounded-lg mb-4">
                        <span class="text-gray-500 italic text-sm">Gambar tidak tersedia</span>
                    </div>
                @endif

                <div class="flex-1">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $menu->name }}</h2>
                    <p class="text-gray-600 text-sm mb-4">{{ $menu->description }}</p>

                {{-- Daftar Ulasan --}}
<div>
    @if($menu->reviews->count())
        <div class="text-sm text-gray-700 space-y-3 max-h-28 overflow-y-auto pr-1">
            @foreach($menu->reviews as $index => $review)
                <div class="border-b pb-2">
                    {{-- Baris pertama dengan nomor + Nama --}}
                    <div class="grid grid-cols-[30px_80px_1fr]">
                        <div class="font-semibold">{{ $index + 1 }}.</div>
                        <div>Nama</div>
                        <div>: {{ $review->user_name }}</div>
                    </div>

                    {{-- Baris Rating dan Komentar, indentasi sejajar --}}
                    <div class="grid grid-cols-[30px_80px_1fr]">
                        <div></div>
                        <div>Rating</div>
                        <div>: <span class="text-yellow-400">{!! str_repeat('★', $review->rating) !!}</span></div>
                    </div>
                    <div class="grid grid-cols-[30px_80px_1fr]">
                        <div></div>
                        <div>Komentar</div>
                        <div>: <span class="italic text-gray-600">{{ $review->comment }}</span></div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="italic text-gray-400 text-sm">Belum ada review.</p>
    @endif
</div>
</div>

                {{-- Form Tambah Ulasan --}}
                <form action="{{ route('reviews.store') }}" method="POST" class="border-t">
                    @csrf
                    <input type="hidden" name="menu_id" value="{{ $menu->id }}">

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="user_name" required
                               class="mt-1 w-full border border-gray-300 rounded-lg p-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Rating</label>
                        <div class="flex space-x-1 mt-1" data-rating-container="{{ $menu->id }}">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="star text-gray-300 hover:text-yellow-300 active:scale-110 transition" data-value="{{ $i }}" data-menu="{{ $menu->id }}">&#9733;</span>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="rating-input-{{ $menu->id }}" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Komentar</label>
                        <textarea name="comment" rows="2" required
                                  class="mt-1 w-full border border-gray-300 rounded-lg p-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition"></textarea>
                    </div>

                    <div class="text-right">
                        <button type="submit"
                                class="bg-yellow-400 text-white px-4 py-2 rounded-lg text-sm transition">
                            Kirim Ulasan
                        </button>
                    </div>
                </form>
            </div>
        @endforeach
    </div>

    {{-- Script untuk rating bintang --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('[data-rating-container]').forEach(container => {
                const menuId = container.getAttribute('data-rating-container');
                const stars = container.querySelectorAll('.star');
                const hiddenInput = document.getElementById('rating-input-' + menuId);

                stars.forEach(star => {
                    star.addEventListener('click', function () {
                        const value = parseInt(this.getAttribute('data-value'));
                        hiddenInput.value = value;
                        highlightStars(stars, value);
                    });
                });
            });

            function highlightStars(stars, value) {
                stars.forEach((star, index) => {
                    if (index < value) {
                        star.classList.remove('text-gray-300');
                        star.classList.add('text-yellow-400');
                    } else {
                        star.classList.remove('text-yellow-400');
                        star.classList.add('text-gray-300');
                    }
                });
            }
        });
    </script>
</body>
</html>
