@extends('layouts.admin')

@section('title', 'Detail Pesan')

@section('content')
    <div class="mx-auto max-w-3xl">
        <div class="mb-6 flex items-center justify-between gap-4">
            <div>
                <h2 class="text-lg font-bold text-slate-900">Detail Pesan</h2>
                <p class="text-sm text-slate-500">Dikirim pada {{ $pesan->created_at->format('d/m/Y H:i') }}</p>
            </div>
            <a href="{{ route('admin.pesan.index') }}"
               class="inline-flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-8">
            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="nama" class="block text-sm font-medium text-slate-700">Nama</label>
                    <input type="text" id="nama" value="{{ $pesan->nama }}" disabled
                           class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm disabled:cursor-not-allowed disabled:bg-slate-100 disabled:text-slate-500">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                    <input type="email" id="email" value="{{ $pesan->email }}" disabled
                           class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm disabled:cursor-not-allowed disabled:bg-slate-100 disabled:text-slate-500">
                </div>
            </div>

            <div class="mt-5">
                <label for="subjek" class="block text-sm font-medium text-slate-700">Subjek</label>
                <input type="text" id="subjek" value="{{ $pesan->subjek }}" disabled
                       class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm disabled:cursor-not-allowed disabled:bg-slate-100 disabled:text-slate-500">
            </div>

            <div class="mt-5">
                <label for="pesan" class="block text-sm font-medium text-slate-700">Pesan</label>
                <textarea id="pesan" rows="6" disabled
                          class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm disabled:cursor-not-allowed disabled:bg-slate-100 disabled:text-slate-500">{{ $pesan->pesan }}</textarea>
            </div>
        </div>
    </div>
@endsection
