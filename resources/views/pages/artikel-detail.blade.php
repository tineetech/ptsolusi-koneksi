@extends('layouts.main')

@section('title', $artikel['judul'])
@section('meta_description', $artikel['ringkas'])

@section('content')
    <x-page-header
        :title="$artikel['judul']"
        :breadcrumb="['Artikel' => route('artikel'), 'Detail' => null]" />

    <section class="mx-auto max-w-6xl px-4 py-16">
        <div class="grid gap-12 lg:grid-cols-3">
            <article class="lg:col-span-2">
                <div class="flex flex-wrap items-center gap-4 text-sm text-slate-500">
                    <span class="rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-600">{{ $artikel['kategori'] }}</span>
                    <span class="flex items-center gap-1"><i class="bx bx-calendar"></i> {{ $artikel['tanggal_formatted'] }}</span>
                    <span class="flex items-center gap-1"><i class="bx bx-user"></i> {{ $artikel['penulis'] }}</span>
                </div>

                <img src="{{ asset($artikel['gambar']) }}" alt="{{ $artikel['judul'] }}"
                     class="mt-6 h-80 w-full rounded-2xl object-cover shadow-lg">

                <div class="mt-8 space-y-4 leading-relaxed text-slate-600">
                    <p class="text-lg font-medium text-slate-800">{{ $artikel['ringkas'] }}</p>
                    <p>{{ $artikel['isi'] }}</p>
                </div>

                <div class="mt-10 flex items-center gap-4 border-t border-slate-200 pt-6">
                    <span class="text-sm font-semibold text-slate-500">Bagikan:</span>
                    <div class="flex gap-2">
                        <a href="#" class="flex h-9 w-9 items-center justify-center rounded-full bg-slate-100 text-lg text-slate-600 transition hover:bg-indigo-600 hover:text-white"><i class="bx bxl-facebook"></i></a>
                        <a href="#" class="flex h-9 w-9 items-center justify-center rounded-full bg-slate-100 text-lg text-slate-600 transition hover:bg-indigo-600 hover:text-white"><i class="bx bxl-twitter"></i></a>
                        <a href="#" class="flex h-9 w-9 items-center justify-center rounded-full bg-slate-100 text-lg text-slate-600 transition hover:bg-indigo-600 hover:text-white"><i class="bx bxl-whatsapp"></i></a>
                    </div>
                </div>

                <a href="{{ route('artikel') }}" class="mt-8 inline-flex items-center gap-2 text-sm font-semibold text-indigo-600 hover:text-indigo-700">
                    <i class="bx bx-left-arrow-alt"></i> Kembali ke daftar artikel
                </a>
            </article>

            <aside>
                <div class="rounded-2xl border border-slate-200 bg-white p-6">
                    <h3 class="text-sm font-semibold uppercase tracking-wide text-slate-400">Artikel Lainnya</h3>
                    <ul class="mt-4 space-y-5">
                        @foreach ($lainnya as $item)
                            <li>
                                <a href="{{ route('artikel.detail', $item['slug']) }}" class="group flex gap-3">
                                    <img src="{{ asset($item['gambar']) }}" alt="{{ $item['judul'] }}" class="h-16 w-16 rounded-lg object-cover">
                                    <div>
                                        <h4 class="text-sm font-semibold leading-snug text-slate-700 group-hover:text-indigo-600">{{ $item['judul'] }}</h4>
                                        <span class="mt-1 block text-xs text-slate-400">{{ $item['tanggal_formatted'] }}</span>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>
        </div>
    </section>
@endsection
