<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Menampilkan form untuk membuat kategori baru
    public function create()
    {
        return view('categories.create');
    }

    // Menyimpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    // Menampilkan daftar kategori
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // Menampilkan form untuk mengedit kategori
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    // Memperbarui kategori
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    // Menghapus kategori
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
