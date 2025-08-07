<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\UntukUser;
use Carbon\Carbon;
use App\Models\Menu;
use Illuminate\Http\Request;

class OrderController extends Controller
{

  public function index()
{
    $today = Carbon::today();
    $orders = Order::with('items.menu')
        ->whereDate('created_at', $today)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('orders.index', compact('orders'));
}

    public function create()
    {
        $menus = Menu::all();
        return view('orders.create', compact('menus'));
    }

    // Fitur ACC pesanan - stok berkurang saat pesanan di-ACC
    public function approve($id)
    {
        $order = Order::with('items.menu')->findOrFail($id);

        foreach ($order->items as $item) {
            $menu = $item->menu;

            // 🔴 Cek apakah stok cukup sebelum mengurangi
            if ($menu->stock < $item->quantity) {
                return redirect()->back()->with('error', "Stok {$menu->name} tidak cukup untuk ACC pesanan ini!");
            }
        }

        // 🔹 Kurangi stok setelah pesanan di-ACC
        foreach ($order->items as $item) {
            $item->menu->decrement('stock', $item->quantity);
        }

        $order->update(['status' => 'approved']);

        return redirect()->route('orders.index')->with('success', "Pesanan ID $id berhasil di-ACC");
    }


    public function reject(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'rejected';
        $order->delivery_status = '-'; // 🔴 Set status pengiriman jadi "-"
        $order->alasan_penolakan = $request->alasan_penolakan;
        $order->save();
    
        return redirect()->back()->with('success', 'Pesanan ditolak dengan alasan.');
    }
    

    public function destroy($id)
{
    $order = Order::findOrFail($id);
    $order->delete();

    return redirect()->route('orders.index')->with('success', "Pesanan ID $id berhasil dihapus");
}

public function updateDeliveryStatus(Request $request, $id)
{
    $order = Order::findOrFail($id);
    $order->update(['delivery_status' => $request->delivery_status]);

    return redirect()->route('orders.index')->with('success', "Status pengiriman Pesanan ID $id diperbarui menjadi {$request->delivery_status}");
}

public function myOrders(Request $request)
{
    // Mulai query untuk mengambil pesanan dengan relasi 'items.menu'
    $query = Order::with('items.menu');

    // Cek jika ada parameter pencarian dan tidak kosong
    if ($request->has('search') && $request->search != '') {
        // Filter berdasarkan nama pelanggan
        $query->where('customer_name', 'like', '%' . $request->search . '%');
    }

    // Ambil pesanan yang sudah difilter
    $orders = $query->get();
            $orders = $query->whereDate('created_at', today())->get(); // hanya hari ini


    // Ambil logo atau informasi lain sesuai kebutuhan
    $logo = UntukUser::first(); // atau model lain sesuai kebutuhan

    // Kembalikan data pesanan ke view
    return view('user.user_orders', compact('orders', 'logo'));
}



    
    
}
