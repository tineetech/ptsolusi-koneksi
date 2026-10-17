<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Produk;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home', [
            'produk' => Produk::take(3)->get(),
            'artikel' => Artikel::orderByDesc('tanggal')->take(3)->get(),
        ]);
    }
}
