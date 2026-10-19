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
            'profil.tentang.isi' => "PT Solusi Koneksi berdiri sejak tahun 2015 sebagai perusahaan yang bergerak di bidang penyediaan solusi jaringan, internet, keamanan, dan infrastruktur teknologi informasi. Kami berkomitmen memberikan layanan berkualitas dengan dukungan tim teknis yang berpengalaman dan responsif.\nSelama lebih dari satu dekade, kami telah dipercaya oleh berbagai instansi pemerintah, perusahaan swasta, kampus, dan pelaku usaha untuk membangun serta merawat infrastruktur teknologi mereka.",
            'profil.tentang.gambar' => 'https://picsum.photos/seed/about/800/600',
            'profil.visi' => 'Menjadi perusahaan penyedia solusi teknologi informasi terdepan dan terpercaya di Indonesia.',
            'profil.misi' => "Menyediakan layanan teknologi yang handal, aman, dan terjangkau.\nMengutamakan kepuasan pelanggan melalui dukungan teknis yang cepat.\nMengembangkan kompetensi sumber daya manusia secara berkelanjutan.\nBerinovasi mengikuti perkembangan teknologi informasi terkini.",
            'profil.nilai1' => 'Profesional | Bekerja dengan standar tinggi dan penuh tanggung jawab pada setiap proyek.',
            'profil.nilai2' => 'Integritas | Menjunjung kejujuran dan transparansi dalam setiap layanan kepada pelanggan.',
            'profil.nilai3' => 'Inovatif | Terus mengembangkan solusi mengikuti perkembangan teknologi terkini.',
        ];

        Cms::where('key', 'like', 'profil.nilai%')->delete();

        foreach ($konten as $key => $value) {
            Cms::updateOrCreate(
                ['key' => $key],
                ['value' => $value],
            );
        }
    }
}
