<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cms;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class CmsController extends Controller
{
    public function edit()
    {
        return view('pages.admin.cms.edit', [
            'profil' => Cms::profil(),
            'logo' => Cms::branding(),
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'tentang_judul' => ['required', 'string'],
            'tentang_isi' => ['required', 'string'],
            'tentang_gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'logo_favicon' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:2048'],
            'logo_primary' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:2048'],
            'logo_white' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:2048'],
            'visi' => ['required', 'string'],
            'misi' => ['required', 'string'],
            'nilai_judul' => ['nullable', 'array'],
            'nilai_judul.*' => ['nullable', 'string', 'max:255'],
            'nilai_deskripsi' => ['nullable', 'array'],
            'nilai_deskripsi.*' => ['nullable', 'string'],
        ]);

        $gambar = Cms::profil()['tentang']['gambar'];

        if ($request->hasFile('tentang_gambar')) {
            $gambar = $this->simpanGambar($request->file('tentang_gambar'), $gambar);
        }

        $logo = Cms::branding();

        foreach (['favicon' => 'logo_favicon', 'primary' => 'logo_primary', 'white' => 'logo_white'] as $jenis => $field) {
            if (! $request->hasFile($field)) {
                continue;
            }

            $path = $this->simpanLogo($request->file($field), $logo[$jenis]);
            Cms::updateOrCreate(['key' => 'logo.'.$jenis], ['value' => $path]);
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

    private function simpanGambar(UploadedFile $file, ?string $gambarLama = null): string
    {
        $folder = public_path('images/profil');

        if (! is_dir($folder)) {
            mkdir($folder, 0775, true);
        }

        if ($gambarLama !== null && str_starts_with($gambarLama, 'images/profil/')) {
            $fileLama = public_path($gambarLama);

            if (is_file($fileLama)) {
                unlink($fileLama);
            }
        }

        $namaFile = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)).'-'.uniqid().'.'.strtolower($file->getClientOriginalExtension());

        $file->move($folder, $namaFile);

        return 'images/profil/'.$namaFile;
    }

    private function simpanLogo(UploadedFile $file, ?string $logoLama = null): string
    {
        $folder = public_path('images/logo');

        if (! is_dir($folder)) {
            mkdir($folder, 0775, true);
        }

        if ($logoLama !== null && str_starts_with($logoLama, 'images/logo/')) {
            $fileLama = public_path($logoLama);

            if (is_file($fileLama)) {
                unlink($fileLama);
            }
        }

        $namaFile = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)).'-'.uniqid().'.'.strtolower($file->getClientOriginalExtension());

        $file->move($folder, $namaFile);

        return 'images/logo/'.$namaFile;
    }
}
