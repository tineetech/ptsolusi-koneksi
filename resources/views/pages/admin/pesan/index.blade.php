@extends('layouts.admin')

@section('title', 'Pesan Masuk')

@section('content')
    <div class="mb-6">
        <p class="text-sm text-slate-500">Daftar pesan yang dikirim pengunjung melalui form kontak.</p>
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                    <tr>
                        <th class="px-6 py-4 font-semibold">No</th>
                        <th class="px-6 py-4 font-semibold">Nama</th>
                        <th class="px-6 py-4 font-semibold">Email</th>
                        <th class="px-6 py-4 font-semibold">Subjek</th>
                        <th class="px-6 py-4 font-semibold">Pesan</th>
                        <th class="px-6 py-4 font-semibold">Tanggal</th>
                        <th class="px-6 py-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($pesan as $item)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 text-slate-500">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 font-semibold text-slate-800">{{ $item->nama }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $item->email }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $item->subjek }}</td>
                            <td class="max-w-md px-6 py-4 text-slate-500">{{ Str::limit($item->pesan, 80) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-slate-500">{{ $item->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.pesan.show', $item) }}"
                                       class="flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-50 text-lg text-indigo-600 transition hover:bg-indigo-100" title="Lihat">
                                        <i class="fa-regular fa-eye"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.pesan.destroy', $item) }}"
                                          onsubmit="return confirm('Hapus pesan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="flex h-9 w-9 items-center justify-center rounded-lg bg-red-50 text-lg text-red-600 transition hover:bg-red-100" title="Hapus">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-slate-400">Belum ada pesan masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
