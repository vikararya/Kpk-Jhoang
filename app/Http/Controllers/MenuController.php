<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    // Menampilkan form untuk membuat menu baru
    public function create()
    {
        $categories = Category::all();
        return view('menus.create', compact('categories'));
    }

    // Menyimpan menu baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        // Simpan gambar ke dalam storage/menus
        $imagePath = $request->file('image')->store('menus', 'public');

        Menu::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'image' => $imagePath, // Simpan path gambar
        ]);

        return redirect()->route('menus.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function index()
{
    // Mengurutkan menu berdasarkan created_at terbaru
    $menus = Menu::orderBy('created_at', 'desc')->get(); 

    // Mengambil semua kategori
    $categories = Category::all();

    // Menampilkan tampilan dengan data menu dan kategori
    return view('menus.index', compact('menus', 'categories'));
}

    
    // Menampilkan form untuk mengedit menu
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $categories = Category::all();
        return view('menus.edit', compact('menu', 'categories'));
    }

    // Memperbarui menu
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $menu = Menu::findOrFail($id);

        // Cek jika ada gambar baru, hapus gambar lama dan simpan gambar baru
        if ($request->hasFile('image')) {
            if (Storage::exists('public/' . $menu->image)) {
                Storage::delete('public/' . $menu->image);
            }
            $imagePath = $request->file('image')->store('menus', 'public');
        } else {
            $imagePath = $menu->image;
        }

        // Perbarui menu
        $menu->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'image' => $imagePath,
        ]);

        return redirect()->route('menus.index')->with('success', 'Menu berhasil diperbarui.');
    }

    // Menghapus menu
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        if (Storage::exists('public/' . $menu->image)) {
            Storage::delete('public/' . $menu->image);
        }

        $menu->delete();

        return redirect()->route('menus.index')->with('success', 'Menu berhasil dihapus.');
    }
}
