@extends('layouts.admin')

@section('title', 'Artikel')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <p class="text-sm text-slate-500">Kelola artikel dan informasi terkini.</p>
        <a href="{{ route('admin.artikel.create') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700">
            <i class="fa-solid fa-plus text-lg"></i> Tambah Artikel
        </a>
    </div>

    <div class="mb-4 rounded-2xl border border-slate-200 bg-white p-5">
        <div class="grid gap-4 md:grid-cols-3">
            <div>
                <input type="text" id="filter-judul" placeholder="Cari judul artikel..."
                       class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
            </div>
            <div>
                <select id="filter-kategori"
                        class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                    <option value="">Semua Kategori</option>
                    @foreach (['Teknologi', 'Keamanan', 'Jaringan'] as $kategori)
                        <option value="{{ $kategori }}">{{ $kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <input type="date" id="filter-tanggal"
                       class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
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
                        <th class="px-6 py-4 font-semibold">Artikel</th>
                        <th class="px-6 py-4 font-semibold">Kategori</th>
                        <th class="px-6 py-4 font-semibold">Tanggal</th>
                        <th class="px-6 py-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($artikel as $item)
                        <tr data-artikel-row data-judul="{{ $item->judul }}" data-kategori="{{ $item->kategori }}" data-tanggal="{{ $item->tanggal?->format('Y-m-d') }}" class="hover:bg-slate-50">
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
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.artikel.destroy', $item) }}"
                                          onsubmit="return confirm('Hapus artikel ini?')">
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
                            <td colspan="4" class="px-6 py-10 text-center text-slate-400">Belum ada artikel.</td>
                        </tr>
                    @endforelse
                    <tr id="filter-empty" class="hidden">
                        <td colspan="4" class="px-6 py-10 text-center text-slate-400">Tidak ada artikel yang sesuai filter.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const filterJudul = document.getElementById('filter-judul');
        const filterKategori = document.getElementById('filter-kategori');
        const filterTanggal = document.getElementById('filter-tanggal');
        const filterReset = document.getElementById('filter-reset');
        const filterInfo = document.getElementById('filter-info');
        const filterEmpty = document.getElementById('filter-empty');
        const barisArtikel = Array.from(document.querySelectorAll('[data-artikel-row]'));

        const terapkanFilter = () => {
            const judul = filterJudul.value.trim().toLowerCase();
            const kategori = filterKategori.value;
            const tanggal = filterTanggal.value;
            let jumlahTampil = 0;

            barisArtikel.forEach((baris) => {
                const cocokJudul = judul === '' || baris.dataset.judul.toLowerCase().includes(judul);
                const cocokKategori = kategori === '' || baris.dataset.kategori === kategori;
                const cocokTanggal = tanggal === '' || baris.dataset.tanggal === tanggal;
                const cocok = cocokJudul && cocokKategori && cocokTanggal;

                baris.classList.toggle('hidden', !cocok);

                if (cocok) {
                    jumlahTampil++;
                }
            });

            filterEmpty.classList.toggle('hidden', jumlahTampil > 0 || barisArtikel.length === 0);
            filterInfo.textContent = barisArtikel.length === 0
                ? ''
                : jumlahTampil + ' dari ' + barisArtikel.length + ' artikel ditampilkan';
        };

        filterJudul.addEventListener('input', terapkanFilter);
        filterKategori.addEventListener('change', terapkanFilter);
        filterTanggal.addEventListener('change', terapkanFilter);

        filterReset.addEventListener('click', () => {
            filterJudul.value = '';
            filterKategori.value = '';
            filterTanggal.value = '';
            terapkanFilter();
        });

        terapkanFilter();
    </script>
@endpush
