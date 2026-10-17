@extends('layouts.main')

@section('title', 'Beranda')
@section('meta_description', 'PT Solusi Koneksi - Solusi jaringan, internet, dan infrastruktur teknologi informasi terpercaya.')

@section('content')
    <section class="relative overflow-hidden bg-slate-900">
        <img src="{{ asset('images/gedung1.jpg') }}" alt="Tim PT Solusi Koneksi"
             class="absolute inset-0 h-full w-full object-cover opacity-30">
        <div class="relative mx-auto max-w-6xl px-4 py-24 md:py-32">
            <span class="inline-block rounded-full bg-indigo-500/20 px-4 py-1 text-xs font-semibold text-indigo-200">
                Solusi Teknologi Terpercaya
            </span>
            <h1 class="mt-6 max-w-3xl text-4xl font-bold leading-tight text-white md:text-5xl">
                Menghubungkan Bisnis Anda dengan Teknologi yang Andal
            </h1>
            <p class="mt-6 max-w-2xl text-lg text-slate-200">
                PT Solusi Koneksi menyediakan layanan instalasi jaringan, penyediaan internet,
                keamanan, dan infrastruktur data center untuk mendukung pertumbuhan bisnis Anda.
            </p>
            <div class="mt-8 flex flex-wrap gap-4">
                <a href="{{ route('produk') }}" class="rounded-lg bg-indigo-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700">
                    Lihat Layanan
                </a>
                <a href="{{ route('kontak') }}" class="rounded-lg border border-white/30 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white/10">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>

    <section class="relative z-10 mx-auto -mt-12 max-w-6xl px-4">
        <div class="grid gap-4 rounded-2xl bg-white p-6 shadow-lg md:grid-cols-4">
            @foreach ([['10+', 'Tahun Pengalaman'], ['500+', 'Proyek Selesai'], ['24/7', 'Dukungan Teknis'], ['99,5%', 'SLA Ketersediaan']] as [$angka, $label])
                <div class="text-center">
                    <div class="text-3xl font-bold text-indigo-600">{{ $angka }}</div>
                    <div class="mt-1 text-sm text-slate-500">{{ $label }}</div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-4 py-20">
        <div class="flex items-end justify-between">
            <div>
                <h2 class="text-3xl font-bold text-slate-900">Produk &amp; Layanan</h2>
                <p class="mt-2 text-slate-500">Solusi lengkap untuk kebutuhan teknologi informasi Anda.</p>
            </div>
            <a href="{{ route('produk') }}" class="hidden text-sm font-semibold text-indigo-600 hover:text-indigo-700 md:block">Lihat semua &rarr;</a>
        </div>

        <div class="mt-10 grid gap-6 md:grid-cols-3">
            @foreach ($produk as $item)
                <a href="{{ route('produk.detail', $item['slug']) }}"
                   class="group overflow-hidden rounded-2xl border border-slate-200 bg-white transition hover:-translate-y-1 hover:shadow-xl">
                    <img src="{{ asset($item['gambar']) }}" alt="{{ $item['nama'] }}" class="h-48 w-full object-cover">
                    <div class="p-6">
                        <span class="text-xs font-semibold uppercase tracking-wide text-indigo-600">{{ $item['kategori'] }}</span>
                        <h3 class="mt-2 text-lg font-bold text-slate-900 group-hover:text-indigo-600">{{ $item['nama'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-500">{{ $item['ringkas'] }}</p>
                        <span class="mt-4 inline-block text-sm font-semibold text-indigo-600">Selengkapnya &rarr;</span>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <section class="bg-white py-20">
        <div class="mx-auto max-w-6xl px-4">
            <div class="flex items-end justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-slate-900">Artikel &amp; Informasi Terkini</h2>
                    <p class="mt-2 text-slate-500">Berita dan wawasan seputar dunia teknologi informasi.</p>
                </div>
                <a href="{{ route('artikel') }}" class="hidden text-sm font-semibold text-indigo-600 hover:text-indigo-700 md:block">Lihat semua &rarr;</a>
            </div>

            <div class="mt-10 grid gap-6 md:grid-cols-3">
                @foreach ($artikel as $item)
                    <a href="{{ route('artikel.detail', $item['slug']) }}"
                       class="group overflow-hidden rounded-2xl border border-slate-200 transition hover:-translate-y-1 hover:shadow-xl">
                        <img src="{{ asset($item['gambar']) }}" alt="{{ $item['judul'] }}" class="h-44 w-full object-cover">
                        <div class="p-6">
                            <div class="flex items-center gap-3 text-xs text-slate-400">
                                <span class="font-semibold text-indigo-600">{{ $item['kategori'] }}</span>
                                <span>&middot;</span>
                                <span>{{ $item['tanggal_formatted'] }}</span>
                            </div>
                            <h3 class="mt-2 text-lg font-bold text-slate-900 group-hover:text-indigo-600">{{ $item['judul'] }}</h3>
                            <p class="mt-2 text-sm leading-relaxed text-slate-500">{{ $item['ringkas'] }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-4 py-20">
        <div class="rounded-3xl bg-indigo-600 px-8 py-12 text-center md:px-16">
            <h2 class="text-3xl font-bold text-white">Siap Meningkatkan Infrastruktur Teknologi Anda?</h2>
            <p class="mx-auto mt-4 max-w-2xl text-indigo-100">
                Konsultasikan kebutuhan jaringan dan teknologi informasi perusahaan Anda bersama tim kami.
            </p>
            <a href="{{ route('kontak') }}" class="mt-8 inline-block rounded-lg bg-white px-8 py-3 text-sm font-semibold text-indigo-600 transition hover:bg-indigo-50">
                Mulai Konsultasi
            </a>
        </div>
    </section>
@endsection
