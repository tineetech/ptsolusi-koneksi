<?php

namespace App\Http\Controllers;

use App\Models\Artikel;

class ArtikelController extends Controller
{
    public function index()
    {
        return view('pages.artikel', [
            'artikel' => Artikel::orderByDesc('tanggal')->paginate(6),
        ]);
    }

    public function show(string $slug)
    {
        $artikel = Artikel::where('slug', $slug)->firstOrFail();

        return view('pages.artikel-detail', [
            'artikel' => $artikel,
            'lainnya' => Artikel::where('slug', '!=', $slug)
                ->orderByDesc('tanggal')
                ->take(3)
                ->get(),
        ]);
    }
}
