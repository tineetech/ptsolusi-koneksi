@extends('layouts.admin')

@section('title', 'Layanan')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <p class="text-sm text-slate-500">Kelola daftar layanan yang tampil di halaman publik.</p>
        <a href="{{ route('admin.layanan.create') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700">
            <i class="fa-solid fa-plus text-lg"></i> Tambah Layanan
        </a>
    </div>

    <div class="mb-4 rounded-2xl border border-slate-200 bg-white p-5">
        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <input type="text" id="filter-nama" placeholder="Cari nama layanan..."
                       class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
            </div>
            <div>
                <select id="filter-kategori"
                        class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                    <option value="">Semua Kategori</option>
                    @foreach (['Jaringan', 'Internet', 'Keamanan', 'Infrastruktur'] as $kategori)
                        <option value="{{ $kategori }}">{{ $kategori }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mt-3 flex flex-wrap items-center justify-between gap-2">
            <p id="filter-info" class="text-xs text-slate-400"></p>
            <button type="button" id="filter-reset"
                    class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-50">
                <i class="fa-solid fa-rotate-left"></i> Reset Filter
            </button>
        </div>
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
                        <tr data-layanan-row data-nama="{{ $item->nama }}" data-kategori="{{ $item->kategori }}" data-tanggal="{{ $item->created_at?->format('Y-m-d') }}" class="hover:bg-slate-50">
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
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.layanan.destroy', $item) }}"
                                          onsubmit="return confirm('Hapus layanan ini?')">
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
                            <td colspan="4" class="px-6 py-10 text-center text-slate-400">Belum ada layanan.</td>
                        </tr>
                    @endforelse
                    <tr id="filter-empty" class="hidden">
                        <td colspan="4" class="px-6 py-10 text-center text-slate-400">Tidak ada layanan yang sesuai filter.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const filterNama = document.getElementById('filter-nama');
        const filterKategori = document.getElementById('filter-kategori');
        const filterReset = document.getElementById('filter-reset');
        const filterInfo = document.getElementById('filter-info');
        const filterEmpty = document.getElementById('filter-empty');
        const barisLayanan = Array.from(document.querySelectorAll('[data-layanan-row]'));

        const terapkanFilter = () => {
            const nama = filterNama.value.trim().toLowerCase();
            const kategori = filterKategori.value;
            let jumlahTampil = 0;

            barisLayanan.forEach((baris) => {
                const cocokNama = nama === '' || baris.dataset.nama.toLowerCase().includes(nama);
                const cocokKategori = kategori === '' || baris.dataset.kategori === kategori;
                const cocok = cocokNama && cocokKategori;

                baris.classList.toggle('hidden', !cocok);

                if (cocok) {
                    jumlahTampil++;
                }
            });

            filterEmpty.classList.toggle('hidden', jumlahTampil > 0 || barisLayanan.length === 0);
            filterInfo.textContent = barisLayanan.length === 0
                ? ''
                : jumlahTampil + ' dari ' + barisLayanan.length + ' layanan ditampilkan';
        };

        filterNama.addEventListener('input', terapkanFilter);
        filterKategori.addEventListener('change', terapkanFilter);

        filterReset.addEventListener('click', () => {
            filterNama.value = '';
            filterKategori.value = '';
            terapkanFilter();
        });

        terapkanFilter();
    </script>
@endpush
