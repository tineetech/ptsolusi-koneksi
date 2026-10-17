@extends('layouts.main')

@section('title', 'Galeri Kegiatan')
@section('meta_description', 'Dokumentasi berbagai kegiatan dan proyek PT Solusi Koneksi.')

@section('content')
    <x-page-header
        title="Galeri Kegiatan"
        subtitle="Dokumentasi berbagai kegiatan, pelatihan, dan proyek yang telah kami laksanakan."
        :breadcrumb="['Galeri' => null]" />

    <section class="mx-auto max-w-6xl px-4 py-16">
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($galeri as $item)
                <figure class="group relative overflow-hidden rounded-2xl shadow-sm">
                    <img src="{{ asset($item['gambar']) }}" alt="{{ $item['judul'] }}"
                         class="h-64 w-full object-cover transition duration-300 group-hover:scale-105">
                    <div class="absolute inset-0 flex flex-col justify-end bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent p-6">
                        <span class="flex items-center gap-1 text-xs text-slate-200">
                            <i class="bx bx-calendar"></i> {{ $item['tanggal_formatted'] }}
                        </span>
                        <figcaption class="mt-1 text-lg font-semibold text-white">{{ $item['judul'] }}</figcaption>
                    </div>
                </figure>
            @endforeach
        </div>
    </section>
@endsection
