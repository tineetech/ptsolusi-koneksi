@extends('layouts.main')

@section('title', 'Artikel & Informasi Terkini')
@section('meta_description', 'Berita dan wawasan terkini seputar teknologi informasi dari PT Solusi Koneksi.')

@section('content')
    <x-page-header
        title="Artikel & Informasi Terkini"
        subtitle="Berita dan wawasan seputar dunia teknologi informasi."
        :breadcrumb="['Artikel' => null]" />

    <section class="mx-auto max-w-6xl px-4 py-16">
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($artikel as $item)
                <a href="{{ route('artikel.detail', $item['slug']) }}"
                   class="group flex flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white transition hover:-translate-y-1 hover:shadow-xl">
                    <img src="{{ asset($item['gambar']) }}" alt="{{ $item['judul'] }}" class="h-48 w-full object-cover">
                    <div class="flex flex-1 flex-col p-6">
                        <div class="flex items-center gap-3 text-xs text-slate-400">
                            <span class="rounded-full bg-indigo-50 px-2.5 py-1 font-semibold text-indigo-600">{{ $item['kategori'] }}</span>
                            <span class="flex items-center gap-1"><i class="bx bx-calendar"></i> {{ $item['tanggal_formatted'] }}</span>
                        </div>
                        <h3 class="mt-3 text-lg font-bold text-slate-900 group-hover:text-indigo-600">{{ $item['judul'] }}</h3>
                        <p class="mt-2 flex-1 text-sm leading-relaxed text-slate-500">{{ $item['ringkas'] }}</p>
                        <span class="mt-4 inline-flex items-center gap-1 text-sm font-semibold text-indigo-600">
                            Baca selengkapnya <i class="bx bx-right-arrow-alt"></i>
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
@endsection
