<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    public function index()
    {
        return view('admin.artikel.index', [
            'artikel' => Artikel::orderByDesc('tanggal')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.artikel.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['judul']);

        Artikel::create($data);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit(Artikel $artikel)
    {
        return view('admin.artikel.edit', [
            'artikel' => $artikel,
        ]);
    }

    public function update(Request $request, Artikel $artikel)
    {
        $artikel->update($this->validated($request));

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Artikel $artikel)
    {
        $artikel->delete();

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'max:255'],
            'tanggal' => ['required', 'date'],
            'penulis' => ['required', 'string', 'max:255'],
            'gambar' => ['required', 'string', 'max:2048'],
            'ringkas' => ['required', 'string'],
            'isi' => ['required', 'string'],
        ]);
    }

    private function uniqueSlug(string $judul): string
    {
        $base = Str::slug($judul);
        $slug = $base;
        $counter = 1;

        while (Artikel::where('slug', $slug)->exists()) {
            $slug = $base.'-'.$counter++;
        }

        return $slug;
    }
}
