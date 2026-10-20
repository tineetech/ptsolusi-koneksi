<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Klien;
use App\Models\Produk;
use Illuminate\Http\Request;

class KlienController extends Controller
{
    public function index()
    {
        return view('pages.admin.klien.index', [
            'klien' => Klien::with('layanan')->latest()->get(),
            'layanan' => Produk::orderBy('nama')->get(),
            'perusahaan' => Klien::query()->distinct()->orderBy('nama_perusahaan')->pluck('nama_perusahaan'),
        ]);
    }

    public function create()
    {
        return view('pages.admin.klien.create', [
            'layanan' => Produk::orderBy('nama')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'layanan_id' => ['required', 'exists:produk,id'],
            'nama_client' => ['required', 'string', 'max:255'],
            'nama_perusahaan' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'no_telephone' => ['required', 'string', 'max:30'],
            'alamat_perusahaan' => ['required', 'string'],
            'notes' => ['nullable', 'string'],
            'status' => ['required', 'in:proses,konsultasi,terjual'],
        ]);

        Klien::create($data);

        return redirect()->route('admin.klien.index')->with('success', 'Data klien berhasil ditambahkan.');
    }

    public function edit(Klien $klien)
    {
        return view('pages.admin.klien.edit', [
            'klien' => $klien,
            'layanan' => Produk::orderBy('nama')->get(),
        ]);
    }

    public function update(Request $request, Klien $klien)
    {
        $data = $request->validate([
            'layanan_id' => ['required', 'exists:produk,id'],
            'nama_client' => ['required', 'string', 'max:255'],
            'nama_perusahaan' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'no_telephone' => ['required', 'string', 'max:30'],
            'alamat_perusahaan' => ['required', 'string'],
            'notes' => ['nullable', 'string'],
            'status' => ['required', 'in:proses,konsultasi,terjual'],
        ]);

        $klien->update($data);

        return redirect()->route('admin.klien.index')->with('success', 'Data klien berhasil diperbarui.');
    }

    public function destroy(Klien $klien)
    {
        $klien->delete();

        return redirect()->route('admin.klien.index')->with('success', 'Data klien berhasil dihapus.');
    }
}
