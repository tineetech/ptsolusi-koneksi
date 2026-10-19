<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\UploadsImages;
use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    use UploadsImages;

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
        $data = $request->validate($this->rules());
        $data['slug'] = $this->uniqueSlug($data['judul']);
        $data['gambar'] = $this->storeImage($request->file('gambar'), 'artikel');

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
        $data = $request->validate($this->rules(false));

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $this->storeImage($request->file('gambar'), 'artikel', $artikel->gambar);
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

    private function rules(bool $requireImage = true): array
    {
        return [
            'judul' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'max:255'],
            'tanggal' => ['required', 'date'],
            'penulis' => ['required', 'string', 'max:255'],
            'gambar' => [$requireImage ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'ringkas' => ['required', 'string'],
            'isi' => ['required', 'string'],
        ];
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
