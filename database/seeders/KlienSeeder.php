<?php

namespace Database\Seeders;

use App\Models\Klien;
use App\Models\Produk;
use Illuminate\Database\Seeder;

class KlienSeeder extends Seeder
{
    public function run(): void
    {
        $layanan = Produk::pluck('id', 'slug');

        $klien = [
            [
                'layanan_id' => $layanan['penyediaan-internet'] ?? null,
                'nama_client' => 'Budi Santoso',
                'nama_perusahaan' => 'PT Nusantara Digital',
                'email' => 'budi@nusantara-digital.co.id',
                'no_telephone' => '0812-3456-7890',
                'alamat_perusahaan' => 'Jl. Jenderal Sudirman No. 45, Jakarta Selatan',
                'notes' => 'Konsultasi paket internet dedicated 100 Mbps untuk kantor pusat.',
                'status' => 'konsultasi',
            ],
            [
                'layanan_id' => $layanan['instalasi-jaringan'] ?? null,
                'nama_client' => 'Siti Rahma',
                'nama_perusahaan' => 'CV Karya Mandiri',
                'email' => 'siti@karyamandiri.id',
                'no_telephone' => '0813-2233-4455',
                'alamat_perusahaan' => 'Jl. Soekarno-Hatta No. 12, Bandung',
                'notes' => 'Instalasi jaringan kantor cabang baru, survei lokasi sudah dilakukan.',
                'status' => 'proses',
            ],
            [
                'layanan_id' => $layanan['cctv-keamanan'] ?? null,
                'nama_client' => 'Andi Wijaya',
                'nama_perusahaan' => 'PT Sinar Abadi',
                'email' => 'andi@sinarabadi.com',
                'no_telephone' => '0815-7788-9900',
                'alamat_perusahaan' => 'Jl. Ahmad Yani No. 88, Surabaya',
                'notes' => 'Pemasangan CCTV 16 titik untuk area gudang dan parkir.',
                'status' => 'terjual',
            ],
        ];

        foreach ($klien as $item) {
            if ($item['layanan_id'] === null) {
                continue;
            }

            Klien::updateOrCreate(
                [
                    'nama_client' => $item['nama_client'],
                    'nama_perusahaan' => $item['nama_perusahaan'],
                ],
                $item,
            );
        }
    }
}
