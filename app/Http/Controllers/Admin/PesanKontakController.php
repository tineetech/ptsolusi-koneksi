<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\BalasanPesanKontak;
use App\Models\PesanKontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class PesanKontakController extends Controller
{
    public function index()
    {
        return view('pages.admin.pesan.index', [
            'pesan' => PesanKontak::latest()->get(),
        ]);
    }

    public function show(PesanKontak $pesan)
    {
        return view('pages.admin.pesan.show', [
            'pesan' => $pesan,
        ]);
    }

    public function destroy(PesanKontak $pesan)
    {
        $pesan->delete();

        return redirect()->route('admin.pesan.index')->with('success', 'Pesan berhasil dihapus.');
    }

    public function balas(Request $request, PesanKontak $pesan)
    {
        $data = $request->validate([
            'subjek' => ['required', 'string', 'max:255'],
            'isi' => ['required', 'string'],
        ]);

        $pesan->update(['status' => 'replied']);

        try {
            Mail::to($pesan->email)->send(new BalasanPesanKontak($pesan, $data['subjek'], $data['isi']));
        } catch (Throwable $e) {
            Log::error('Gagal mengirim balasan pesan kontak: '.$e->getMessage());

            return back()->withInput()->with('error', 'Status pesan sudah diubah menjadi Dibalas, tetapi email gagal dikirim. Periksa konfigurasi email lalu coba lagi.');
        }

        return back()->with('success', 'Balasan berhasil dikirim ke '.$pesan->email.'.');
    }

    public function updateStatus(Request $request, PesanKontak $pesan)
    {
        $data = $request->validate([
            'status' => ['required', 'in:pending,replied'],
        ]);

        $pesan->update($data);

        return back()->with('success', 'Status pesan berhasil diperbarui.');
    }
}
