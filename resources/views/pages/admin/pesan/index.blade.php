@extends('layouts.admin')

@section('title', 'Pesan Masuk')

@section('content')
    <div class="mb-6">
        <p class="text-sm text-slate-500">Daftar pesan yang dikirim pengunjung melalui form kontak.</p>
    </div>

    <div class="mb-4 rounded-2xl border border-slate-200 bg-white p-5">
        <div class="grid gap-4 md:grid-cols-3">
            <div>
                <label for="filter-pesan" class="block text-sm font-medium text-slate-700">Cari Nama / Email</label>
                <input type="text" id="filter-pesan" placeholder="Cari nama atau email pengirim..."
                       class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
            </div>
            <div>
                <label for="filter-tanggal" class="block text-sm font-medium text-slate-700">Tanggal</label>
                <input type="date" id="filter-tanggal"
                       class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
            </div>
            <div>
                <label for="filter-status" class="block text-sm font-medium text-slate-700">Status</label>
                <select id="filter-status"
                        class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                    <option value="">Semua Status</option>
                    <option value="pending">Pending</option>
                    <option value="replied">Dibalas</option>
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
                        <th class="px-6 py-4 font-semibold">Nama</th>
                        <th class="px-6 py-4 font-semibold">Email</th>
                        <th class="px-6 py-4 font-semibold">Subjek</th>
                        <th class="px-6 py-4 font-semibold">Tanggal</th>
                        <th class="px-6 py-4 font-semibold">Status</th>
                        <th class="px-6 py-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($pesan as $item)
                        <tr data-pesan-row data-nama="{{ $item->nama }}" data-email="{{ $item->email }}" data-tanggal="{{ $item->created_at?->format('Y-m-d') }}" data-status="{{ $item->status }}" class="hover:bg-slate-50">
                            <td class="px-6 py-4 text-slate-500">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 font-semibold text-slate-800">{{ $item->nama }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $item->email }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $item->subjek }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-slate-500">{{ $item->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $item->status === 'replied' ? 'bg-emerald-50 text-emerald-600' : 'bg-amber-50 text-amber-600' }}">
                                    {{ $item->status === 'replied' ? 'Dibalas' : 'Pending' }}
                                </span>
                            </td>
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
                            <td colspan="8" class="px-6 py-10 text-center text-slate-400">Belum ada pesan masuk.</td>
                        </tr>
                    @endforelse
                    <tr id="filter-empty" class="hidden">
                        <td colspan="8" class="px-6 py-10 text-center text-slate-400">Tidak ada pesan yang sesuai filter.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const filterPesan = document.getElementById('filter-pesan');
        const filterTanggal = document.getElementById('filter-tanggal');
        const filterStatus = document.getElementById('filter-status');
        const filterReset = document.getElementById('filter-reset');
        const filterInfo = document.getElementById('filter-info');
        const filterEmpty = document.getElementById('filter-empty');
        const barisPesan = Array.from(document.querySelectorAll('[data-pesan-row]'));

        const terapkanFilter = () => {
            const kataKunci = filterPesan.value.trim().toLowerCase();
            const tanggal = filterTanggal.value;
            const status = filterStatus.value;
            let jumlahTampil = 0;

            barisPesan.forEach((baris) => {
                const cocokKataKunci = kataKunci === ''
                    || baris.dataset.nama.toLowerCase().includes(kataKunci)
                    || baris.dataset.email.toLowerCase().includes(kataKunci);
                const cocokTanggal = tanggal === '' || baris.dataset.tanggal === tanggal;
                const cocokStatus = status === '' || baris.dataset.status === status;
                const cocok = cocokKataKunci && cocokTanggal && cocokStatus;

                baris.classList.toggle('hidden', !cocok);

                if (cocok) {
                    jumlahTampil++;
                }
            });

            filterEmpty.classList.toggle('hidden', jumlahTampil > 0 || barisPesan.length === 0);
            filterInfo.textContent = barisPesan.length === 0
                ? ''
                : jumlahTampil + ' dari ' + barisPesan.length + ' pesan ditampilkan';
        };

        filterPesan.addEventListener('input', terapkanFilter);
        filterTanggal.addEventListener('change', terapkanFilter);
        filterStatus.addEventListener('change', terapkanFilter);

        filterReset.addEventListener('click', () => {
            filterPesan.value = '';
            filterTanggal.value = '';
            filterStatus.value = '';
            terapkanFilter();
        });

        terapkanFilter();
    </script>
@endpush
