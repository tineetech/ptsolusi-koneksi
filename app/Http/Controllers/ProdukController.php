<?php

namespace App\Http\Controllers;

use App\Models\Produk;

class ProdukController extends Controller
{
    public function index()
    {
        return view('pages.produk', [
            'produk' => Produk::all(),
        ]);
    }

    public function show(string $slug)
    {
        $produk = Produk::where('slug', $slug)->firstOrFail();

        return view('pages.produk-detail', [
            'produk' => $produk,
            'lainnya' => Produk::where('slug', '!=', $slug)->take(3)->get(),
        ]);
    }
}
