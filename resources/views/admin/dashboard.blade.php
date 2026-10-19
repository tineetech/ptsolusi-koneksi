@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Welcome Banner -->
    <div class="flex flex-col gap-4 rounded-2xl bg-gradient-to-r from-indigo-600 to-indigo-500 px-6 py-8 text-white sm:flex-row sm:items-center sm:justify-between sm:px-8">
        <div>
            <h2 class="text-2xl font-bold">Selamat datang, {{ auth()->user()->name }}!</h2>
            <p class="mt-1 text-sm text-indigo-100">Kelola konten, layanan, dan informasi website PT Solusi Koneksi dari panel ini.</p>
        </div>
        <div class="flex flex-wrap items-center gap-2.5">
            <a href="{{ route('admin.layanan.create') }}"
               class="inline-flex items-center gap-1.5 rounded-lg bg-white px-3.5 py-2 text-xs font-semibold text-indigo-600 shadow-sm transition hover:bg-indigo-50">
                <i class="fa-solid fa-plus text-base"></i> Tambah Layanan
            </a>
            <a href="{{ route('admin.artikel.create') }}"
               class="inline-flex items-center gap-1.5 rounded-lg bg-indigo-700 px-3.5 py-2 text-xs font-semibold text-white transition hover:bg-indigo-800">
                <i class="fa-regular fa-newspaper text-base"></i> Tulis Artikel
            </a>
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="grid gap-6 sm:grid-cols-3">
        @foreach ([
            ['label' => 'Total Layanan', 'jumlah' => $jumlahLayanan, 'route' => 'admin.layanan.index', 'icon' => 'fa-solid fa-box', 'desc' => 'Produk aktif'],
            ['label' => 'Total Artikel', 'jumlah' => $jumlahArtikel, 'route' => 'admin.artikel.index', 'icon' => 'fa-regular fa-newspaper', 'desc' => 'Publikasi berita'],
            ['label' => 'Total Galeri', 'jumlah' => $jumlahGaleri, 'route' => 'admin.galeri.index', 'icon' => 'fa-regular fa-image', 'desc' => 'Dokumentasi kegiatan'],
        ] as $stat)
            <a href="{{ route($stat['route']) }}"
               class="flex items-center justify-between rounded-2xl border border-slate-200 bg-white p-6 transition hover:shadow-md">
                <div>
                    <div class="text-sm font-medium text-slate-500">{{ $stat['label'] }}</div>
                    <div class="mt-1 text-3xl font-bold text-slate-900">{{ $stat['jumlah'] }}</div>
                    <div class="mt-1 text-xs text-slate-400">{{ $stat['desc'] }}</div>
                </div>
                <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-2xl text-indigo-600">
                    <i class="{{ $stat['icon'] }}"></i>
                </span>
            </a>
        @endforeach
    </div>

    <!-- Table Layanan -->
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white">
        <div class="flex flex-col gap-2 border-b border-slate-100 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h3 class="font-bold text-slate-900">Daftar Layanan Terbaru</h3>
                <p class="text-xs text-slate-500">Ringkasan paket dan solusi teknologi yang tampil di website publik.</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.layanan.create') }}"
                   class="inline-flex items-center gap-1 rounded-lg bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-600 transition hover:bg-indigo-100">
                    <i class="fa-solid fa-plus"></i> Tambah Baru
                </a>
                <a href="{{ route('admin.layanan.index') }}"
                   class="inline-flex items-center gap-1 text-xs font-medium text-slate-500 transition hover:text-slate-800">
                    Lihat Semua <i class="fa-solid fa-chevron-right"></i>
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                    <tr>
                        <th class="px-6 py-3.5 font-semibold">Layanan</th>
                        <th class="px-6 py-3.5 font-semibold">Kategori</th>
                        <th class="px-6 py-3.5 font-semibold">Ringkasan</th>
                        <th class="px-6 py-3.5 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($daftarLayanan as $item)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ asset($item->gambar) }}"
                                         alt="{{ $item->nama }}"
                                         class="h-10 w-10 shrink-0 rounded-lg object-cover"
                                         onerror="this.src='https://images.unsplash.com/photo-1544197150-b99a580bb7a8?w=100&q=80'">
                                    <span class="font-semibold text-slate-800">{{ $item->nama }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="rounded bg-slate-100 px-2 py-0.5 text-xs font-medium text-slate-600">
                                    {{ $item->kategori }}
                                </span>
                            </td>
                            <td class="max-w-xs px-6 py-4 text-xs text-slate-500">
                                {{ Str::limit($item->ringkas, 65) }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('produk.detail', $item->slug) }}"
                                       target="_blank"
                                       class="flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 text-slate-500 transition hover:bg-slate-100"
                                       title="Lihat Halaman Publik">
                                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                    </a>
                                    <a href="{{ route('admin.layanan.edit', $item) }}"
                                       class="flex h-8 w-8 items-center justify-center rounded-lg bg-amber-50 text-amber-600 transition hover:bg-amber-100"
                                       title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form method="POST"
                                          action="{{ route('admin.layanan.destroy', $item) }}"
                                          onsubmit="return confirm('Hapus layanan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="flex h-8 w-8 items-center justify-center rounded-lg bg-red-50 text-red-600 transition hover:bg-red-100"
                                                title="Hapus">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-slate-400">
                                Belum ada data layanan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Supporting Grid: Artikel Terbaru & Aksi Cepat -->
    <div class="grid gap-6 lg:grid-cols-2">
        <!-- Artikel Terbaru -->
        <div class="rounded-2xl border border-slate-200 bg-white p-6">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <div class="flex items-center gap-2">
                    <i class="fa-regular fa-newspaper text-lg text-indigo-600"></i>
                    <h3 class="font-bold text-slate-900">Artikel Terbaru</h3>
                </div>
                <a href="{{ route('admin.artikel.index') }}" class="text-xs font-medium text-slate-500 hover:text-indigo-600">
                    Lihat Semua <i class="fa-solid fa-chevron-right"></i>
                </a>
            </div>

            <div class="mt-4 divide-y divide-slate-100">
                @forelse ($artikelTerbaru as $art)
                    <div class="flex items-center justify-between py-3 first:pt-0 last:pb-0">
                        <div class="flex items-center gap-3 min-w-0 pr-4">
                            <img src="{{ asset($art->gambar) }}"
                                 alt="{{ $art->judul }}"
                                 class="h-9 w-9 shrink-0 rounded-lg object-cover"
                                 onerror="this.src='https://images.unsplash.com/photo-1518770660439-4636190af475?w=100&q=80'">
                            <div class="min-w-0">
                                <a href="{{ route('admin.artikel.edit', $art) }}" class="block truncate text-sm font-semibold text-slate-800 hover:text-indigo-600">
                                    {{ $art->judul }}
                                </a>
                                <div class="mt-0.5 flex items-center gap-2 text-xs text-slate-400">
                                    <span>{{ $art->kategori }}</span>
                                    <span>&middot;</span>
                                    <span>{{ $art->tanggal_formatted }}</span>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('admin.artikel.edit', $art) }}" class="shrink-0 text-slate-400 hover:text-indigo-600">
                            <i class="fa-solid fa-pen-to-square text-base"></i>
                        </a>
                    </div>
                @empty
                    <p class="py-4 text-center text-xs text-slate-400">Belum ada artikel.</p>
                @endforelse
            </div>
        </div>

        <!-- Aksi Cepat & Pintasan Navigasi -->
        <div class="rounded-2xl border border-slate-200 bg-white p-6">
            <div class="flex items-center gap-2 border-b border-slate-100 pb-3">
                <i class="fa-solid fa-bolt text-lg text-indigo-600"></i>
                <h3 class="font-bold text-slate-900">Pintasan Cepat</h3>
            </div>

            <div class="mt-4 grid grid-cols-1 gap-2.5 sm:grid-cols-2">
                <a href="{{ route('admin.layanan.create') }}"
                   class="flex items-center gap-3 rounded-xl border border-slate-100 bg-slate-50 p-3 text-xs font-semibold text-slate-700 transition hover:bg-indigo-50 hover:text-indigo-600">
                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600">
                        <i class="fa-solid fa-plus text-base"></i>
                    </span>
                    <span>Tambah Layanan</span>
                </a>

                <a href="{{ route('admin.artikel.create') }}"
                   class="flex items-center gap-3 rounded-xl border border-slate-100 bg-slate-50 p-3 text-xs font-semibold text-slate-700 transition hover:bg-indigo-50 hover:text-indigo-600">
                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600">
                        <i class="fa-regular fa-file text-base"></i>
                    </span>
                    <span>Tambah Artikel</span>
                </a>

                <a href="{{ route('admin.galeri.create') }}"
                   class="flex items-center gap-3 rounded-xl border border-slate-100 bg-slate-50 p-3 text-xs font-semibold text-slate-700 transition hover:bg-indigo-50 hover:text-indigo-600">
                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600">
                        <i class="fa-solid fa-image text-base"></i>
                    </span>
                    <span>Unggah Galeri</span>
                </a>

                <a href="{{ route('admin.cms.edit') }}"
                   class="flex items-center gap-3 rounded-xl border border-slate-100 bg-slate-50 p-3 text-xs font-semibold text-slate-700 transition hover:bg-indigo-50 hover:text-indigo-600">
                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600">
                        <i class="fa-solid fa-pen-to-square text-base"></i>
                    </span>
                    <span>Edit CMS Profil</span>
                </a>

                <a href="{{ route('admin.pengaturan.edit') }}"
                   class="flex items-center gap-3 rounded-xl border border-slate-100 bg-slate-50 p-3 text-xs font-semibold text-slate-700 transition hover:bg-indigo-50 hover:text-indigo-600 sm:col-span-2">
                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600">
                        <i class="fa-solid fa-gear text-base"></i>
                    </span>
                    <span>Pengaturan Akun & Sandi</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
