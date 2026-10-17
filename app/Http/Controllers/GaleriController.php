<?php

namespace App\Http\Controllers;

use App\Models\Galeri;

class GaleriController extends Controller
{
    public function index()
    {
        return view('pages.galeri', [
            'galeri' => Galeri::orderByDesc('tanggal')->get(),
        ]);
    }
}
