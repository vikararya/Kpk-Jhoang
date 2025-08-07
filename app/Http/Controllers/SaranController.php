<?php

namespace App\Http\Controllers;

use App\Models\Saran;
use App\Models\UntukUser;
use Illuminate\Http\Request;

class SaranController extends Controller
{
    // Halaman form untuk user
    public function create()
{
    $logo = UntukUser::first();
    return view('user.saran', compact('logo'));
}


    // Simpan data dari user
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'isi' => 'required|string|max:1000',
        ]);

        Saran::create($request->only('nama', 'isi'));

        return redirect()->back()->with('success', 'Saran berhasil dikirim.');
    }

    // Hanya untuk admin
    public function index()
    {
        $sarans = Saran::latest()->get();
        return view('saran.index', compact('sarans'));
    }

      // Menghapus saran (untuk admin)
      public function destroy($id)
      {
          $saran = Saran::findOrFail($id);
          $saran->delete();
  
          return redirect()->route('saran.index')->with('success', 'Saran berhasil dihapus.');
      }
}
