<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UntukUser;

class UntukUserController extends Controller
{
    public function index()
    {
        $untukuser = UntukUser::latest()->get(); // Menampilkan data terbaru di atas
        return view('untukuser.index', compact('untukuser'));
    }

    public function create()
    {
        return view('untukuser.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'required'

            
        ]);

        $logoPath = $request->file('logo')->store('uploads', 'public');
        $gambarPath = $request->file('gambar')->store('uploads', 'public');

        UntukUser::create([
            'logo' => $logoPath,
            'gambar' => $gambarPath,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('untukuser.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $untukuser = UntukUser::findOrFail($id);
        return view('untukuser.edit', compact('untukuser'));
    }
    

    public function update(Request $request, UntukUser $untukuser)
    {
        $request->validate([
            'logo' => 'image|mimes:jpeg,png,jpg|max:2048',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('uploads', 'public');
            $untukuser->logo = $logoPath;
        }

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('uploads', 'public');
            $untukuser->gambar = $gambarPath;
        }

        $untukuser->deskripsi = $request->deskripsi;
        $untukuser->save();

        return redirect()->route('untukuser.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(UntukUser $untukuser)
    {
        $untukuser->delete();
        return redirect()->route('untukuser.index')->with('success', 'Data berhasil dihapus');
    }
}
