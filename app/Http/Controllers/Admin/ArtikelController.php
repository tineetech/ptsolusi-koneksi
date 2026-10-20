<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    public function index()
    {
        return view('pages.admin.artikel.index', [
            'artikel' => Artikel::orderByDesc('tanggal')->get(),
        ]);
    }

    public function create()
    {
        return view('pages.admin.artikel.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'max:255'],
            'tanggal' => ['required', 'date'],
            'penulis' => ['required', 'string', 'max:255'],
            'gambar' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'ringkas' => ['required', 'string'],
            'isi' => ['required', 'string'],
        ]);

        $slug = Str::slug($data['judul']);
        $slugAwal = $slug;
        $angka = 1;

        while (Artikel::where('slug', $slug)->exists()) {
            $slug = $slugAwal.'-'.$angka;
            $angka++;
        }

        $data['slug'] = $slug;
        $data['gambar'] = $this->simpanGambar($request->file('gambar'));

        Artikel::create($data);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit(Artikel $artikel)
    {
        return view('pages.admin.artikel.edit', [
            'artikel' => $artikel,
        ]);
    }

    public function update(Request $request, Artikel $artikel)
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'max:255'],
            'tanggal' => ['required', 'date'],
            'penulis' => ['required', 'string', 'max:255'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'ringkas' => ['required', 'string'],
            'isi' => ['required', 'string'],
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $this->simpanGambar($request->file('gambar'), $artikel);
        } else {
            unset($data['gambar']);
        }

        $artikel->update($data);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Artikel $artikel)
    {
        $artikel->delete();

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus.');
    }

    private function simpanGambar(UploadedFile $file, ?Artikel $artikel = null): string
    {
        $folder = public_path('images/artikel');

        if (! is_dir($folder)) {
            mkdir($folder, 0775, true);
        }

        if ($artikel !== null && $artikel->gambar !== null && str_starts_with($artikel->gambar, 'images/artikel/')) {
            $fileLama = public_path($artikel->gambar);

            if (is_file($fileLama)) {
                unlink($fileLama);
            }
        }

        $namaFile = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)).'-'.uniqid().'.'.strtolower($file->getClientOriginalExtension());

        $file->move($folder, $namaFile);

        return 'images/artikel/'.$namaFile;
    }
}
