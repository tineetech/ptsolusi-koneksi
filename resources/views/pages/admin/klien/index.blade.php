@extends('layouts.admin')

@section('title', 'Data Klien')

@section('content')
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <p class="text-sm text-slate-500">Kelola data klien beserta layanan yang mereka gunakan.</p>
        <a href="{{ route('admin.klien.create') }}"
           class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700">
            <i class="fa-solid fa-plus text-lg"></i> Tambah Klien
        </a>
    </div>

    <div class="mb-4 rounded-2xl border border-slate-200 bg-white p-5">
        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <div>
                <input type="text" id="filter-klien" placeholder="Cari nama klien atau perusahaan..."
                       class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
            </div>
            <div>
                <select id="filter-layanan"
                        class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                    <option value="">Semua Layanan</option>
                    @foreach ($layanan as $layananItem)
                        <option value="{{ $layananItem->id }}">{{ $layananItem->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <select id="filter-perusahaan"
                        class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                    <option value="">Semua Perusahaan</option>
                    @foreach ($perusahaan as $namaPerusahaan)
                        <option value="{{ $namaPerusahaan }}">{{ $namaPerusahaan }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <select id="filter-status"
                        class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                    <option value="">Semua Status</option>
                    @foreach (['proses' => 'Proses', 'konsultasi' => 'Konsultasi', 'terjual' => 'Terjual'] as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
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
                        <th class="px-6 py-4 font-semibold">No</th>
                        <th class="px-6 py-4 font-semibold">Klien</th>
                        <th class="px-6 py-4 font-semibold">Layanan</th>
                        <th class="px-6 py-4 font-semibold">Kontak</th>
                        <th class="px-6 py-4 font-semibold">Alamat &amp; Catatan</th>
                        <th class="px-6 py-4 font-semibold">Status</th>
                        <th class="px-6 py-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($klien as $item)
                        @php
                            $statusClass = match ($item->status) {
                                'terjual' => 'bg-emerald-50 text-emerald-600',
                                'proses' => 'bg-amber-50 text-amber-600',
                                default => 'bg-indigo-50 text-indigo-600',
                            };
                        @endphp
                        <tr data-klien-row data-nama="{{ $item->nama_client }}" data-perusahaan="{{ $item->nama_perusahaan }}" data-layanan="{{ $item->layanan_id }}" data-status="{{ $item->status }}" class="hover:bg-slate-50">
                            <td class="px-6 py-4 text-slate-500">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">
                                <div class="font-semibold text-slate-800">{{ $item->nama_client }}</div>
                                <div class="text-xs text-slate-500">{{ $item->nama_perusahaan }}</div>
                            </td>
                            <td class="px-6 py-4 text-slate-500">{{ $item->layanan->nama ?? '-' }}</td>
                            <td class="px-6 py-4 text-slate-500">
                                <div>{{ $item->email }}</div>
                                <div class="text-xs text-slate-400">{{ $item->no_telephone }}</div>
                            </td>
                            <td class="max-w-xs px-6 py-4 text-slate-500">
                                {{ Str::limit($item->alamat_perusahaan, 60) }}
                                @if ($item->notes)
                                    <div class="mt-1 text-xs italic text-slate-400">{{ Str::limit($item->notes, 50) }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold capitalize {{ $statusClass }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.klien.edit', $item) }}"
                                       class="flex h-9 w-9 items-center justify-center rounded-lg bg-amber-50 text-lg text-amber-600 transition hover:bg-amber-100" title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.klien.destroy', $item) }}"
                                          onsubmit="return confirm('Hapus data klien ini?')">
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
                            <td colspan="7" class="px-6 py-10 text-center text-slate-400">Belum ada data klien.</td>
                        </tr>
                    @endforelse
                    <tr id="filter-empty" class="hidden">
                        <td colspan="7" class="px-6 py-10 text-center text-slate-400">Tidak ada klien yang sesuai filter.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const filterKlien = document.getElementById('filter-klien');
        const filterLayanan = document.getElementById('filter-layanan');
        const filterPerusahaan = document.getElementById('filter-perusahaan');
        const filterStatus = document.getElementById('filter-status');
        const filterReset = document.getElementById('filter-reset');
        const filterInfo = document.getElementById('filter-info');
        const filterEmpty = document.getElementById('filter-empty');
        const barisKlien = Array.from(document.querySelectorAll('[data-klien-row]'));

        const terapkanFilter = () => {
            const kataKunci = filterKlien.value.trim().toLowerCase();
            const layanan = filterLayanan.value;
            const perusahaan = filterPerusahaan.value;
            const status = filterStatus.value;
            let jumlahTampil = 0;

            barisKlien.forEach((baris) => {
                const cocokKataKunci = kataKunci === ''
                    || baris.dataset.nama.toLowerCase().includes(kataKunci)
                    || baris.dataset.perusahaan.toLowerCase().includes(kataKunci);
                const cocokLayanan = layanan === '' || baris.dataset.layanan === layanan;
                const cocokPerusahaan = perusahaan === '' || baris.dataset.perusahaan === perusahaan;
                const cocokStatus = status === '' || baris.dataset.status === status;
                const cocok = cocokKataKunci && cocokLayanan && cocokPerusahaan && cocokStatus;

                baris.classList.toggle('hidden', !cocok);

                if (cocok) {
                    jumlahTampil++;
                }
            });

            filterEmpty.classList.toggle('hidden', jumlahTampil > 0 || barisKlien.length === 0);
            filterInfo.textContent = barisKlien.length === 0
                ? ''
                : jumlahTampil + ' dari ' + barisKlien.length + ' klien ditampilkan';
        };

        filterKlien.addEventListener('input', terapkanFilter);
        filterLayanan.addEventListener('change', terapkanFilter);
        filterPerusahaan.addEventListener('change', terapkanFilter);
        filterStatus.addEventListener('change', terapkanFilter);

        filterReset.addEventListener('click', () => {
            filterKlien.value = '';
            filterLayanan.value = '';
            filterPerusahaan.value = '';
            filterStatus.value = '';
            terapkanFilter();
        });

        terapkanFilter();
    </script>
@endpush
