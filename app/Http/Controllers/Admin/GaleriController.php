<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GaleriController extends Controller
{
    public function index()
    {
        return view('pages.admin.galeri.index', [
            'galeri' => Galeri::orderByDesc('tanggal')->get(),
        ]);
    }

    public function create()
    {
        return view('pages.admin.galeri.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'tanggal' => ['required', 'date'],
            'gambar' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $folder = public_path('images/galery');

        if (! is_dir($folder)) {
            mkdir($folder, 0775, true);
        }

        $file = $request->file('gambar');
        $namaFile = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));

        if ($namaFile === '') {
            $namaFile = 'gambar';
        }

        $namaFile = $namaFile.'-'.uniqid().'.'.strtolower($file->getClientOriginalExtension());
        $file->move($folder, $namaFile);

        $data['gambar'] = 'images/galery/'.$namaFile;

        Galeri::create($data);

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function edit(Galeri $galeri)
    {
        return view('pages.admin.galeri.edit', [
            'galeri' => $galeri,
        ]);
    }

    public function update(Request $request, Galeri $galeri)
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'tanggal' => ['required', 'date'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('gambar')) {
            $folder = public_path('images/galery');

            if (! is_dir($folder)) {
                mkdir($folder, 0775, true);
            }

            if ($galeri->gambar !== null && str_starts_with($galeri->gambar, 'images/galery/')) {
                $fileLama = public_path($galeri->gambar);

                if (is_file($fileLama)) {
                    unlink($fileLama);
                }
            }

            $file = $request->file('gambar');
            $namaFile = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));

            if ($namaFile === '') {
                $namaFile = 'gambar';
            }

            $namaFile = $namaFile.'-'.uniqid().'.'.strtolower($file->getClientOriginalExtension());
            $file->move($folder, $namaFile);

            $data['gambar'] = 'images/galery/'.$namaFile;
        } else {
            unset($data['gambar']);
        }

        $galeri->update($data);

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Galeri $galeri)
    {
        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil dihapus.');
    }
}
