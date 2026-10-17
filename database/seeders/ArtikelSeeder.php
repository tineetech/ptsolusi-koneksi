<?php

namespace Database\Seeders;

use App\Models\Artikel;
use Illuminate\Database\Seeder;

class ArtikelSeeder extends Seeder
{
    public function run(): void
    {
        $artikel = [
            [
                'slug' => 'transformasi-digital-umkm',
                'judul' => 'Transformasi Digital untuk UMKM di Tahun 2026',
                'kategori' => 'Teknologi',
                'tanggal' => '2026-01-12',
                'penulis' => 'Tim Redaksi',
                'gambar' => 'images/artikel/transform-digital-umkm.jpg',
                'ringkas' => 'Bagaimana pelaku UMKM dapat memanfaatkan teknologi untuk memperluas pasar.',
                'isi' => 'Transformasi digital bukan lagi pilihan, melainkan kebutuhan bagi pelaku UMKM agar tetap kompetitif. Mulai dari pencatatan keuangan digital, pemasaran melalui media sosial, hingga penggunaan sistem pembayaran elektronik, semua dapat meningkatkan efisiensi dan jangkauan pasar. Pada tahun 2026, adopsi teknologi diprediksi semakin masif seiring turunnya biaya perangkat dan meningkatnya ketersediaan koneksi internet di daerah. UMKM yang mampu beradaptasi akan memiliki keunggulan dalam menjangkau pelanggan baru dan menghemat biaya operasional.',
            ],
            [
                'slug' => 'pentingnya-keamanan-jaringan',
                'judul' => 'Pentingnya Keamanan Jaringan bagi Perusahaan',
                'kategori' => 'Keamanan',
                'tanggal' => '2026-01-05',
                'penulis' => 'Tim Redaksi',
                'gambar' => 'images/artikel/pentingnya-keamanan-jaringan-bagi-perusahaan.jpg',
                'ringkas' => 'Langkah dasar melindungi data perusahaan dari ancaman siber.',
                'isi' => 'Keamanan jaringan menjadi fondasi utama dalam melindungi data perusahaan. Ancaman siber terus berkembang, mulai dari serangan malware hingga phishing yang menargetkan karyawan. Beberapa langkah dasar yang dapat dilakukan antara lain penggunaan firewall, enkripsi data, pembaruan perangkat lunak secara berkala, serta pelatihan kesadaran keamanan bagi seluruh karyawan. Dengan menerapkan lapisan keamanan berlapis, risiko kebocoran data dapat ditekan secara signifikan.',
            ],
            [
                'slug' => 'masa-depan-fiber-optik',
                'judul' => 'Masa Depan Koneksi Fiber Optik di Indonesia',
                'kategori' => 'Jaringan',
                'tanggal' => '2025-12-28',
                'penulis' => 'Tim Redaksi',
                'gambar' => 'images/artikel/pentingnnya-fiberoptik.jpg',
                'ringkas' => 'Fiber optik menjadi tulang punggung koneksi internet cepat di masa depan.',
                'isi' => 'Fiber optik menawarkan kecepatan transmisi data yang jauh lebih tinggi dibandingkan kabel tembaga, serta lebih tahan terhadap gangguan elektromagnetik. Seiring meningkatnya kebutuhan akan layanan berbasis cloud, streaming, dan Internet of Things (IoT), penggelaran jaringan fiber optik menjadi tulang punggung infrastruktur digital. Pemerintah dan penyedia layanan terus berupaya memperluas cakupan hingga ke daerah terpencil untuk mewujudkan pemerataan akses internet.',
            ],
        ];

        foreach ($artikel as $item) {
            Artikel::updateOrCreate(['slug' => $item['slug']], $item);
        }
    }
}
