<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Saran;   
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCategory = Category::count();
        $totalOrdersToday = Order::whereDate('created_at', today())->count();
        $totalSaran = Saran::count();

        // Total Pendapatan dari Pesanan Approved Hari Ini
        $totalRevenueToday = Order::with('items.menu')
            ->whereDate('created_at', today())
            ->where('status', 'approved')
            ->get()
            ->flatMap->items
            ->sum(function ($item) {
                return $item->menu->price * $item->quantity;
            });

       // Data Grafik Pesanan Bulan Ini (Harian)
$startOfMonth = Carbon::now()->startOfMonth();
$endOfMonth = Carbon::now()->endOfMonth();
$datesInMonth = CarbonPeriod::create($startOfMonth, $endOfMonth);

$monthlyOrderChartData = [];
foreach ($datesInMonth as $date) {
    $count = Order::whereDate('created_at', $date)->count();
    $monthlyOrderChartData[] = [
        'date' => $date->format('d M'), // e.g., 01 Jun, 02 Jun
        'count' => $count
    ];

        }

       return view('dashboard', compact(
    'totalCategory',
    'totalOrdersToday',
    'totalSaran',
    'totalRevenueToday',
    'monthlyOrderChartData'
));

    }
  }