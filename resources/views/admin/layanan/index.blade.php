@extends('layouts.admin')

@section('title', 'Layanan')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <p class="text-sm text-slate-500">Kelola daftar layanan yang tampil di halaman publik.</p>
        <a href="{{ route('admin.layanan.create') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700">
            <i class="bx bx-plus text-lg"></i> Tambah Layanan
        </a>
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Layanan</th>
                        <th class="px-6 py-4 font-semibold">Kategori</th>
                        <th class="px-6 py-4 font-semibold">Ringkasan</th>
                        <th class="px-6 py-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($layanan as $item)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ asset($item->gambar) }}" alt="{{ $item->nama }}" class="h-12 w-12 rounded-lg object-cover">
                                    <span class="font-semibold text-slate-800">{{ $item->nama }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-500">{{ $item->kategori }}</td>
                            <td class="max-w-xs px-6 py-4 text-slate-500">{{ Str::limit($item->ringkas, 70) }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.layanan.edit', $item) }}"
                                       class="flex h-9 w-9 items-center justify-center rounded-lg bg-amber-50 text-lg text-amber-600 transition hover:bg-amber-100" title="Edit">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.layanan.destroy', $item) }}"
                                          onsubmit="return confirm('Hapus layanan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="flex h-9 w-9 items-center justify-center rounded-lg bg-red-50 text-lg text-red-600 transition hover:bg-red-100" title="Hapus">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-slate-400">Belum ada layanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
