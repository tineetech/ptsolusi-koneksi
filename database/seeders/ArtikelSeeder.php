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
            [
                'slug' => 'cloud-computing-efisiensi-bisnis',
                'judul' => 'Memanfaatkan Cloud Computing untuk Efisiensi Bisnis',
                'kategori' => 'Teknologi',
                'tanggal' => '2025-12-22',
                'penulis' => 'Tim Redaksi',
                'gambar' => 'images/artikel/transform-digital-umkm.jpg',
                'ringkas' => 'Cloud computing membantu perusahaan menekan biaya infrastruktur dan meningkatkan fleksibilitas.',
                'isi' => 'Cloud computing memungkinkan perusahaan menyewa sumber daya komputasi sesuai kebutuhan tanpa harus berinvestasi besar pada perangkat keras. Model berlangganan ini membuat biaya lebih terukur, mudah diskalakan, dan dapat diakses dari mana saja. Selain efisiensi biaya, cloud juga mempercepat kolaborasi tim, memperkuat pemulihan bencana, dan menyederhanakan pemeliharaan sistem. Tantangan utamanya adalah memilih penyedia yang tepat serta memastikan tata kelola keamanan data tetap terjaga.',
            ],
            [
                'slug' => 'tips-amankan-data-karyawan',
                'judul' => 'Tips Mengamankan Data Karyawan dari Serangan Siber',
                'kategori' => 'Keamanan',
                'tanggal' => '2025-12-15',
                'penulis' => 'Tim Redaksi',
                'gambar' => 'images/artikel/pentingnya-keamanan-jaringan-bagi-perusahaan.jpg',
                'ringkas' => 'Data karyawan menjadi sasaran empuk, kenali cara melindunginya.',
                'isi' => 'Data karyawan menyimpan informasi sensitif seperti identitas, rekening, dan riwayat kerja yang bernilai tinggi bagi pelaku kejahatan siber. Perlindungan dapat dimulai dengan menetapkan hak akses berdasarkan kebutuhan, mewajibkan kata sandi kuat dan autentikasi dua faktor, serta mengenkripsi data penting. Pelatihan rutin agar karyawan waspada terhadap phishing juga tidak kalah penting, karena faktor manusia sering menjadi celah utama kebocoran data.',
            ],
            [
                'slug' => 'mengenal-vpn-untuk-perusahaan',
                'judul' => 'Mengenal VPN dan Manfaatnya bagi Perusahaan',
                'kategori' => 'Jaringan',
                'tanggal' => '2025-12-08',
                'penulis' => 'Tim Redaksi',
                'gambar' => 'images/artikel/pentingnnya-fiberoptik.jpg',
                'ringkas' => 'VPN menjaga komunikasi data tetap aman, terutama saat bekerja jarak jauh.',
                'isi' => 'Virtual Private Network (VPN) membangun jalur terenkripsi antara perangkat pengguna dan jaringan perusahaan, sehingga data tidak mudah disadap saat melewati jaringan publik. Bagi perusahaan dengan tim yang bekerja jarak jauh, VPN memungkinkan akses aman ke sistem internal tanpa membuka port berbahaya ke internet. Pemilihannya perlu mempertimbangkan kecepatan, kemudahan pengelolaan, serta dukungan terhadap kebijakan keamanan yang berlaku.',
            ],
            [
                'slug' => 'internet-of-things-industri',
                'judul' => 'Internet of Things dan Transformasi Sektor Industri',
                'kategori' => 'Teknologi',
                'tanggal' => '2025-12-01',
                'penulis' => 'Tim Redaksi',
                'gambar' => 'images/artikel/transform-digital-umkm.jpg',
                'ringkas' => 'IoT mendorong otomasi dan pemantauan real-time di lingkungan industri.',
                'isi' => 'Internet of Things (IoT) menghubungkan perangkat dan sensor sehingga data dapat dipantau serta dianalisis secara real-time. Di sektor industri, teknologi ini mendukung pemeliharaan prediktif, pengendalian mutu, dan otomasi proses yang meningkatkan produktivitas sekaligus menekan biaya operasional. Keberhasilannya sangat bergantung pada infrastruktur jaringan yang andal dan stabil, karena lalu lintas data yang besar menuntut koneksi berkecepatan tinggi dengan latensi rendah.',
            ],
            [
                'slug' => 'pentingnya-backup-data',
                'judul' => 'Pentingnya Backup Data bagi Kelangsungan Bisnis',
                'kategori' => 'Keamanan',
                'tanggal' => '2025-11-24',
                'penulis' => 'Tim Redaksi',
                'gambar' => 'images/artikel/pentingnya-keamanan-jaringan-bagi-perusahaan.jpg',
                'ringkas' => 'Backup data yang terencana menyelamatkan bisnis dari kehilangan informasi.',
                'isi' => 'Kehilangan data akibat kerusakan perangkat, serangan ransomware, atau kesalahan manusia dapat melumpuhkan operasional bisnis. Karena itu, strategi backup yang baik perlu menerapkan aturan 3-2-1: tiga salinan data, pada dua jenis media berbeda, dengan satu salinan disimpan di lokasi terpisah. Uji pemulihan secara berkala juga penting agar proses restore benar-benar berjalan saat dibutuhkan, bukan hanya sekadar menyimpan salinan.',
            ],
            [
                'slug' => 'wifi-6-untuk-kantor-modern',
                'judul' => 'WiFi 6: Standar Nirkabel Baru untuk Kantor Modern',
                'kategori' => 'Jaringan',
                'tanggal' => '2025-11-17',
                'penulis' => 'Tim Redaksi',
                'gambar' => 'images/artikel/pentingnnya-fiberoptik.jpg',
                'ringkas' => 'WiFi 6 menghadirkan koneksi lebih cepat dan stabil untuk banyak perangkat.',
                'isi' => 'WiFi 6 (802.11ax) dirancang menghadapi kepadatan perangkat yang tinggi di lingkungan kantor modern. Teknologi ini meningkatkan kapasitas jaringan, mengurangi latensi, dan lebih efisien dalam mengelola banyak koneksi secara bersamaan tanpa penurunan performa berarti. Penerapannya tetap perlu didukung perangkat access point yang kompatibel, penataan titik akses yang tepat, serta bandwidth internet yang memadai agar manfaatnya terasa optimal.',
            ],
        ];

        foreach ($artikel as $item) {
            Artikel::updateOrCreate(['slug' => $item['slug']], $item);
        }
    }
}
