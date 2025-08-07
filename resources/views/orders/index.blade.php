@extends('layouts.admin')

@section('title', 'Pesanan ')

@section('content')
    
        <div class="w-full overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">    
                      <!-- Content -->
      <div class="container mx-auto my-4 w-full">
        <div class="flex justify-center">
            <div class="w-full lg:w-full">
                 <div class="">
    <!-- Header -->
    <div class="bg-gray-600 text-white text-center py-4 rounded-t-lg shadow-md">
        <h4 class="font-bold text-2xl">Orderan KPK Jhoang</h4>
    </div>

    <!-- Table Container -->
    <div class="p-6 w-full bg-white border border-gray-300 rounded-b-lg shadow-md">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-center border border-gray-300">
                <thead class="bg-green-500 text-white">
                    <tr>
                        <th class="py-2 px-4 border">No</th>
                        <th class="py-2 px-4 border">Nama Pelanggan</th>
                        <th class="py-2 px-4 border">No. HP</th>
                        <th class="py-2 px-20 border">Alamat</th>
                        <th class="py-2 px-4 border">Permintaan</th>
                        <th class="py-2 px-4 border">Metode Pembayaran</th>
                        <th class="py-2 px-4 border">Ongkir</th>
                        <th class="py-2 px-4 border">Harga</th>
                        <th class="py-2 px-14 border">Menu Dipesan</th>
                        <th class="py-2 px-4 border">Status</th>
                        <th class="py-2 px-8 border">Status Pengiriman</th>
                        <th class="py-2 px-4 border">Bukti Pembayaran</th>
                        <th class="py-2 px-4 border">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-50">
                    @foreach ($orders as $order)
                        <tr class="hover:bg-gray-100 transition-colors duration-150">
                            <td class="py-2 px-4 border">{{ $loop->iteration }}</td>
                            <td class="py-2 px-4 border">{{ $order->customer_name }}</td>
                            <td class="py-2 px-4 border">{{ $order->phone_number }}</td>
                            <td class="py-2 px-4 border">{{ $order->alamat }}</td>
                            <td class="py-2 px-4 border">{{ $order->request_pelanggan ?? '-' }}</td>
                            <td class="py-2 px-4 border">{{ $order->payment_method }}</td>
                            <td class="py-2 px-4 border">Rp {{ number_format($order->ongkir, 0, ',', '.') }}</td>
                            <td class="py-2 px-4 border">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td class="py-2 px-4 border text-left">
                                <ul class="list-disc list-inside">
                                    @foreach ($order->items as $item)
                                        <li>{{ $item->menu->name }} ({{ $item->quantity }}x)</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="py-2 px-4 border font-semibold">
                                @if ($order->status == 'approved')
                                    <span class="text-green-600">✅ ACC</span>
                                @elseif ($order->status == 'rejected')
                                    <span class="text-red-600">❌ Ditolak</span>
                                @else
                                    <form action="{{ route('orders.approve', $order->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded mb-1">✔ ACC</button>
                                    </form>
                                    <form action="{{ route('orders.reject', $order->id) }}" method="POST" class="inline-block" onsubmit="return rejectOrder(this);">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="alasan_penolakan">
                                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">✖ Tolak</button>
                                    </form>
                                    <script>
                                        function rejectOrder(form) {
                                            const reason = prompt("Masukkan alasan penolakan:");
                                            if (!reason) return false;
                                            form.querySelector('[name="alasan_penolakan"]').value = reason;
                                            return true;
                                        }
                                    </script>
                                @endif
                            </td>
                            <td class="py-2 px-1 border">
                                <form action="{{ route('orders.updateDeliveryStatus', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="delivery_status" onchange="this.form.submit()" class="border border-gray-300 p-1 rounded w-full">
                                        <option value="Sedang Dimasak" {{ $order->delivery_status == 'Sedang Dimasak' ? 'selected' : '' }}>Sedang Dimasak</option>
                                        <option value="Sedang Dikirim" {{ $order->delivery_status == 'Sedang Dikirim' ? 'selected' : '' }}>Sedang Dikirim</option>
                                        <option value="Sudah Diterima" {{ $order->delivery_status == 'Sudah Diterima' ? 'selected' : '' }}>Sudah Diterima</option>
                                    </select>
                                </form>
                            </td>
                            <td class="py-1 px-4 border">
                                @if ($order->payment_method == 'BCA' && $order->bukti_pembayaran)
                                    <a href="{{ asset('storage/' . $order->bukti_pembayaran) }}" target="_blank" class="text-blue-600 hover:underline">Lihat Bukti</a>
                                @else
                                    <span>-</span>
                                @endif
                            </td>
                            <td class="py-2 px-4 border">
                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus orderan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
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
    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    <!-- ChartJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>
</body>
</html>

@endsection