<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LayananController extends Controller
{
    public function index()
    {
        return view('admin.layanan.index', [
            'layanan' => Produk::latest()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.layanan.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['nama']);
        $data['fitur'] = $this->toLines($data['fitur']);

        Produk::create($data);

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Produk $layanan)
    {
        return view('admin.layanan.edit', [
            'layanan' => $layanan,
        ]);
    }

    public function update(Request $request, Produk $layanan)
    {
        $data = $this->validated($request);
        $data['fitur'] = $this->toLines($data['fitur']);

        $layanan->update($data);

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Produk $layanan)
    {
        $layanan->delete();

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'max:255'],
            'gambar' => ['required', 'string', 'max:2048'],
            'ringkas' => ['required', 'string'],
            'deskripsi' => ['required', 'string'],
            'fitur' => ['required', 'string'],
        ]);
    }

    private function uniqueSlug(string $nama): string
    {
        $base = Str::slug($nama);
        $slug = $base;
        $counter = 1;

        while (Produk::where('slug', $slug)->exists()) {
            $slug = $base.'-'.$counter++;
        }

        return $slug;
    }

    private function toLines(string $value): array
    {
        return collect(preg_split('/\r\n|\r|\n/', $value))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();
    }
}
