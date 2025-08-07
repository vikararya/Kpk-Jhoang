@extends('layouts.main')

@section('title', 'Beranda')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>

<div class="max-w-5xl mx-auto mt-6 p-3">
    <div class="bg-[#f5f5dc] p-3 rounded-xl shadow-md flex flex-col lg:flex-row gap-4">
        
        {{-- Form Input Kiri --}}
        <div class="w-full lg:w-2/3">
            <form action="{{ route('user.cart.process') }}" method="POST" enctype="multipart/form-data" class="space-y-3 text-sm">
                @csrf
                <h2 class="text-xl font-semibold mb-2">Checkout</h2>

                {{-- Nama & Telepon --}}
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block mb-1">Nama</label>
                        <input type="text" name="customer_name" class="w-full border rounded px-2 py-1 focus:ring-green-300" required>
                    </div>
                    <div>
                        <label class="block mb-1">No. Telepon</label>
                        <input type="text" name="phone_number" class="w-full border rounded px-2 py-1 focus:ring-green-300" required>
                    </div>
                </div>

                {{-- Lokasi --}}
                <div>
                    <label class="block mb-1 z-50">Lokasi Pengiriman</label>
                    <div id="map" class="rounded border mb-1 z-50" style="height: 160px;"></div>
                    <input type="hidden" name="latitude" id="latitude">
                    <input type="hidden" name="longitude" id="longitude">
                    <p id="alamat-terpilih" class="text-xs italic text-gray-500">Lokasi terpilih: belum dipilih</p>
                </div>

                {{-- Alamat & Permintaan --}}
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block mb-1">Alamat Detail</label>
                        <textarea name="alamat" class="w-full h-[70px] border rounded px-2 py-1" required></textarea>
                    </div>
                    <div>
                        <label class="block mb-1">Permintaan Pelanggan</label>
                        <textarea name="request_pelanggan" class="w-full h-[70px] border rounded px-2 py-1" placeholder="Tanpa sambal, dll."></textarea>
                    </div>
                </div>

                {{-- Metode Pembayaran --}}
                <div>
                    <label class="block mb-1">Metode Pembayaran</label>
                    <select name="payment_method" id="payment_method" class="w-full border rounded px-2 py-1" required>
                        <option value="">-- Pilih Metode --</option>
                        <option value="BCA">Transfer</option>
                        <option value="COD">COD</option>
                    </select>
                </div>

                {{-- Info Transfer BCA --}}
                <div id="bca-info" class="p-2 bg-white rounded border text-sm" style="display: none;">
                    <h5 class="font-semibold mb-2">Info Rekening</h5>
                    @foreach($rekenings as $rekening)
                        <div class="mb-2 border p-2 rounded bg-gray-50">
                            <p><strong>No:</strong> {{ $rekening->norek }}</p>
                            <img src="{{ asset('storage/' . $rekening->gambar) }}" alt="Logo Bank" class="w-28 mt-1 rounded">
                        </div>
                    @endforeach
                    <div>
                        <label class="block mb-1">Bukti Transfer</label>
                        <input type="file" name="bukti_pembayaran" class="w-full border rounded px-2 py-1">
                    </div>
                </div>
        </div>

      {{-- Ringkasan Kanan --}}
<div class="w-full lg:w-1/3 bg-white h-auto rounded-xl p-4 shadow-sm text-sm">
    <h4 class="text-base font-semibold mb-2">Ringkasan Pesanan</h4>
    
    @php $total = 0; @endphp
    
    @if(count($cart) > 0)
        <p class="text-gray-700 mb-1 font-semibold">Menu:</p>
        <ul class="list-inside text-gray-700 mb-3 max-h-40 overflow-y-auto space-y-1">
            @foreach ($cart as $index => $item)
                @php 
                    $menuName = $menus[$item['menu_id']]->name ?? 'Menu tidak ditemukan';
                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal;
                @endphp
                <li>{{ $index + 1 }}. {{ $menuName }} ({{ $item['quantity'] }})</li>
            @endforeach
        </ul>
    @else
        <p class="text-gray-500 mb-3 italic">Belum ada menu yang dipilih.</p>
    @endif

    <hr class="my-4 border-gray-300">


  <style>
    .info-row {
        display: table;
        margin-bottom: 5px;
    }
    .label,
    .value {
        display: table-cell;
        padding-right: 10px;
    }
    .label {
        font-weight: bold;
        width: 80px; /* atur sesuai kebutuhan */
    }
</style>

<div class="info-row">
    <div class="label">Harga:</div>
    <div class="value">Rp{{ number_format($total, 0, ',', '.') }}</div>
</div>
<div class="info-row">
    <div class="label">Ongkir:</div>
    <div class="value">Rp<span id="totalOngkir">0</span></div>
</div>
<div class="info-row">
    <div class="label">Total:</div>
    <div class="value">Rp<span id="totalHarga">{{ number_format($total, 0, ',', '.') }}</span></div>
</div>

    <input type="hidden" name="ongkir" id="ongkir" value="0">
    <input type="hidden" name="total_price" id="total_price" value="{{ $total }}">

    <div class="mt-4 text-center">
        <button type="button" id="submitOrderBtn" class="px-12 py-1 bg-green-600 text-white rounded hover:bg-green-700">
            Pesan
        </button>
    </div>
</div>

<!-- Modal Konfirmasi -->
<div id="successModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg p-6 max-w-sm text-center shadow-lg">
       <img src="{{ asset('images/centang.jpg') }}" alt="Success" class="mx-auto w-20 mb-3">
        <h2 class="text-lg font-semibold mb-2">Terima kasih telah memesan!</h2>
        <p class="mb-4 text-sm">Silakan cek orderan Anda pada fitur <strong>Orderan Saya</strong>.</p>
        <a href="http://localhost:8000/orderan" class="inline-block bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700">Lihat Orderan Saya</a>
    </div>
