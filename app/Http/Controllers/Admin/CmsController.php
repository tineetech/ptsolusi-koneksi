<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cms;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CmsController extends Controller
{
    public function edit()
    {
        return view('pages.admin.cms.edit', [
            'profil' => Cms::profil(),
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'tentang_judul' => ['required', 'string'],
            'tentang_isi' => ['required', 'string'],
            'tentang_gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'visi' => ['required', 'string'],
            'misi' => ['required', 'string'],
            'nilai_judul' => ['nullable', 'array'],
            'nilai_judul.*' => ['nullable', 'string', 'max:255'],
            'nilai_deskripsi' => ['nullable', 'array'],
            'nilai_deskripsi.*' => ['nullable', 'string'],
        ]);

        $gambar = Cms::profil()['tentang']['gambar'];

        if ($request->hasFile('tentang_gambar')) {
            $folder = public_path('images/profil');

            if ($gambar !== null && str_starts_with($gambar, 'images/profil/')) {
                $fileLama = public_path($gambar);

                if (is_file($fileLama)) {
                    unlink($fileLama);
                }
            }

            $file = $request->file('tentang_gambar');
            $namaFile = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)).'-'.uniqid().'.'.strtolower($file->getClientOriginalExtension());

            $file->move($folder, $namaFile);

            $gambar = 'images/profil/'.$namaFile;
        }

        Cms::updateOrCreate(['key' => 'profil.tentang.judul'], ['value' => $data['tentang_judul']]);
        Cms::updateOrCreate(['key' => 'profil.tentang.isi'], ['value' => $data['tentang_isi']]);
        Cms::updateOrCreate(['key' => 'profil.tentang.gambar'], ['value' => $gambar]);
        Cms::updateOrCreate(['key' => 'profil.visi'], ['value' => $data['visi']]);
        Cms::updateOrCreate(['key' => 'profil.misi'], ['value' => $data['misi']]);

        Cms::where('key', 'like', 'profil.nilai%')->delete();

        $nomor = 1;

        foreach ($data['nilai_judul'] ?? [] as $i => $judul) {
            $deskripsi = $data['nilai_deskripsi'][$i] ?? '';
            $judul = trim($judul);
            $deskripsi = trim($deskripsi);

            if ($judul === '' && $deskripsi === '') {
                continue;
            }

            Cms::create([
                'key' => 'profil.nilai'.$nomor,
                'value' => $judul.' | '.$deskripsi,
            ]);

            $nomor++;
        }

        return redirect()->route('admin.cms.edit')->with('success', 'Konten profil berhasil diperbarui.');
    }
}
