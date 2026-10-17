@extends('layouts.admin')

@section('title', 'Artikel')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <p class="text-sm text-slate-500">Kelola artikel dan informasi terkini.</p>
        <a href="{{ route('admin.artikel.create') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700">
            <i class="bx bx-plus text-lg"></i> Tambah Artikel
        </a>
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Artikel</th>
                        <th class="px-6 py-4 font-semibold">Kategori</th>
                        <th class="px-6 py-4 font-semibold">Tanggal</th>
                        <th class="px-6 py-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($artikel as $item)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ asset($item->gambar) }}" alt="{{ $item->judul }}" class="h-12 w-12 rounded-lg object-cover">
                                    <span class="max-w-xs font-semibold text-slate-800">{{ Str::limit($item->judul, 50) }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-500">{{ $item->kategori }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $item->tanggal_formatted }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.artikel.edit', $item) }}"
                                       class="flex h-9 w-9 items-center justify-center rounded-lg bg-amber-50 text-lg text-amber-600 transition hover:bg-amber-100" title="Edit">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.artikel.destroy', $item) }}"
                                          onsubmit="return confirm('Hapus artikel ini?')">
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
                            <td colspan="4" class="px-6 py-10 text-center text-slate-400">Belum ada artikel.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
