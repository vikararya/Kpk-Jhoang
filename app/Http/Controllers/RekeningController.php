<?php

namespace App\Http\Controllers;

use App\Models\Rekening;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // ← ini wajib ditambahkan jika belum

class RekeningController extends Controller
{
    public function index()
    {
        $rekenings = Rekening::all();
        return view('rekening.index', compact('rekenings'));
    }

    public function create()
    {
        return view('rekening.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'norek' => 'required',
        'gambar' => 'nullable|image|max:2048',
    ]);

    $gambarPath = null;
    if ($request->hasFile('gambar')) {
        $gambarPath = $request->file('gambar')->store('rekening', 'public');
    }

    Rekening::create([
        'nama' => $request->nama,
        'norek' => $request->norek,
        'gambar' => $gambarPath,
    ]);

    return redirect()->route('rekening.index')->with('success', 'Data rekening berhasil ditambahkan.');
}


    public function edit(Rekening $rekening)
    {
        return view('rekening.edit', compact('rekening'));
    }

    public function update(Request $request, Rekening $rekening)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'norek' => 'required',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    if ($request->hasFile('gambar')) {
        $gambarPath = $request->file('gambar')->store('rekening', 'public');
        $rekening->gambar = $gambarPath;
    }

    $rekening->nama = $request->nama;
    $rekening->norek = $request->norek;
    $rekening->save();

    return redirect()->route('rekening.index')->with('success', 'Data rekening berhasil diperbarui.');
}


    public function destroy(Rekening $rekening)
    {
        $rekening->delete();
        return redirect()->route('rekening.index')->with('success', 'Data rekening berhasil dihapus.');
    }
}
