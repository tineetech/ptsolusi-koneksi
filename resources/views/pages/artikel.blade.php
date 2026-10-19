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
                            <span class="flex items-center gap-1"><i class="fa-regular fa-calendar"></i> {{ $item['tanggal_formatted'] }}</span>
                        </div>
                        <h3 class="mt-3 text-lg font-bold text-slate-900 group-hover:text-indigo-600">{{ $item['judul'] }}</h3>
                        <p class="mt-2 flex-1 text-sm leading-relaxed text-slate-500">{{ $item['ringkas'] }}</p>
                        <span class="mt-4 inline-flex items-center gap-1 text-sm font-semibold text-indigo-600">
                            Baca selengkapnya <i class="fa-solid fa-arrow-right"></i>
                        </span>
                    </div>
                </a>
            @endforeach
        </div>

        @if ($artikel->hasPages())
            <nav class="mt-12 flex flex-col items-center gap-4 sm:flex-row sm:justify-between"
                 aria-label="Navigasi halaman artikel">
                <p class="text-sm text-slate-500">
                    Menampilkan
                    <span class="font-semibold text-slate-700">{{ $artikel->firstItem() }}</span>&ndash;<span class="font-semibold text-slate-700">{{ $artikel->lastItem() }}</span>
                    dari <span class="font-semibold text-slate-700">{{ $artikel->total() }}</span> artikel
                </p>

                <div class="flex flex-wrap items-center justify-center gap-2">
                    @if ($artikel->onFirstPage())
                        <span aria-disabled="true"
                              class="flex h-10 cursor-not-allowed items-center gap-1.5 rounded-lg border border-slate-200 px-3 text-sm font-medium text-slate-300">
                            <i class="fa-solid fa-chevron-left text-xs"></i>
                            <span class="hidden sm:inline">Sebelumnya</span>
                        </span>
                    @else
                        <a href="{{ $artikel->previousPageUrl() }}" rel="prev"
                           class="flex h-10 items-center gap-1.5 rounded-lg border border-slate-200 px-3 text-sm font-medium text-slate-600 transition hover:border-indigo-300 hover:bg-indigo-50 hover:text-indigo-600">
                            <i class="fa-solid fa-chevron-left text-xs"></i>
                            <span class="hidden sm:inline">Sebelumnya</span>
                        </a>
                    @endif

                    @php
                        $current = $artikel->currentPage();
                        $last = $artikel->lastPage();
                        $start = max(1, $current - 1);
                        $end = min($last, $current + 1);
                    @endphp

                    @if ($start > 1)
                        <a href="{{ $artikel->url(1) }}"
                           class="flex h-10 w-10 items-center justify-center rounded-lg border border-slate-200 text-sm font-medium text-slate-600 transition hover:border-indigo-300 hover:bg-indigo-50 hover:text-indigo-600">1</a>
                        @if ($start > 2)
                            <span class="flex h-10 w-8 items-center justify-center text-sm text-slate-400">&hellip;</span>
                        @endif
                    @endif

                    @foreach ($artikel->getUrlRange($start, $end) as $page => $url)
                        @if ($page == $current)
                            <span aria-current="page"
                                  class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600 text-sm font-semibold text-white">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}"
                               class="flex h-10 w-10 items-center justify-center rounded-lg border border-slate-200 text-sm font-medium text-slate-600 transition hover:border-indigo-300 hover:bg-indigo-50 hover:text-indigo-600">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if ($end < $last)
                        @if ($end < $last - 1)
                            <span class="flex h-10 w-8 items-center justify-center text-sm text-slate-400">&hellip;</span>
                        @endif
                        <a href="{{ $artikel->url($last) }}"
                           class="flex h-10 w-10 items-center justify-center rounded-lg border border-slate-200 text-sm font-medium text-slate-600 transition hover:border-indigo-300 hover:bg-indigo-50 hover:text-indigo-600">{{ $last }}</a>
                    @endif

                    @if ($artikel->hasMorePages())
                        <a href="{{ $artikel->nextPageUrl() }}" rel="next"
                           class="flex h-10 items-center gap-1.5 rounded-lg border border-slate-200 px-3 text-sm font-medium text-slate-600 transition hover:border-indigo-300 hover:bg-indigo-50 hover:text-indigo-600">
                            <span class="hidden sm:inline">Berikutnya</span>
                            <i class="fa-solid fa-chevron-right text-xs"></i>
                        </a>
                    @else
                        <span aria-disabled="true"
                              class="flex h-10 cursor-not-allowed items-center gap-1.5 rounded-lg border border-slate-200 px-3 text-sm font-medium text-slate-300">
                            <span class="hidden sm:inline">Berikutnya</span>
                            <i class="fa-solid fa-chevron-right text-xs"></i>
                        </span>
                    @endif
                </div>
            </nav>
        @endif
    </section>
@endsection
