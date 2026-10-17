<?php

namespace Database\Seeders;

use App\Models\Galeri;
use Illuminate\Database\Seeder;

class GaleriSeeder extends Seeder
{
    public function run(): void
    {
        $galeri = [
            ['judul' => 'Pelatihan Teknisi Jaringan', 'tanggal' => '2026-01-10', 'gambar' => 'images/galery/pelatihan-teknisi-jaringan.jpg'],
            ['judul' => 'Serah Terima Proyek Instalasi', 'tanggal' => '2026-01-02', 'gambar' => 'images/galery/serah-terima-proyek.jpg'],
            ['judul' => 'Kunjungan ke Data Center', 'tanggal' => '2025-12-20', 'gambar' => 'images/galery/kunjungan-data-center.jpg'],
            ['judul' => 'Seminar Keamanan Siber', 'tanggal' => '2025-12-15', 'gambar' => 'images/galery/seminar-keamanan-siber.jpg'],
            ['judul' => 'Perayaan Ulang Tahun Perusahaan', 'tanggal' => '2025-12-05', 'gambar' => 'images/galery/perayaan-ultah.jpg'],
            ['judul' => 'Bakti Sosial Perusahaan', 'tanggal' => '2025-11-28', 'gambar' => 'images/galery/bakti-sosial-pt.jpg'],
        ];

        foreach ($galeri as $item) {
            Galeri::updateOrCreate(['judul' => $item['judul']], $item);
        }
    }
}
