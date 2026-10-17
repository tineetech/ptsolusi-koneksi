<?php

namespace Database\Seeders;

use App\Models\Cms;
use Illuminate\Database\Seeder;

class CmsSeeder extends Seeder
{
    public function run(): void
    {
        $konten = [
            'profil.tentang.judul' => 'Solusi Teknologi untuk Pertumbuhan Bisnis',
            'profil.tentang.isi' => [
                'PT Solusi Koneksi berdiri sejak tahun 2015 sebagai perusahaan yang bergerak di bidang penyediaan solusi jaringan, internet, keamanan, dan infrastruktur teknologi informasi. Kami berkomitmen memberikan layanan berkualitas dengan dukungan tim teknis yang berpengalaman dan responsif.',
                'Selama lebih dari satu dekade, kami telah dipercaya oleh berbagai instansi pemerintah, perusahaan swasta, kampus, dan pelaku usaha untuk membangun serta merawat infrastruktur teknologi mereka.',
            ],
            'profil.tentang.gambar' => 'https://picsum.photos/seed/about/800/600',
            'profil.visi' => 'Menjadi perusahaan penyedia solusi teknologi informasi terdepan dan terpercaya di Indonesia.',
            'profil.misi' => [
                'Menyediakan layanan teknologi yang handal, aman, dan terjangkau.',
                'Mengutamakan kepuasan pelanggan melalui dukungan teknis yang cepat.',
                'Mengembangkan kompetensi sumber daya manusia secara berkelanjutan.',
                'Berinovasi mengikuti perkembangan teknologi informasi terkini.',
            ],
            'profil.nilai' => [
                [
                    'judul' => 'Profesional',
                    'deskripsi' => 'Bekerja dengan standar tinggi dan penuh tanggung jawab pada setiap proyek.',
                ],
                [
                    'judul' => 'Integritas',
                    'deskripsi' => 'Menjunjung kejujuran dan transparansi dalam setiap layanan kepada pelanggan.',
                ],
                [
                    'judul' => 'Inovatif',
                    'deskripsi' => 'Terus mengembangkan solusi mengikuti perkembangan teknologi terkini.',
                ],
            ],
        ];

        foreach ($konten as $key => $value) {
            Cms::updateOrCreate(
                ['key' => $key],
                ['value' => is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : $value],
            );
        }
    }
}
