<?php

namespace App\Http\Controllers;

use App\Models\Furnitures;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $furnitures = Furnitures::all(); // Ambil semua furnitur untuk halaman shop
        return view('shop', compact('furnitures'));
    }

    public function show(Furnitures $furniture)
    {
        return view('shop.show', compact('furniture')); // Tampilkan detail furnitur
    }
}