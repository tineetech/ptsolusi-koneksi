<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\UploadsImages;
use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LayananController extends Controller
{
    use UploadsImages;

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
        $data = $request->validate($this->rules());
        $data['slug'] = $this->uniqueSlug($data['nama']);
        $data['fitur'] = $this->toLines($data['fitur']);
        $data['gambar'] = $this->storeImage($request->file('gambar'), 'layanan');

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
        $data = $request->validate($this->rules(false));
        $data['fitur'] = $this->toLines($data['fitur']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $this->storeImage($request->file('gambar'), 'layanan', $layanan->gambar);
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

    private function rules(bool $requireImage = true): array
    {
        return [
            'nama' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'max:255'],
            'gambar' => [$requireImage ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'ringkas' => ['required', 'string'],
            'deskripsi' => ['required', 'string'],
            'fitur' => ['required', 'string'],
        ];
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
