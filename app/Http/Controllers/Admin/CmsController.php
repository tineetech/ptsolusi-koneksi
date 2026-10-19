<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\UploadsImages;
use App\Http\Controllers\Controller;
use App\Models\Cms;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    use UploadsImages;

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
            'nilai' => ['required', 'string'],
        ]);

        $gambar = Cms::profil()['tentang']['gambar'];

        if ($request->hasFile('tentang_gambar')) {
            $gambar = $this->storeImage($request->file('tentang_gambar'), 'profil', $gambar);
        }

        $this->set('profil.tentang.judul', $data['tentang_judul']);
        $this->set('profil.tentang.isi', $this->lines($data['tentang_isi']));
        $this->set('profil.tentang.gambar', $gambar);
        $this->set('profil.visi', $data['visi']);
        $this->set('profil.misi', $this->lines($data['misi']));
        $this->set('profil.nilai', $this->nilai($data['nilai']));

        return redirect()->route('admin.cms.edit')->with('success', 'Konten profil berhasil diperbarui.');
    }

    private function set(string $key, mixed $value): void
    {
        Cms::where('key', $key)->update([
            'value' => is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : $value,
            'updated_at' => now(),
        ]);
    }

    private function lines(string $value): array
    {
        return collect(preg_split('/\r\n|\r|\n/', $value))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();
    }

    private function nilai(string $value): array
    {
        return collect($this->lines($value))
            ->map(function ($line) {
                [$judul, $deskripsi] = array_pad(explode('|', $line, 2), 2, '');

                return ['judul' => trim($judul), 'deskripsi' => trim($deskripsi)];
            })
            ->all();
    }
}
