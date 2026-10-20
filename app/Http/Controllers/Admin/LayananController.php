<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class LayananController extends Controller
{
    public function index()
    {
        return view('pages.admin.layanan.index', [
            'layanan' => Produk::latest()->get(),
        ]);
    }

    public function create()
    {
        return view('pages.admin.layanan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'max:255'],
            'gambar' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'ringkas' => ['required', 'string'],
            'deskripsi' => ['required', 'string'],
            'fitur' => ['required', 'string'],
        ]);

        $slug = Str::slug($data['nama']);
        $slugAwal = $slug;
        $angka = 1;

        while (Produk::where('slug', $slug)->exists()) {
            $slug = $slugAwal.'-'.$angka;
            $angka++;
        }

        $data['slug'] = $slug;
        $data['gambar'] = $this->simpanGambar($request->file('gambar'));
        $data['fitur'] = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $data['fitur']))));

        Produk::create($data);

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Produk $layanan)
    {
        return view('pages.admin.layanan.edit', [
            'layanan' => $layanan,
        ]);
    }

    public function update(Request $request, Produk $layanan)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'max:255'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'ringkas' => ['required', 'string'],
            'deskripsi' => ['required', 'string'],
            'fitur' => ['required', 'string'],
        ]);

        $data['fitur'] = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $data['fitur']))));

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $this->simpanGambar($request->file('gambar'), $layanan);
        } else {
            unset($data['gambar']);
        }

        $layanan->update($data);

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Produk $layanan)
    {
        $layanan->delete();

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil dihapus.');
    }

    private function simpanGambar(UploadedFile $file, ?Produk $layanan = null): string
    {
        $folder = public_path('images/layanan');

        if (! is_dir($folder)) {
            mkdir($folder, 0775, true);
        }

        if ($layanan !== null && $layanan->gambar !== null && str_starts_with($layanan->gambar, 'images/layanan/')) {
            $fileLama = public_path($layanan->gambar);

            if (is_file($fileLama)) {
                unlink($fileLama);
            }
        }

        $namaFile = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));

        if ($namaFile === '') {
            $namaFile = 'gambar';
        }

        $namaFile = $namaFile.'-'.uniqid().'.'.strtolower($file->getClientOriginalExtension());

        $file->move($folder, $namaFile);

        return 'images/layanan/'.$namaFile;
    }
}
