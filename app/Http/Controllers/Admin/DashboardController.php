<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Galeri;
use App\Models\Produk;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.admin.dashboard', [
            'jumlahLayanan' => Produk::count(),
            'jumlahArtikel' => Artikel::count(),
            'jumlahGaleri' => Galeri::count(),
            'daftarLayanan' => Produk::latest()->take(5)->get(),
            'artikelTerbaru' => Artikel::orderByDesc('tanggal')->take(5)->get(),
        ]);
    }
}
