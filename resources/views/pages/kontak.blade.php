@extends('layouts.main')

@section('title', 'Kontak Kami')
@section('meta_description', 'Hubungi PT Solusi Koneksi untuk konsultasi dan informasi layanan teknologi informasi.')

@section('content')
    <x-page-header
        title="Kontak Kami"
        subtitle="Kami siap membantu kebutuhan teknologi informasi perusahaan Anda."
        :breadcrumb="['Kontak' => null]" />

    <section class="mx-auto max-w-6xl px-4 py-16">
        <div class="grid gap-10 lg:grid-cols-3">
            <div class="space-y-4">
                @foreach ([
                    ['icon' => 'bx-map', 'judul' => 'Alamat', 'isi' => 'Jl. Raya Pajajaran No. 88 F Kota Bogor 16153'],
                    ['icon' => 'bx-phone', 'judul' => 'Telepon', 'isi' => '(021) 1234-5678'],
                    ['icon' => 'bx-envelope', 'judul' => 'Email', 'isi' => 'info@solusikoneksi.id'],
                    ['icon' => 'bx-time', 'judul' => 'Jam Operasional', 'isi' => 'Senin - Jumat, 08.00 - 17.00 WIB'],
                ] as $info)
                    <div class="flex items-start gap-4 rounded-2xl border border-slate-200 bg-white p-5">
                        <span class="flex h-11 w-11 flex-none items-center justify-center rounded-xl bg-indigo-50 text-xl text-indigo-600">
                            <i class="bx {{ $info['icon'] }}"></i>
                        </span>
                        <div>
                            <h3 class="text-sm font-semibold text-slate-900">{{ $info['judul'] }}</h3>
                            <p class="mt-1 text-sm text-slate-500">{{ $info['isi'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="lg:col-span-2">
                <form action="#" method="POST" class="rounded-2xl border border-slate-200 bg-white p-8">
                    @csrf
                    <h2 class="text-xl font-bold text-slate-900">Kirim Pesan</h2>
                    <p class="mt-1 text-sm text-slate-500">Isi formulir di bawah ini, tim kami akan segera menghubungi Anda.</p>

                    <div class="mt-6 grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="nama" class="block text-sm font-medium text-slate-700">Nama Lengkap</label>
                            <input type="text" id="nama" name="nama" required
                                   class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                            <input type="email" id="email" name="email" required
                                   class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                        </div>
                        <div class="sm:col-span-2">
                            <label for="subjek" class="block text-sm font-medium text-slate-700">Subjek</label>
                            <input type="text" id="subjek" name="subjek" required
                                   class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                        </div>
                        <div class="sm:col-span-2">
                            <label for="pesan" class="block text-sm font-medium text-slate-700">Pesan</label>
                            <textarea id="pesan" name="pesan" rows="5" required
                                      class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"></textarea>
                        </div>
                    </div>

                    <button type="submit"
                            class="mt-6 inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700">
                        <i class="bx bx-send"></i> Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
