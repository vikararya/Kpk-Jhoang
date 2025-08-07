<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Rekening;
use App\Models\UntukUser;
use App\Models\Menu; // pastikan sudah import model Menu
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserCartController extends Controller
{
    // Menyimpan barang yang dipilih ke keranjang
    public function store(Request $request)
    {
        $cart = [];

        // Menambahkan menu yang dipilih ke dalam keranjang
        foreach ($request->menus as $menuId => $data) {
            if ($data['quantity'] > 0) {
                $cart[] = [
                    'menu_id' => $menuId,
                    'quantity' => $data['quantity'],
                    'price' => $data['price'],
                ];
            }
        }

        // Menyimpan keranjang ke session
        Session::put('cart', $cart);

        return redirect()->route('user.cart.checkout');
    }

    // Menampilkan halaman checkout
    public function checkout()
   {
    $cart = Session::get('cart', []);
    $logo = UntukUser::first();
    $rekenings = Rekening::all();

    // Ambil semua menu_id dari cart
    $menuIds = array_column($cart, 'menu_id');

    // Ambil data menu dari database
    $menus = Menu::whereIn('id', $menuIds)->get()->keyBy('id');

    return view('user.checkout', compact('cart', 'menus', 'rekenings', 'logo'));
}
    
    // Memproses pesanan
   // Memproses pesanan
   public function process(Request $request)
   {
    
       $cart = Session::get('cart', []);
       
       // Ambil ongkir dari request (yang sudah dihitung di frontend)
       $ongkir = $request->ongkir; 
   
       // Total harga sudah dihitung dengan ongkir di frontend, jadi kita hanya menggunakan nilai ini.
       $totalPrice = $request->total_price - $ongkir;
      
       $buktiPembayaranPath = null;

if ($request->hasFile('bukti_pembayaran')) {
    $file = $request->file('bukti_pembayaran');
    $filename = time() . '_' . $file->getClientOriginalName();
    $file->storeAs('bukti_pembayaran', $filename, 'public');
    $buktiPembayaranPath = 'bukti_pembayaran/' . $filename;
}

       // Membuat pesanan baru
       $order = Order::create([
           'customer_name'   => $request->customer_name,
           'phone_number'    => $request->phone_number,
           'alamat'          => $request->alamat,
           'payment_method'  => $request->payment_method,
           'request_pelanggan' => $request->request_pelanggan,
           'latitude'        => $request->latitude,  // Lokasi pelanggan
           'longitude'       => $request->longitude, // Lokasi pelanggan
           'ongkir'          => $ongkir, // Ongkir yang sudah dihitung
           'total_price'     => $totalPrice,  // Total harga dengan ongkir
           'bukti_pembayaran'=> $buktiPembayaranPath, // tambahkan ini
           'status'          => 'pending',
           'delivery_status' => 'sedang dimasak',
           'order_date'      => now(),
           
       ]);
      
       // Menambahkan item pesanan ke database
       foreach ($cart as $item) {
           OrderItem::create([
               'order_id' => $order->id,
               'menu_id'  => $item['menu_id'],
               'quantity' => $item['quantity'],
               'price'    => $item['price'],
           ]);
       }
   
       // Menghapus session keranjang setelah pesanan diproses
       Session::forget('cart');
   
       return redirect()->route('user.menu')->with('success', 'Pesanan berhasil dibuat!');
   }

}