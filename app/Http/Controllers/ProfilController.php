<?php

namespace App\Http\Controllers;

use App\Models\Cms;

class ProfilController extends Controller
{
    public function index()
    {
        return view('pages.profil', [
            'profil' => Cms::profil(),
        ]);
    }
}
