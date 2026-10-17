<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        $produk = [
            [
                'slug' => 'instalasi-jaringan',
                'nama' => 'Instalasi Jaringan',
                'kategori' => 'Jaringan',
                'gambar' => 'images/layanan/layanan-instalasijaringan.jpg',
                'ringkas' => 'Perancangan dan instalasi jaringan LAN, WAN, dan fiber optic untuk perkantoran.',
                'deskripsi' => 'Layanan instalasi jaringan kami mencakup survei lokasi, perancangan topologi, penarikan kabel fiber optic maupun UTP, konfigurasi switch dan router, hingga pengujian kualitas jaringan. Tim teknisi kami berpengalaman menangani proyek skala gedung perkantoran, kampus, hingga kawasan industri.',
                'fitur' => [
                    'Survei dan perancangan topologi jaringan',
                    'Instalasi kabel fiber optic dan UTP',
                    'Konfigurasi router, switch, dan access point',
                    'Pengujian dan sertifikasi hasil instalasi',
                ],
            ],
            [
                'slug' => 'penyediaan-internet',
                'nama' => 'Penyediaan Internet',
                'kategori' => 'Internet',
                'gambar' => 'images/layanan/layanan-penyediaan-internet.jpg',
                'ringkas' => 'Paket internet dedicated dengan koneksi stabil dan dukungan teknis 24/7.',
                'deskripsi' => 'Kami menyediakan koneksi internet dedicated dengan SLA yang jelas, bandwidth simetris, dan dukungan teknis 24/7. Solusi ini cocok untuk perusahaan yang membutuhkan koneksi stabil untuk operasional harian, video conference, dan layanan cloud.',
                'fitur' => [
                    'Bandwidth simetris dedicated',
                    'IP publik statis',
                    'SLA ketersediaan hingga 99,5%',
                    'Dukungan teknis 24/7',
                ],
            ],
            [
                'slug' => 'cctv-keamanan',
                'nama' => 'Instalasi CCTV & Keamanan',
                'kategori' => 'Keamanan',
                'gambar' => 'images/layanan/layanan-instalcctv.jpg',
                'ringkas' => 'Pemasangan CCTV IP dan analog dengan pemantauan jarak jauh.',
                'deskripsi' => 'Layanan keamanan kami meliputi pemasangan kamera CCTV IP maupun analog, konfigurasi perekaman, penyimpanan NVR/DVR, serta akses pemantauan jarak jauh melalui perangkat mobile. Kami juga menyediakan perawatan berkala agar sistem selalu berjalan optimal.',
                'fitur' => [
                    'Kamera CCTV IP dan analog',
                    'Penyimpanan NVR/DVR',
                    'Pemantauan jarak jauh via mobile',
                    'Perawatan dan pemeliharaan berkala',
                ],
            ],
            [
                'slug' => 'server-data-center',
                'nama' => 'Server & Data Center',
                'kategori' => 'Infrastruktur',
                'gambar' => 'images/layanan/layanan-serverdatacenter.jpg',
                'ringkas' => 'Pembangunan dan pengelolaan server serta rak data center perusahaan.',
                'deskripsi' => 'Kami membantu pembangunan infrastruktur server mulai dari pengadaan perangkat, pemasangan rak, penataan kabel (cable management), konfigurasi sistem operasi server, hingga pemantauan performa secara berkala untuk memastikan layanan tetap andal.',
                'fitur' => [
                    'Pengadaan dan konfigurasi server',
                    'Penataan rak dan cable management',
                    'Virtualisasi dan sistem operasi server',
                    'Monitoring performa berkala',
                ],
            ],
        ];

        foreach ($produk as $item) {
            Produk::updateOrCreate(['slug' => $item['slug']], $item);
        }
    }
}
