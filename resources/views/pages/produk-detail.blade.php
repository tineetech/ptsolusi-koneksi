@extends('layouts.main')

@section('title', $produk['nama'])
@section('meta_description', $produk['ringkas'])

@section('content')
    <x-page-header
        :title="$produk['nama']"
        :subtitle="$produk['ringkas']"
        :breadcrumb="['Produk' => route('produk'), $produk['nama'] => null]" />

    <section class="mx-auto max-w-6xl px-4 py-16">
        <div class="grid gap-12 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <img src="{{ asset($produk['gambar']) }}" alt="{{ $produk['nama'] }}"
                     class="h-80 w-full rounded-2xl object-cover shadow-lg">

                <span class="mt-8 inline-block rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-indigo-600">
                    {{ $produk['kategori'] }}
                </span>
                <h2 class="mt-3 text-3xl font-bold text-slate-900">{{ $produk['nama'] }}</h2>
                <p class="mt-6 leading-relaxed text-slate-600">{{ $produk['deskripsi'] }}</p>

                <h3 class="mt-10 text-xl font-bold text-slate-900">Yang Anda Dapatkan</h3>
                <ul class="mt-4 grid gap-3 sm:grid-cols-2">
                    @foreach ($produk['fitur'] as $fitur)
                        <li class="flex items-start gap-3 rounded-xl border border-slate-200 bg-white p-4">
                            <i class="bx bx-check-circle mt-0.5 text-xl text-indigo-600"></i>
                            <span class="text-sm text-slate-600">{{ $fitur }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <aside class="space-y-6">
                <div class="rounded-2xl bg-indigo-600 p-8 text-white">
                    <h3 class="text-lg font-bold">Tertarik dengan layanan ini?</h3>
                    <p class="mt-2 text-sm text-indigo-100">
                        Hubungi tim kami untuk mendapatkan penawaran dan konsultasi gratis.
                    </p>
                    <a href="https://wa.me/6289526333265?text={{ urlencode('Halo, saya mau konsultasi layanan '.$produk['nama'].'.') }}"
                       target="_blank" rel="noopener noreferrer"
                       class="mt-6 inline-flex items-center gap-2 rounded-lg bg-white px-5 py-2.5 text-sm font-semibold text-indigo-600 transition hover:bg-indigo-50">
                        <i class="bx bxl-whatsapp"></i> Hubungi Kami
                    </a>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-6">
                    <h3 class="text-sm font-semibold uppercase tracking-wide text-slate-400">Produk Lainnya</h3>
                    <ul class="mt-4 space-y-4">
                        @foreach ($lainnya as $item)
                            <li>
                                <a href="{{ route('produk.detail', $item['slug']) }}" class="group flex items-center gap-3">
                                    <img src="{{ asset($item['gambar']) }}" alt="{{ $item['nama'] }}" class="h-14 w-14 rounded-lg object-cover">
                                    <span class="text-sm font-medium text-slate-700 group-hover:text-indigo-600">{{ $item['nama'] }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>
        </div>

        <div class="mt-10">
            <a href="{{ route('produk') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-indigo-600 hover:text-indigo-700">
                <i class="bx bx-left-arrow-alt"></i> Kembali ke daftar produk
            </a>
        </div>
    </section>
@endsection
