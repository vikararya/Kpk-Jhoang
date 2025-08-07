<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class CartController extends Controller
{
    public function addToCart(Request $request, $menuId)
    {
        $menu = Menu::findOrFail($menuId);
        $cart = session()->get('cart', []);

        if (isset($cart[$menuId])) {
            $cart[$menuId]['quantity']++;
        } else {
            $cart[$menuId] = [
                'name' => $menu->name,
                'price' => $menu->price,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Menu berhasil ditambahkan ke keranjang!');
    }
    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }
    

    public function removeFromCart($menuId)
    {
        $cart = session()->get('cart', []);
        unset($cart[$menuId]);
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Item dihapus dari keranjang.');
    }

    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->route('cart.view');
    }
}

