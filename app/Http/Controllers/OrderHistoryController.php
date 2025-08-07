<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderHistoryController extends Controller
{
  public function index(Request $request)
{
    $month = $request->input('month'); // Format: YYYY-MM

    $orders = Order::when($month, function ($query) use ($month) {
            [$year, $monthNum] = explode('-', $month);
            return $query->whereYear('created_at', $year)
                         ->whereMonth('created_at', $monthNum);
        })
        ->where('status', 'approved') // ✅ Hanya tampilkan yang approved
        ->orderBy('created_at', 'desc')
        ->get();

    return view('orders.history', compact('orders', 'month'));
}

}
