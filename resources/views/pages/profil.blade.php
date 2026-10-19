@extends('layouts.main')

@section('title', 'Profil Perusahaan')

@section('content')
    <x-page-header
        title="Profil Perusahaan"
        subtitle="Mengenal lebih dekat PT Solusi Koneksi, mitra teknologi informasi Anda."
        :breadcrumb="['Profil' => null]" />

    <section class="mx-auto max-w-6xl px-4 py-16">
        <div class="grid items-center gap-12 md:grid-cols-2">
            <div>
                <span class="text-sm font-semibold uppercase tracking-wide text-indigo-600">Tentang Kami</span>
                <h2 class="mt-3 text-3xl font-bold text-slate-900">{{ $profil['tentang']['judul'] }}</h2>
                <p class="mt-5 whitespace-pre-line leading-relaxed text-slate-600">{{ $profil['tentang']['isi'] }}</p>
            </div>
            <img src="{{ asset($profil['tentang']['gambar']) }}" alt="Kantor PT Solusi Koneksi"
                 class="h-80 w-full rounded-2xl object-cover shadow-lg">
        </div>
    </section>

    <section class="bg-white py-16">
        <div class="mx-auto max-w-6xl px-4">
            <div class="grid gap-8 md:grid-cols-3">
                <div class="rounded-2xl border border-slate-200 p-8">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-xl font-bold text-indigo-600">V</div>
                    <h3 class="mt-4 text-xl font-bold text-slate-900">Visi</h3>
                    <p class="mt-3 text-sm leading-relaxed text-slate-500">
                        {{ $profil['visi'] }}
                    </p>
                </div>
                <div class="rounded-2xl border border-slate-200 p-8 md:col-span-2">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-xl font-bold text-indigo-600">M</div>
                    <h3 class="mt-4 text-xl font-bold text-slate-900">Misi</h3>
                    <p class="mt-3 whitespace-pre-line text-sm leading-relaxed text-slate-500">{{ $profil['misi'] }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-4 py-16">
        <span class="text-sm font-semibold uppercase tracking-wide text-indigo-600">Nilai Perusahaan</span>
        <h2 class="mt-3 text-3xl font-bold text-slate-900">Nilai yang Kami Pegang</h2>

        <div class="mt-10 grid gap-6 md:grid-cols-3">
            @foreach ($profil['nilai'] as $nilai)
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <h3 class="text-lg font-bold text-slate-900">{{ $nilai['judul'] }}</h3>
                    <p class="mt-2 text-sm leading-relaxed text-slate-500">{{ $nilai['deskripsi'] }}</p>
                </div>
            @endforeach
        </div>
    </section>
@endsection
