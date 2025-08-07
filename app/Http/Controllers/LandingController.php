<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UntukUser;
use App\Models\Menu;


class LandingController extends Controller
{
    public function index()
{
    $logo = UntukUser::latest()->first(); // Ambil satu logo terbaru
    $heroImage = UntukUser::latest()->first(); // Ambil satu gambar hero terbaru
    $menus = Menu::latest()->take(4)->get(); // Ambil 4 menu terbaru

    return view('landing', compact('logo', 'heroImage', 'menus'));
}
    
    
}
