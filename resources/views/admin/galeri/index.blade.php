@extends('layouts.admin')

@section('title', 'Galeri')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <p class="text-sm text-slate-500">Kelola foto dan dokumentasi kegiatan.</p>
        <a href="{{ route('admin.galeri.create') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700">
            <i class="fa-solid fa-plus text-lg"></i> Tambah Galeri
        </a>
    </div>

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($galeri as $item)
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white">
                <img src="{{ asset($item->gambar) }}" alt="{{ $item->judul }}" class="h-44 w-full object-cover">
                <div class="p-5">
                    <h3 class="font-semibold text-slate-800">{{ $item->judul }}</h3>
                    <p class="mt-1 text-xs text-slate-400">{{ $item->tanggal_formatted }}</p>
                    <div class="mt-4 flex items-center gap-2">
                        <a href="{{ route('admin.galeri.edit', $item) }}"
                           class="inline-flex items-center gap-1.5 rounded-lg bg-amber-50 px-3 py-2 text-xs font-semibold text-amber-600 transition hover:bg-amber-100">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </a>
                        <form method="POST" action="{{ route('admin.galeri.destroy', $item) }}"
                              onsubmit="return confirm('Hapus item galeri ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center gap-1.5 rounded-lg bg-red-50 px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-100">
                                <i class="fa-solid fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="col-span-full rounded-2xl border border-slate-200 bg-white px-6 py-10 text-center text-slate-400">
                Belum ada item galeri.
            </p>
        @endforelse
    </div>
@endsection
