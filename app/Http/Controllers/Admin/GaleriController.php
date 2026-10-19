<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\UploadsImages;
use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    use UploadsImages;

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
        $data = $request->validate($this->rules());
        $data['gambar'] = $this->storeImage($request->file('gambar'), 'galery');

        Galeri::create($data);

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
        $data = $request->validate($this->rules(false));

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $this->storeImage($request->file('gambar'), 'galery', $galeri->gambar);
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

    private function rules(bool $requireImage = true): array
    {
        return [
            'judul' => ['required', 'string', 'max:255'],
            'tanggal' => ['required', 'date'],
            'gambar' => [$requireImage ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }
}
