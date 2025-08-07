<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Review; // ✅ Tambahkan ini
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $menus = Menu::with('reviews')->get();
        return view('reviews.index', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'user_name' => 'required|string|max:100',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        Review::create($request->all());

        return redirect()->route('reviews.index')->with('success', 'Ulasan berhasil ditambahkan.');
    }
}