</div>

<script>
document.getElementById('submitOrderBtn').addEventListener('click', function () {
    // Validasi lokasi dipilih
    const lat = document.getElementById('latitude').value;
    const lng = document.getElementById('longitude').value;
    if (!lat || !lng) {
        alert("Silakan pilih lokasi pada peta terlebih dahulu.");
        return;
    }

    // Submit form menggunakan AJAX untuk menampilkan modal tanpa reload
    const form = document.querySelector('form');
    const formData = new FormData(form);

    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => {
        if (response.ok) {
            document.getElementById('successModal').classList.remove('hidden');
        } else {
            alert("Terjadi kesalahan saat memproses pesanan.");
        }
    })
    .catch(error => {
        console.error(error);
        alert("Gagal memproses pesanan.");
    });
});
</script>

        </div>

        </form>
    </div>
</div>
<!-- Tambahkan Leaflet.js -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
// Lokasi tetap di Tambakboyo, Kabupaten Tuban (contoh koordinat)
const tambakboyo = { lat: -6.803489, lng: 111.8456 }; // Ganti dengan koordinat yang benar dari Lapangan Tambakboyo

// Membuat peta menggunakan Leaflet.js
const map = L.map('map').setView([tambakboyo.lat, tambakboyo.lng], 13);

// Menambahkan layer tile peta
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Marker untuk lokasi KPK Jhoang Cafe dan Eatery
const marker = L.marker([tambakboyo.lat, tambakboyo.lng]).addTo(map);
marker.bindPopup("KPK Jhoang Cafe & Eatery, Tambakboyo");

// Mengatur peta agar bisa diklik untuk memilih lokasi
map.on('click', function(e) {
    const customerLat = e.latlng.lat;
    const customerLng = e.latlng.lng;

    // Menambahkan marker untuk lokasi yang dipilih
    marker.setLatLng([customerLat, customerLng]);

    // Simpan koordinat ke input tersembunyi
    document.getElementById('latitude').value = customerLat;
    document.getElementById('longitude').value = customerLng;

    // Hitung jarak antara lokasi pelanggan dan Tambakboyo
    const distance = calculateDistance(tambakboyo.lat, tambakboyo.lng, customerLat, customerLng);

    // Tentukan ongkir berdasarkan jarak
    let ongkir = distance <= 3 ? 4500 : 7000;

    // Tampilkan ongkir
    document.getElementById('ongkir').value = ongkir;
    const totalPrice = {{ $total }} + ongkir;
    document.getElementById('totalOngkir').textContent = ongkir;
    document.getElementById('totalHarga').textContent = "" + totalPrice.toLocaleString();
    document.getElementById('total_price').value = totalPrice;

    fetch(`https://nominatim.openstreetmap.org/reverse?lat=${customerLat}&lon=${customerLng}&format=json`)
    .then(response => response.json())
    .then(data => {
        const address = data.address;

        // Coba ambil level desa atau yang sejenis
        const desa = address.village || address.hamlet || address.suburb || address.town || address.neighbourhood;

        // Coba ambil level kecamatan atau yang sejenis
        const kecamatan = address.county || address.city_district || address.state_district;

        let lokasi = '';

        if (desa && kecamatan) {
            lokasi = `Desa ${desa}, Kecamatan ${kecamatan}`;
        } else if (desa) {
            lokasi = `Desa ${desa}`;
        } else if (kecamatan) {
            lokasi = `Kecamatan ${kecamatan}`;
        } else if (data.display_name) {
            lokasi = data.display_name;
        } else {
            lokasi = 'Alamat tidak diketahui';
        }

        const lokasiFormatted = `(${lokasi})`;

        // Tampilkan di textarea dan label
        document.querySelector('textarea[name="alamat"]').value = lokasiFormatted;
        document.getElementById('alamat-terpilih').textContent = `Lokasi terpilih: ${lokasiFormatted}`;
    })
    .catch(error => {
        console.error('Gagal mengambil alamat:', error);
        document.querySelector('textarea[name="alamat"]').value = '(Terjadi kesalahan)';
        document.getElementById('alamat-terpilih').textContent = 'Lokasi terpilih: (Terjadi kesalahan)';
    });


});

// Validasi saat submit: pastikan lokasi dipilih
document.querySelector('form').addEventListener('submit', function (e) {
    const lat = document.getElementById('latitude').value;
    const lng = document.getElementById('longitude').value;

    if (!lat || !lng) {
        e.preventDefault();
        alert("Silakan pilih lokasi pada peta terlebih dahulu.");
    }
});

// Fungsi untuk menghitung jarak antara dua titik koordinat menggunakan Haversine formula
function calculateDistance(lat1, lon1, lat2, lon2) {
    const R = 6371; // Radius bumi dalam km
    const dLat = (lat2 - lat1) * Math.PI / 180;
    const dLon = (lon2 - lon1) * Math.PI / 180;
    const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
              Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
              Math.sin(dLon / 2) * Math.sin(dLon / 2);
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    return R * c; // Jarak dalam km
}
</script>

<script>
    const paymentMethod = document.getElementById('payment_method');
    const buktiPembayaran = document.getElementById('bukti_pembayaran');

    paymentMethod.addEventListener('change', function () {
        const bcaInfo = document.getElementById('bca-info');
        if (this.value === 'BCA') {
            bcaInfo.style.display = 'block';
            buktiPembayaran.setAttribute('required', 'required');
        } else {
            bcaInfo.style.display = 'none';
            buktiPembayaran.removeAttribute('required');
        }
    });
</script>
@endsection