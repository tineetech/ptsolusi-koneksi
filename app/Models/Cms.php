<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cms extends Model
{
    protected $table = 'cms';

    protected $fillable = [
        'key',
        'value',
    ];

    public static function getValue(string $key, mixed $default = null): mixed
    {
        $raw = static::query()->where('key', $key)->value('value');

        if ($raw === null) {
            return $default;
        }

        $decoded = json_decode($raw, true);

        return is_array($decoded) ? $decoded : $raw;
    }

    public static function branding(): array
    {
        $default = [
            'favicon' => 'images/logo-sk4.png',
            'primary' => 'images/logo-sk1.png',
            'white' => 'images/logo-sk8.png',
        ];

        $tersimpan = static::query()
            ->whereIn('key', ['logo.favicon', 'logo.primary', 'logo.white'])
            ->pluck('value', 'key');

        $logo = [];

        foreach ($default as $jenis => $defaultPath) {
            $nilai = $tersimpan->get('logo.'.$jenis);

            $logo[$jenis] = is_string($nilai) && trim($nilai) !== '' ? $nilai : $defaultPath;
        }

        return $logo;
    }

    public static function profil(): array
    {
        $nilai = [];
        $nomor = 1;

        while (true) {
            $teks = static::getValue('profil.nilai'.$nomor);

            if ($teks === null) {
                break;
            }

            $bagian = array_pad(explode('|', $teks, 2), 2, '');

            $nilai[] = [
                'judul' => trim($bagian[0]),
                'deskripsi' => trim($bagian[1]),
            ];

            $nomor++;
        }

        if ($nilai === []) {
            $nilai = [
                ['judul' => 'Profesional', 'deskripsi' => 'Bekerja dengan standar tinggi dan penuh tanggung jawab pada setiap proyek.'],
                ['judul' => 'Integritas', 'deskripsi' => 'Menjunjung kejujuran dan transparansi dalam setiap layanan kepada pelanggan.'],
                ['judul' => 'Inovatif', 'deskripsi' => 'Terus mengembangkan solusi mengikuti perkembangan teknologi terkini.'],
            ];
        }

        return [
            'tentang' => [
                'judul' => static::getValue('profil.tentang.judul', 'Solusi Teknologi untuk Pertumbuhan Bisnis'),
                'isi' => static::getValue('profil.tentang.isi', "PT Solusi Koneksi berdiri sejak tahun 2015 sebagai perusahaan yang bergerak di bidang penyediaan solusi jaringan, internet, keamanan, dan infrastruktur teknologi informasi. Kami berkomitmen memberikan layanan berkualitas dengan dukungan tim teknis yang berpengalaman dan responsif.\nSelama lebih dari satu dekade, kami telah dipercaya oleh berbagai instansi pemerintah, perusahaan swasta, kampus, dan pelaku usaha untuk membangun serta merawat infrastruktur teknologi mereka."),
                'gambar' => static::getValue('profil.tentang.gambar', 'https://picsum.photos/seed/about/800/600'),
            ],
            'visi' => static::getValue('profil.visi', 'Menjadi perusahaan penyedia solusi teknologi informasi terdepan dan terpercaya di Indonesia.'),
            'misi' => static::getValue('profil.misi', "Menyediakan layanan teknologi yang handal, aman, dan terjangkau.\nMengutamakan kepuasan pelanggan melalui dukungan teknis yang cepat.\nMengembangkan kompetensi sumber daya manusia secara berkelanjutan.\nBerinovasi mengikuti perkembangan teknologi informasi terkini."),
            'nilai' => $nilai,
        ];
    }
}
