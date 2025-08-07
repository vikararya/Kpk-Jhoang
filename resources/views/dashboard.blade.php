@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="w-full overflow-x-hidden border-t flex flex-col bg-gray-100 min-h-screen">
    <main class="w-full flex-grow p-6">

        <h1 class="text-3xl font-semibold mb-6 text-gray-800">Kpk Jhoang Dashboard</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- New Orders -->
           <a href="{{ url('admin/orders') }}">
    <div class="bg-purple-600 text-white rounded-xl shadow-md p-5 hover:bg-purple-700 transition">
        <div class="text-sm">NEW ORDERS</div>
        <div class="text-3xl font-bold">{{ $totalOrdersToday }}</div>
        <div class="text-sm mt-1 opacity-75">Today</div>
    </div>
</a>

            <!-- Total Income -->
            <div class="bg-green-500 text-white rounded-xl shadow-md p-5">
                <div class="text-sm">TOTAL PENDAPATAN</div>
                <div class="text-3xl font-bold">Rp {{ number_format($totalRevenueToday, 0, ',', '.') }}</div>
                <div class="text-sm mt-1 opacity-75">Today</div>
            </div>

          <a href="{{ url('admin/categories') }}" class="block no-underline">
    <div class="bg-blue-500 text-white rounded-xl shadow-md p-5 hover:bg-blue-600 transition">
        <div class="text-sm">TOTAL KATEGORI</div>
        <div class="text-3xl font-bold">{{ $totalCategory }}</div>
        <div class="text-sm mt-1 opacity-75">Aktif</div>
    </div>
</a>

         <a href="{{ url('admin/saran') }}" class="block no-underline">
    <div class="bg-yellow-500 text-white rounded-xl shadow-md p-5 hover:bg-yellow-600 transition">
        <div class="text-sm">TOTAL SARAN</div>
        <div class="text-3xl font-bold">{{ $totalSaran }}</div>
        <div class="text-sm mt-1 opacity-75">Masuk</div>
    </div>
        </div>

</a>

      <div class="mt-10 bg-white rounded-xl shadow-md p-6">
    <div class="text-lg font-semibold text-gray-700 mb-4">Grafik Pesanan Bulan Ini</div>
    <canvas id="monthlyOrderChart" height="100"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctxMonthly = document.getElementById('monthlyOrderChart').getContext('2d');

    const monthlyLabels = @json(array_column($monthlyOrderChartData, 'date'));
    const monthlyData = @json(array_column($monthlyOrderChartData, 'count'));

    new Chart(ctxMonthly, {
        type: 'line', // atau 'bar' jika ingin batang
        data: {
            labels: monthlyLabels,
            datasets: [{
                label: 'Jumlah Pesanan Harian',
                data: monthlyData,
                backgroundColor: 'rgba(34, 197, 94, 0.4)',
                borderColor: 'rgba(34, 197, 94, 1)',
                borderWidth: 2,
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        precision: 0
                    }
                }
            }
        }
    });
</script>

        </div>

    </main>
</div>
@endsection
