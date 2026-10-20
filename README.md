# PT Solusi Koneksi — Website Company Profile & CMS

Website company profile untuk **PT Solusi Koneksi** yang menyediakan solusi jaringan, internet, keamanan, dan infrastruktur teknologi informasi. Proyek ini dibangun dengan **Laravel 12** dan dilengkapi panel admin untuk mengelola seluruh konten website.

---

## Daftar Isi

- [Fitur](#fitur)
- [Teknologi](#teknologi)
- [Kebutuhan Sistem](#kebutuhan-sistem)
- [Instalasi](#instalasi)
- [Menjalankan Aplikasi](#menjalankan-aplikasi)
- [Akun Admin](#akun-admin)
- [Struktur Proyek](#struktur-proyek)
- [Skema Database](#skema-database)
- [Pengelolaan Konten (CMS)](#pengelolaan-konten-cms)
- [Upload Gambar](#upload-gambar)
- [Daftar Route](#daftar-route)
- [Testing](#testing)
- [Perintah yang Sering Dipakai](#perintah-yang-sering-dipakai)
- [Troubleshooting](#troubleshooting)
- [Catatan untuk Produksi](#catatan-untuk-produksi)

---

## Fitur

### Halaman Publik (Landing Page)

- **Home** — hero, marquee logo klien, section tentang kami, layanan unggulan, artikel terbaru, dan CTA.
- **Profil** — tentang perusahaan, visi, misi, dan nilai perusahaan (diambil dari CMS).
- **Layanan** — daftar produk/layanan dan halaman detail beserta fitur-fitur layanan.
- **Artikel** — daftar artikel dengan pagination 6 per halaman dan halaman detail artikel.
- **Galeri** — dokumentasi kegiatan perusahaan.
- **Kontak** — peta Google Maps, informasi kontak, dan formulir pesan yang tersimpan ke database.
- **Responsif** — tampilan dioptimalkan untuk mobile, tablet, dan desktop.
- **Animasi** — fade-in saat halaman dimuat / di-scroll, serta marquee logo klien (menghormati `prefers-reduced-motion`).

### Panel Admin (`/admin`)

- **Dashboard** — statistik jumlah layanan/artikel/galeri, daftar layanan terbaru, artikel terbaru, dan pintasan cepat.
- **Kelola Layanan** — tambah, edit, hapus, upload gambar.
- **Kelola Data Klien** — tambah, edit, hapus data klien beserta layanan yang digunakan.
- **Kelola Artikel** — tambah, edit, hapus, upload gambar.
- **Kelola Galeri** — tambah, edit, hapus, upload gambar.
- **Pesan Masuk** — lihat daftar, detail pesan, balas pesan ke email pengirim (status otomatis menjadi **Dibalas**), ubah status **Pending/Dibalas**, dan hapus pesan.
- **CMS Profil** — kelola logo perusahaan (primary & white), favicon, tentang kami, visi, misi, nilai perusahaan (bisa tambah/hapus), dan gambar profil.
- **Pengaturan** — ubah nama, email, dan kata sandi admin.

---

## Teknologi

| Bagian | Teknologi |
| --- | --- |
| Backend | PHP 8.2+ / Laravel 12 |
| Database | MySQL / MariaDB |
| Templating | Blade |
| Styling | Tailwind CSS v4 (via CDN, tanpa build step) |
| Ikon | Font Awesome 6.7.2 (via CDN) |
| Autentikasi | Laravel Breeze (login saja) |
| Testing | PHPUnit 11 |

> Proyek ini **tidak memakai Node.js/Vite**. Tidak ada `package.json`, sehingga tidak perlu `npm install` atau `npm run build`. Tailwind dan Font Awesome dimuat langsung dari CDN.

---

## Kebutuhan Sistem

- PHP **8.2 atau lebih baru** (proyek ini dikembangkan dengan PHP 8.3)
- Composer 2
- MySQL atau MariaDB
- Ekstensi PHP: `pdo_mysql`, `mbstring`, `openssl`, `fileinfo`, `ctype`, `json`, `tokenizer`, `xml`

Pastikan `php` dan `composer` dapat dijalankan dari terminal.

---

## Instalasi

### 1. Clone / masuk ke folder proyek

```bash
cd ujikom-pt-solusi-koneksi
```

### 2. Install dependency PHP

```bash
composer install
```

### 3. Buat file `.env`

Windows (PowerShell / CMD):

```bash
copy .env.example .env
```

Linux / macOS:

```bash
cp .env.example .env
```

### 4. Generate application key

```bash
php artisan key:generate
```

### 5. Buat database MySQL

```sql
CREATE DATABASE compro_solusi_koneksi
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;
```

### 6. Sesuaikan konfigurasi database di `.env`

> Secara default `.env.example` memakai SQLite. Untuk proyek ini, ubah ke MySQL:

```env
APP_NAME="PT Solusi Koneksi"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=compro_solusi_koneksi
DB_USERNAME=root
DB_PASSWORD=
```

### 7. Jalankan migrasi dan seeder

```bash
php artisan migrate --seed
```

Perintah ini akan membuat tabel dan mengisi data awal:

- 1 akun admin
- 4 layanan
- 3 data klien
- 9 artikel
- 6 foto galeri
- konten profil (tentang, visi, misi, nilai)

### 8. Jalankan server

```bash
php artisan serve
```

Buka **http://127.0.0.1:8000**. Panel admin ada di **http://127.0.0.1:8000/admin**.

### 9. Konfigurasi email (SMTP)

Fitur **Balas Pesan** di panel admin mengirim email langsung ke pengirim pesan. Atur SMTP di `.env`:

```env
MAIL_MAILER=smtp
MAIL_SCHEME=null
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=emailanda@gmail.com
MAIL_PASSWORD=app-password-anda
MAIL_FROM_ADDRESS=emailanda@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

- Untuk Gmail, gunakan **App Password**, bukan password akun biasa.
- Sesuaikan `MAIL_HOST`, `MAIL_PORT`, dan `MAIL_SCHEME` jika memakai penyedia lain (mis. Mailtrap, Brevo, atau SMTP hosting).
- Jalankan `php artisan config:clear` setiap kali mengubah `.env`.

---

## Menjalankan Aplikasi

```bash
# Menjalankan server development
php artisan serve

# Atau lewat composer script
composer run dev
```

Opsional, jika port default dipakai:

```bash
php artisan serve --port=8001
```

---

## Akun Admin

Data dari `AdminSeeder`:

| Field | Nilai |
| --- | --- |
| Email | `admin@gmail.com` |
| Password | `admin123` |

> **Penting:** segera ubah kata sandi melalui menu **Pengaturan** setelah login pertama, terutama jika aplikasi dipakai di server publik.

Seeder bawaan Laravel juga membuat user `test@example.com` dengan kata sandi acak; akun tersebut bukan akun admin yang dipakai untuk login.

---

## Struktur Proyek

```text
app/
├── Http/Controllers/
│   ├── HomeController.php          # halaman publik
│   ├── ProfilController.php
│   ├── ProdukController.php
│   ├── ArtikelController.php
│   ├── GaleriController.php
│   ├── KontakController.php
│   ├── Auth/                       # login/logout (Breeze)
│   └── Admin/                      # controller panel admin
│       ├── DashboardController.php
│       ├── LayananController.php
│       ├── KlienController.php
│       ├── ArtikelController.php
│       ├── GaleriController.php
│       ├── CmsController.php
│       ├── PesanKontakController.php
│       └── PengaturanController.php
└── Models/
    ├── Produk.php                  # tabel produk (layanan)
    ├── Klien.php                   # tabel klien (relasi ke produk)
    ├── Artikel.php
    ├── Galeri.php
    ├── Cms.php
    ├── PesanKontak.php
    └── User.php

database/
├── migrations/                     # struktur tabel
└── seeders/                        # data awal (admin, layanan, artikel, dll.)

public/
└── images/
    ├── layanan/                    # upload gambar layanan
    ├── artikel/                    # upload gambar artikel
    ├── galery/                     # upload gambar galeri
    ├── profil/                     # upload gambar profil/CMS
    ├── logo/                       # upload logo perusahaan & favicon
    └── klien/                      # logo klien (SVG) untuk marquee

resources/views/
├── layouts/
│   ├── main.blade.php              # layout landing page
│   ├── admin.blade.php             # layout panel admin
│   └── guest.blade.php             # layout halaman login
├── pages/                          # halaman publik
│   ├── home.blade.php
│   ├── profil.blade.php
│   ├── produk.blade.php
│   ├── produk-detail.blade.php
│   ├── artikel.blade.php
│   ├── artikel-detail.blade.php
│   ├── galeri.blade.php
│   ├── kontak.blade.php
│   └── admin/                      # halaman panel admin
├── components/                     # komponen Blade (page-header, image-input, dll.)
└── partials/tailwind.blade.php     # konfigurasi Tailwind CDN

routes/
├── web.php                         # route publik & admin
└── auth.php                        # route login/logout

tests/Feature/                      # feature test (PHPUnit)
```

---

## Skema Database

| Tabel | Keterangan |
| --- | --- |
| `users` | Akun admin |
| `produk` | Layanan/produk. Kolom penting: `slug` (unik), `nama`, `kategori`, `gambar`, `ringkas`, `deskripsi`, `fitur` (JSON array) |
| `klien` | Data klien. Kolom: `layanan_id` (relasi ke `produk.id`), `nama_client`, `nama_perusahaan`, `email`, `no_telephone`, `alamat_perusahaan`, `notes`, `status` (`proses`/`konsultasi`/`terjual`) |
| `artikel` | Artikel. Kolom: `slug` (unik), `judul`, `kategori`, `tanggal`, `penulis`, `gambar`, `ringkas`, `isi` |
| `galeri` | Galeri. Kolom: `judul`, `tanggal`, `gambar` |
| `cms` | Konten dinamis berbentuk key-value (`key` unik, `value` longtext), termasuk logo dan favicon |
| `pesan_kontak` | Pesan dari form kontak: `nama`, `email`, `subjek`, `pesan`, `status` (`pending`/`replied`) |
| `sessions`, `cache`, `jobs`, `password_reset_tokens` | Tabel bawaan Laravel |

Slug produk dan artikel dibuat otomatis dari nama/judul. Jika slug sudah dipakai, sistem menambahkan akhiran angka (`-1`, `-2`, dst.).

---

## Pengelolaan Konten (CMS)

Konten profil disimpan di tabel `cms` dengan format key-value. Admin **tidak perlu** mengedit database secara langsung — cukup lewat menu **CMS Profil**.

Key yang digunakan:

| Key | Isi |
| --- | --- |
| `profil.tentang.judul` | Judul section tentang kami |
| `profil.tentang.isi` | Paragraf tentang kami (mendukung beberapa baris) |
| `profil.tentang.gambar` | Path/URL gambar profil |
| `profil.visi` | Visi perusahaan |
| `profil.misi` | Misi perusahaan (satu poin per baris) |
| `profil.nilai1`, `profil.nilai2`, ... | Nilai perusahaan, format `Judul \| Deskripsi` |
| `logo.favicon` | Path/URL logo favicon website |
| `logo.primary` | Path/URL logo perusahaan (primary color) untuk navbar |
| `logo.white` | Path/URL logo perusahaan (white color) untuk footer & sidebar admin |

Catatan:

- Nilai perusahaan di form admin memakai **accordion** dan bisa ditambah/dihapus. Saat disimpan, sistem menomori ulang key `profil.nilaiN` secara berurutan.
- Jika belum ada data, model `Cms::profil()` menyediakan nilai default sehingga halaman tetap tampil.
- Jika logo belum diunggah, `Cms::branding()` memakai default: `images/logo-sk4.png` (favicon), `images/logo-sk1.png` (primary), dan `images/logo-sk8.png` (white).

---

## Upload Gambar

- Format yang didukung: **JPG, JPEG, PNG, WEBP** (logo & favicon juga mendukung **SVG**)
- Ukuran maksimum: **2 MB**
- Lokasi penyimpanan: `public/images/{layanan,artikel,galery,profil,logo}`
- Path yang disimpan di database berbentuk relatif, contoh: `images/layanan/nama-file-abc123.jpg`
- Upload memakai komponen drag & drop `<x-image-input>`.
- Saat edit, jika gambar baru diunggah, gambar lama (khusus yang berada di folder terkait) akan dihapus otomatis.

> Tidak perlu menjalankan `php artisan storage:link`, karena gambar disimpan langsung di folder `public/images`.

---

## Daftar Route

### Publik

| Method | URL | Keterangan |
| --- | --- | --- |
| GET | `/` | Home |
| GET | `/profil` | Profil perusahaan |
| GET | `/produk` | Daftar layanan |
| GET | `/produk/{slug}` | Detail layanan |
| GET | `/artikel` | Daftar artikel (6 per halaman) |
| GET | `/artikel/{slug}` | Detail artikel |
| GET | `/galeri` | Galeri kegiatan |
| GET | `/kontak` | Halaman kontak |
| POST | `/kontak` | Kirim pesan kontak |

### Autentikasi

| Method | URL | Keterangan |
| --- | --- | --- |
| GET | `/login` | Halaman login |
| POST | `/login` | Proses login |
| POST | `/logout` | Logout (butuh login) |

### Admin (butuh login, prefix `/admin`)

| URL | Keterangan |
| --- | --- |
| `/admin` | Dashboard |
| `/admin/layanan` | CRUD layanan |
| `/admin/klien` | CRUD data klien |
| `/admin/artikel` | CRUD artikel |
| `/admin/galeri` | CRUD galeri |
| `/admin/pesan` | Daftar pesan masuk |
| `/admin/pesan/{id}` | Detail pesan & form balasan |
| `/admin/pesan/{id}/balas` (POST) | Kirim balasan ke email pengirim |
| `/admin/pesan/{id}/status` (PATCH) | Ubah status pesan (Pending/Dibalas) |
| `/admin/cms` | Edit logo, favicon, dan konten profil |
| `/admin/pengaturan` | Pengaturan akun admin |

---

## Testing

Jalankan seluruh test:

```bash
php artisan test
```

Saat ini tersedia **22 test** (87 assertion) yang mencakup:

- Halaman publik dapat dibuka
- Login berhasil/gagal dan logout
- Semua halaman panel admin dapat dibuka
- Tambah layanan beserta upload gambar
- CRUD data klien
- Update konten CMS, logo perusahaan, dan informasi akun
- Pengiriman pesan kontak, balasan email, perubahan status, dan penghapusan pesan oleh admin

### Catatan penting tentang database test

- Test dijalankan menggunakan **database MySQL yang sama** dengan development (konfigurasi SQLite di `phpunit.xml` sengaja dinonaktifkan karena ekstensi `pdo_sqlite` tidak tersedia).
- Test memakai `DatabaseTransactions`, jadi perubahan data akan di-rollback dan **tidak menghapus data development**.
- Beberapa test bergantung pada data hasil seeder (mis. akun `admin@gmail.com`). Jalankan `php artisan migrate --seed` terlebih dahulu.
- Jangan mengaktifkan kembali baris `DB_CONNECTION=sqlite` di `phpunit.xml` kecuali `pdo_sqlite` sudah diaktifkan di `php.ini`.

---

## Perintah yang Sering Dipakai

```bash
# Menjalankan server
php artisan serve

# Migrasi + isi data awal
php artisan migrate --seed

# Menjalankan satu seeder saja
php artisan db:seed --class=ArtikelSeeder

# Reset total database (HAPUS semua data, lalu seed ulang)
php artisan migrate:fresh --seed

# Membersihkan cache tampilan/konfigurasi/route
php artisan view:clear
php artisan config:clear
php artisan route:clear
php artisan optimize:clear

# Menjalankan test
php artisan test

# Console interaktif
php artisan tinker
```

---

## Troubleshooting

| Masalah | Solusi |
| --- | --- |
| `No application encryption key has been specified` | Jalankan `php artisan key:generate` |
| `SQLSTATE[HY000] [1049] Unknown database` | Buat database `compro_solusi_koneksi` atau sesuaikan `DB_DATABASE` di `.env` |
| `could not find driver` / koneksi DB gagal | Aktifkan `pdo_mysql` di `php.ini`, lalu restart terminal/server |
| Perubahan tampilan tidak muncul | Jalankan `php artisan view:clear` |
| Perubahan `.env` tidak terbaca | Jalankan `php artisan config:clear` |
| Gambar upload tidak tampil | Pastikan file ada di `public/images/...` dan path di database benar |
| Test gagal karena admin tidak ditemukan | Jalankan `php artisan db:seed` (atau `--class=AdminSeeder`) |
| Port 8000 sudah dipakai | `php artisan serve --port=8001` |
| Halaman admin terus redirect ke login | Login lewat `/login` dengan akun admin yang benar |

---

## Catatan untuk Produksi

- Set `APP_ENV=production` dan `APP_DEBUG=false` di `.env`.
- Ganti kata sandi admin bawaan.
- Arahkan document root web server ke folder **`public/`**, bukan root proyek.
- Pastikan folder `public/images` dapat ditulis oleh proses web server.
- Jalankan:

```bash
php artisan migrate --force
php artisan optimize
```

- Jangan commit file `.env` ke repository.
- Backup database dan folder `public/images` secara berkala.

---

## Lisensi

Proyek ini dibuat untuk keperluan internal/ujikom **PT Solusi Koneksi**. Laravel sendiri dirilis di bawah lisensi MIT.
