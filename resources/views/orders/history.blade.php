@extends('layouts.admin')

@section('title', 'Riwayat Pemesanan ')

@section('content')

<style>
@media print {
    body * {
        visibility: hidden;
    }
    .print\:block {
        display: block !important;
    }
    .print\:hidden {
        display: none !important;
    }
    .print-area, .print-area * {
        visibility: visible;
    }
 .print-area {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 90px;
    padding: 20px;
    background: white;
    overflow: visible;
    box-sizing: border-box;
}

    table {
        page-break-inside: auto;
    }
    tr {
        page-break-inside: avoid;
        page-break-after: auto;
    }
}
</style>
     <div class="print-area">
<h2 class="text-xl font-bold mb-4 hidden print:block text-center">Laporan Riwayat Pemesanan - KPK Jhoang</h2>
        <div class="w-full overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">    
                      <!-- Content -->
      <div class="container mx-auto my-4 w-full">
        <div class="flex justify-center">
            <div class="w-full lg:w-full">
            <div class="w-full px-4">
   <form method="GET" action="{{ route('orders.history') }}" class="mb-6 -mt-5 flex flex-wrap items-center gap-4">
    <label for="month" class="text-gray-700 font-medium">Pilih Bulan:</label>
    <input type="month" id="month" name="month" value="{{ $month }}"
           class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
    <button type="submit"
            class="bg-black text-white px-4 py-2 rounded-lg transition duration-200">
        Filter
    </button>
</form>
</div>
<div class="flex justify-between items-center mb-5 print:hidden">
    <button onclick="window.print()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        Cetak Laporan
    </button>
</div>
</div>


</div>
                <div class="mt-6">
    <!-- Header -->
    <div class="bg-gray-700 text-white text-center py-2 -mt-3 rounded-t-lg shadow-md">
        <h4 class="font-bold text-2xl">Riwayat Pemesanan KPK Jhoang</h4>
        <div class="text-right text-sm text-gray-700 mb-4 hidden print:block">
    Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }}
</div>

    </div>

   <!-- Table Container -->
<div class="p-6 bg-white border border-gray-300 rounded-b-lg shadow-md">
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-center border border-gray-300">
            <thead class="bg-green-500 text-white">
                <tr>
                    <th class="px-4 py-2 border border-gray-300">Nama Pelanggan</th>
                    <th class="px-4 py-2 border border-gray-300">Nomor Telepon</th>
                    <th class="px-4 py-2 border border-gray-300">Alamat</th>
                    <th class="px-4 py-2 border border-gray-300">Total Harga</th>
                    <th class="px-4 py-2 border border-gray-300">Status</th>
                    <th class="px-4 py-2 border border-gray-300">Status Pengiriman</th>
                    <th class="px-4 py-2 border border-gray-300">Metode Pembayaran</th>
                    <th class="px-4 py-2 border border-gray-300">Tanggal Order</th>
                </tr>
            </thead>
            <tbody class="bg-gray-50">
                @forelse($orders as $order)
                    <tr class="hover:bg-gray-100 transition-colors duration-150">
                        <td class="px-4 py-2 border border-gray-300">{{ $order->customer_name }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $order->phone_number }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $order->alamat }}</td>
                        <td class="px-4 py-2 border border-gray-300 font-semibold text-green-700">
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-2 border border-gray-300 capitalize">{{ $order->status }}</td>
                        <td class="px-4 py-2 border border-gray-300 capitalize">{{ $order->delivery_status }}</td>
                        <td class="px-4 py-2 border border-gray-300 capitalize">{{ $order->payment_method }}</td>
                        <td class="px-1 py-2 border border-gray-300">{{ \Carbon\Carbon::parse($order->order_date)->format('d-m-Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-4 border border-gray-300 text-gray-500 italic">Tidak ada data pemesanan.</td>
                    </tr>
                @endforelse
            </tbody>

            @if($orders->count() > 0)
            <tfoot>
                <tr class="bg-gray-200 font-semibold">
                    <td colspan="3" class="text-right px-4 py-2 border border-gray-300">Total Keseluruhan:</td>
                    <td class="px-4 py-2 border border-gray-300 text-left text-green-800" colspan="5">
                        Rp {{ number_format($orders->sum('total_price'), 0, ',', '.') }}
                    </td>
                </tr>
            </tfoot>
            @endif
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