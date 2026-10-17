<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index()
    {
        return view('admin.galeri.index', [
            'galeri' => Galeri::orderByDesc('tanggal')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        Galeri::create($this->validated($request));

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.edit', [
            'galeri' => $galeri,
        ]);
    }

    public function update(Request $request, Galeri $galeri)
    {
        $galeri->update($this->validated($request));

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Galeri $galeri)
    {
        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'tanggal' => ['required', 'date'],
            'gambar' => ['required', 'string', 'max:2048'],
        ]);
    }
}
