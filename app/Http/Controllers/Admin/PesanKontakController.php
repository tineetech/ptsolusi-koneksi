<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PesanKontak;

class PesanKontakController extends Controller
{
    public function index()
    {
        return view('pages.admin.pesan.index', [
            'pesan' => PesanKontak::latest()->get(),
        ]);
    }

    public function show(PesanKontak $pesan)
    {
        return view('pages.admin.pesan.show', [
            'pesan' => $pesan,
        ]);
    }

    public function destroy(PesanKontak $pesan)
    {
        $pesan->delete();

        return redirect()->route('admin.pesan.index')->with('success', 'Pesan berhasil dihapus.');
    }
}
