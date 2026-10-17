@extends('layouts.main')

@section('title', 'Produk & Layanan')
@section('meta_description', 'Berbagai produk dan layanan jaringan, internet, keamanan, dan infrastruktur dari PT Solusi Koneksi.')

@section('content')
    <x-page-header
        title="Produk & Layanan"
        subtitle="Solusi lengkap untuk kebutuhan jaringan dan teknologi informasi perusahaan Anda."
        :breadcrumb="['Produk' => null]" />

    <section class="mx-auto max-w-6xl px-4 py-16">
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($produk as $item)
                <a href="{{ route('produk.detail', $item['slug']) }}"
                   class="group flex flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="relative">
                        <img src="{{ asset($item['gambar']) }}" alt="{{ $item['nama'] }}" class="h-48 w-full object-cover">
                        <span class="absolute left-4 top-4 rounded-full bg-white/90 px-3 py-1 text-xs font-semibold text-indigo-600">
                            {{ $item['kategori'] }}
                        </span>
                    </div>
                    <div class="flex flex-1 flex-col p-6">
                        <h3 class="text-lg font-bold text-slate-900 group-hover:text-indigo-600">{{ $item['nama'] }}</h3>
                        <p class="mt-2 flex-1 text-sm leading-relaxed text-slate-500">{{ $item['ringkas'] }}</p>
                        <span class="mt-4 inline-flex items-center gap-1 text-sm font-semibold text-indigo-600">
                            Selengkapnya <i class="bx bx-right-arrow-alt"></i>
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
@endsection
