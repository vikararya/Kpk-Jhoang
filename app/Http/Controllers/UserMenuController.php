<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UntukUser;
use App\Models\Menu;
use App\Models\Category;

class UserMenuController extends Controller
{
    public function index()
    {
        $logo = UntukUser::first();
        $menus = Menu::with('category')->get(); // Ambil menu + relasi kategori
        $categories = Category::with('menus')->get(); // Ambil semua kategori + menu

        return view('user.menu', compact('logo', 'menus', 'categories'));
    }
}
