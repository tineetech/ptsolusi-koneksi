@extends('layouts.main')

@section('title', 'Beranda')
@section('meta_description', 'PT Solusi Koneksi - Solusi jaringan, internet, dan infrastruktur teknologi informasi terpercaya.')

@section('content')
    <section class="relative overflow-hidden bg-slate-900">
        <div class="absolute inset-0 h-full w-full object-cover opacity-30" style="background: url('{{ asset('images/gedung1.jpg') }}'); background-size: cover; background-attachment: fixed">

        </div>
        {{-- <img src="{{ asset('images/gedung1.jpg') }}" alt="Tim PT Solusi Koneksi"
             class="absolute inset-0 h-full w-full object-cover opacity-30" style=""> --}}
        <div class="relative mx-auto w-full flex justify-center text-center items-center flex-col px-4 py-24 md:py-32 " style="margin-top: -40px">
            <h1 class="mt-6 max-w-3xl text-4xl font-bold leading-tight text-white md:text-5xl">
                Menghubungkan Bisnis Anda dengan Teknologi yang Andal
            </h1>
            <p class="mt-6 max-w-2xl text-lg text-slate-200">
                PT Solusi Koneksi menyediakan layanan instalasi jaringan, penyediaan internet,
                keamanan, dan infrastruktur data center untuk mendukung pertumbuhan bisnis Anda.
            </p>
            <div class="mt-8 flex flex-wrap gap-4 ">
                <a href="{{ route('produk') }}" class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700">
                    Lihat Layanan
                    <i class="fa-solid fa-arrow-up-right-from-square text-sm"></i>
                </a>
                <a href="{{ route('kontak') }}" class="rounded-lg border border-white/30 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white/10">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>

    @php
        $klien = ['xl.svg', 'mandiri.webp', 'bca.webp', 'bonet.png', 'idn-network.png', 'indosat.svg', 'telkomsel.png', 'astra.png'];
    @endphp

    <section class="relative z-10 mx-auto -mt-12 max-w-6xl px-4">
        <div class="rounded-2xl bg-white px-4 py-8 shadow-lg sm:px-8">
            <div class="text-center">
                <span class="text-sm font-semibold uppercase tracking-wide text-indigo-600">Klien Kami</span>
            </div>

            <div class="marquee mt-4" aria-label="Logo klien PT Solusi Koneksi">
                <div class="marquee-track">
                    @foreach ($klien as $logo)
                        <div class="mx-6 flex h-16 w-36 flex-none items-center justify-center">
                            <img src="{{ asset('images/klien/'.$logo) }}" alt="Logo klien PT Solusi Koneksi"
                                 class="max-h-12 w-auto opacity-60 grayscale transition duration-300 hover:opacity-100 hover:grayscale-0" loading="lazy">
                        </div>
                    @endforeach
                    @foreach ($klien as $logo)
                        <div class="mx-6 flex h-16 w-36 flex-none items-center justify-center" aria-hidden="true">
                            <img src="{{ asset('images/klien/'.$logo) }}" alt=""
                                 class="max-h-12 w-auto opacity-60 grayscale transition duration-300 hover:opacity-100 hover:grayscale-0" loading="lazy">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-4 py-20">
        <div class="grid items-center gap-12 md:grid-cols-2">
            <img src="{{ asset($profil['tentang']['gambar']) }}" alt="Tentang PT Solusi Koneksi"
                 class="h-80 w-full rounded-2xl object-cover shadow-lg">

            <div>
                <span class="text-sm font-semibold uppercase tracking-wide text-indigo-600">Tentang Kami</span>
                <h2 class="mt-3 text-3xl font-bold text-slate-900">{{ $profil['tentang']['judul'] }}</h2>
                <p class="mt-5 whitespace-pre-line leading-relaxed text-slate-600">{{ \Illuminate\Support\Str::limit($profil['tentang']['isi'], 320) }}</p>

                <a href="{{ route('profil') }}" class="mt-8 inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700">
                    Selengkapnya
                    <i class="fa-solid fa-arrow-right text-sm"></i>
                </a>
            </div>
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

@push('styles')
    <style>
        .marquee {
            overflow: hidden;
            -webkit-mask-image: linear-gradient(to right, transparent, #000 8%, #000 92%, transparent);
            mask-image: linear-gradient(to right, transparent, #000 8%, #000 92%, transparent);
        }

        .marquee-track {
            display: flex;
            width: max-content;
            animation: marquee-scroll 32s linear infinite;
        }

        .marquee:hover .marquee-track {
            animation-play-state: paused;
        }

        @keyframes marquee-scroll {
            from {
                transform: translateX(0);
            }
            to {
                transform: translateX(-50%);
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .marquee {
                overflow-x: auto;
                -webkit-mask-image: none;
                mask-image: none;
            }

            .marquee-track {
                animation: none;
                flex-wrap: wrap;
                justify-content: center;
                width: auto;
            }

            .marquee-track [aria-hidden="true"] {
                display: none;
            }
        }
    </style>
@endpush
