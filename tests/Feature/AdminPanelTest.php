<?php

namespace Tests\Feature;

use App\Mail\BalasanPesanKontak;
use App\Models\Cms;
use App\Models\Klien;
use App\Models\PesanKontak;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use DatabaseTransactions;

    public function test_tamu_diarahkan_ke_halaman_login(): void
    {
        $this->get('/admin')->assertRedirect('/login');
    }

    public function test_admin_bisa_login_dengan_kredensial_benar(): void
    {
        $admin = User::where('email', 'admin@gmail.com')->first();

        $this->assertNotNull($admin, 'Akun admin belum di-seed.');
        $this->assertTrue(Hash::check('admin123', $admin->password), 'Password admin tidak cocok.');

        $this->post('/login', [
            'email' => 'admin@gmail.com',
            'password' => 'admin123',
        ])->assertRedirect('/admin');

        $this->assertAuthenticatedAs($admin);
    }

    public function test_login_gagal_dengan_password_salah(): void
    {
        $this->from('/login')->post('/login', [
            'email' => 'admin@gmail.com',
            'password' => 'salah',
        ])->assertRedirect('/login');

        $this->assertGuest();
    }

    public function test_admin_bisa_membuka_semua_halaman_panel(): void
    {
        $admin = User::where('email', 'admin@gmail.com')->firstOrFail();

        foreach (['/admin', '/admin/layanan', '/admin/layanan/create', '/admin/klien', '/admin/klien/create', '/admin/artikel', '/admin/artikel/create', '/admin/galeri', '/admin/galeri/create', '/admin/pesan', '/admin/cms', '/admin/pengaturan'] as $url) {
            $this->actingAs($admin)->get($url)->assertOk();
        }
    }

    public function test_pengunjung_bisa_mengirim_pesan_kontak(): void
    {
        $this->post('/kontak', [
            'nama' => 'Budi',
            'email' => 'budi@example.com',
            'subjek' => 'Konsultasi',
            'pesan' => 'Mohon informasi paket internet.',
        ])->assertRedirect('/kontak');

        $this->assertDatabaseHas('pesan_kontak', [
            'nama' => 'Budi',
            'email' => 'budi@example.com',
            'subjek' => 'Konsultasi',
            'pesan' => 'Mohon informasi paket internet.',
        ]);
    }

    public function test_admin_bisa_melihat_detail_pesan_kontak(): void
    {
        $admin = User::where('email', 'admin@gmail.com')->firstOrFail();

        $pesan = PesanKontak::create([
            'nama' => 'Rina',
            'email' => 'rina@example.com',
            'subjek' => 'Detail',
            'pesan' => 'Tolong kirim penawaran.',
        ]);

        $this->actingAs($admin)
            ->get('/admin/pesan/'.$pesan->id)
            ->assertOk()
            ->assertSee('Rina')
            ->assertSee('Tolong kirim penawaran.')
            ->assertSee('disabled', false);
    }

    public function test_admin_bisa_menghapus_pesan_kontak(): void
    {
        $admin = User::where('email', 'admin@gmail.com')->firstOrFail();

        $pesan = PesanKontak::create([
            'nama' => 'Siti',
            'email' => 'siti@example.com',
            'subjek' => 'Tanya',
            'pesan' => 'Apakah tersedia layanan VPN?',
        ]);

        $this->actingAs($admin)->delete('/admin/pesan/'.$pesan->id)->assertRedirect('/admin/pesan');

        $this->assertDatabaseMissing('pesan_kontak', ['id' => $pesan->id]);
    }

    public function test_admin_bisa_membalas_pesan_kontak(): void
    {
        Mail::fake();

        $admin = User::where('email', 'admin@gmail.com')->firstOrFail();

        $pesan = PesanKontak::create([
            'nama' => 'Andi',
            'email' => 'andi@example.com',
            'subjek' => 'Tanya Layanan',
            'pesan' => 'Apakah tersedia layanan internet dedicated?',
        ]);

        $this->from('/admin/pesan/'.$pesan->id)
            ->actingAs($admin)
            ->post('/admin/pesan/'.$pesan->id.'/balas', [
                'subjek' => 'Re: Tanya Layanan',
                'isi' => 'Ya, layanan tersebut tersedia.',
            ])
            ->assertRedirect('/admin/pesan/'.$pesan->id);

        Mail::assertSent(BalasanPesanKontak::class, function (BalasanPesanKontak $mail) use ($pesan) {
            return $mail->hasTo($pesan->email)
                && $mail->subjekBalasan === 'Re: Tanya Layanan'
                && $mail->isiBalasan === 'Ya, layanan tersebut tersedia.';
        });

        $this->assertSame('replied', $pesan->fresh()->status);
    }

    public function test_admin_bisa_mengubah_status_pesan_kontak(): void
    {
        $admin = User::where('email', 'admin@gmail.com')->firstOrFail();

        $pesan = PesanKontak::create([
            'nama' => 'Sinta',
            'email' => 'sinta@example.com',
            'subjek' => 'Pertanyaan',
            'pesan' => 'Mohon informasi harga.',
        ]);

        $this->assertSame('pending', $pesan->fresh()->status);

        $this->from('/admin/pesan/'.$pesan->id)
            ->actingAs($admin)
            ->patch('/admin/pesan/'.$pesan->id.'/status', ['status' => 'replied'])
            ->assertRedirect('/admin/pesan/'.$pesan->id);

        $this->assertSame('replied', $pesan->fresh()->status);
    }

    public function test_admin_bisa_menambah_klien(): void
    {
        $admin = User::where('email', 'admin@gmail.com')->firstOrFail();
        $layanan = Produk::firstOrFail();

        $this->actingAs($admin)->post('/admin/klien', [
            'layanan_id' => $layanan->id,
            'nama_client' => 'Dewi Lestari',
            'nama_perusahaan' => 'PT Maju Bersama',
            'email' => 'dewi@majubersama.co.id',
            'no_telephone' => '081234567890',
            'alamat_perusahaan' => 'Jl. Merdeka No. 1, Bandung',
            'notes' => 'Tertarik paket internet dedicated.',
            'status' => 'konsultasi',
        ])->assertRedirect('/admin/klien');

        $this->assertDatabaseHas('klien', [
            'nama_client' => 'Dewi Lestari',
            'nama_perusahaan' => 'PT Maju Bersama',
            'status' => 'konsultasi',
        ]);
    }

    public function test_admin_bisa_memperbarui_klien(): void
    {
        $admin = User::where('email', 'admin@gmail.com')->firstOrFail();
        $layanan = Produk::firstOrFail();

        $klien = Klien::create([
            'layanan_id' => $layanan->id,
            'nama_client' => 'Rudi Hartono',
            'nama_perusahaan' => 'CV Teknologi Nusantara',
            'email' => 'rudi@teknus.id',
            'no_telephone' => '081298765432',
            'alamat_perusahaan' => 'Jl. Asia Afrika No. 8, Bandung',
            'notes' => 'Konsultasi awal.',
            'status' => 'proses',
        ]);

        $this->actingAs($admin)->put('/admin/klien/'.$klien->id, [
            'layanan_id' => $layanan->id,
            'nama_client' => 'Rudi Hartono',
            'nama_perusahaan' => 'CV Teknologi Nusantara',
            'email' => 'rudi@teknus.id',
            'no_telephone' => '081298765432',
            'alamat_perusahaan' => 'Jl. Asia Afrika No. 8, Bandung',
            'notes' => 'Sudah deal.',
            'status' => 'terjual',
        ])->assertRedirect('/admin/klien');

        $this->assertSame('terjual', $klien->fresh()->status);
    }

    public function test_admin_bisa_menghapus_klien(): void
    {
        $admin = User::where('email', 'admin@gmail.com')->firstOrFail();
        $layanan = Produk::firstOrFail();

        $klien = Klien::create([
            'layanan_id' => $layanan->id,
            'nama_client' => 'Joko Prasetyo',
            'nama_perusahaan' => 'PT Bina Sarana',
            'email' => 'joko@binasarana.id',
            'no_telephone' => '081377665544',
            'alamat_perusahaan' => 'Jl. Pemuda No. 21, Semarang',
            'notes' => null,
            'status' => 'proses',
        ]);

        $this->actingAs($admin)->delete('/admin/klien/'.$klien->id)->assertRedirect('/admin/klien');

        $this->assertDatabaseMissing('klien', ['id' => $klien->id]);
    }

    public function test_admin_bisa_menambah_layanan(): void
    {
        $admin = User::where('email', 'admin@gmail.com')->firstOrFail();

        $this->actingAs($admin)->post('/admin/layanan', [
            'nama' => 'Uji Coba Layanan',
            'kategori' => 'Pengujian',
            'gambar' => UploadedFile::fake()->image('uji-coba.jpg'),
            'ringkas' => 'Ringkasan uji coba.',
            'deskripsi' => 'Deskripsi uji coba layanan.',
            'fitur' => "Fitur satu\nFitur dua",
        ])->assertRedirect('/admin/layanan');

        $produk = Produk::where('slug', 'uji-coba-layanan')->first();

        $this->assertNotNull($produk);
        $this->assertSame(['Fitur satu', 'Fitur dua'], $produk->fitur);
        $this->assertStringStartsWith('images/layanan/', $produk->gambar);

        @unlink(public_path($produk->gambar));
    }

    public function test_admin_bisa_memperbarui_konten_profil(): void
    {
        $admin = User::where('email', 'admin@gmail.com')->firstOrFail();

        $this->actingAs($admin)->put('/admin/cms', [
            'tentang_judul' => 'Judul Baru',
            'tentang_isi' => "Paragraf satu.\nParagraf dua.",
            'tentang_gambar' => UploadedFile::fake()->image('profil.jpg'),
            'visi' => 'Visi baru',
            'misi' => "Misi satu\nMisi dua",
            'nilai_judul' => ['Jujur', 'Cepat'],
            'nilai_deskripsi' => ['Selalu jujur', 'Bekerja cepat'],
        ])->assertRedirect('/admin/cms');

        $profil = Cms::profil();

        $this->assertSame('Judul Baru', $profil['tentang']['judul']);
        $this->assertSame("Paragraf satu.\nParagraf dua.", $profil['tentang']['isi']);
        $this->assertStringStartsWith('images/profil/', $profil['tentang']['gambar']);
        $this->assertSame('Jujur', $profil['nilai'][0]['judul']);
        $this->assertSame('Bekerja cepat', $profil['nilai'][1]['deskripsi']);

        @unlink(public_path($profil['tentang']['gambar']));
    }

    public function test_admin_bisa_memperbarui_logo_perusahaan(): void
    {
        $admin = User::where('email', 'admin@gmail.com')->firstOrFail();

        $this->actingAs($admin)->put('/admin/cms', [
            'tentang_judul' => 'Judul Baru',
            'tentang_isi' => 'Isi profil baru.',
            'visi' => 'Visi baru',
            'misi' => 'Misi baru',
            'logo_favicon' => UploadedFile::fake()->image('favicon.png'),
            'logo_primary' => UploadedFile::fake()->image('logo-primary.png'),
            'logo_white' => UploadedFile::fake()->image('logo-white.png'),
        ])->assertRedirect('/admin/cms');

        $logo = Cms::branding();

        $this->assertStringStartsWith('images/logo/', $logo['favicon']);
        $this->assertStringStartsWith('images/logo/', $logo['primary']);
        $this->assertStringStartsWith('images/logo/', $logo['white']);

        foreach ($logo as $path) {
            @unlink(public_path($path));
        }
    }

    public function test_admin_bisa_memperbarui_informasi_profil(): void
    {
        $admin = User::where('email', 'admin@gmail.com')->firstOrFail();

        $this->actingAs($admin)->put('/admin/pengaturan', [
            'name' => 'Nama Baru',
            'email' => 'admin@gmail.com',
            'password' => 'rahasia123',
            'password_confirmation' => 'rahasia123',
        ])->assertRedirect('/admin/pengaturan');

        $admin->refresh();

        $this->assertSame('Nama Baru', $admin->name);
        $this->assertTrue(Hash::check('rahasia123', $admin->password));
    }
}
