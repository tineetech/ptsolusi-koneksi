@extends('layouts.admin')

@section('title', 'CMS Profil')

@section('content')
    <div class="mx-auto max-w-3xl">
        <div class="mb-6 rounded-2xl border border-indigo-100 bg-indigo-50 px-5 py-4 text-sm text-indigo-700">
            <i class="fa-solid fa-circle-info"></i> Halaman ini untuk mengubah logo perusahaan, favicon, dan konten bagian <strong>Profil Perusahaan</strong>.
        </div>

        <form method="POST" action="{{ route('admin.cms.update') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="rounded-2xl border border-slate-200 bg-white p-8">
                <h2 class="text-lg font-bold text-slate-900">Logo &amp; Favicon</h2>
                <p class="mt-1 text-sm text-slate-500">Logo baru akan dipakai di navbar, footer, sidebar admin, dan favicon website. Biarkan kosong jika tidak ingin mengubah.</p>

                <div class="mt-5 grid gap-5 md:grid-cols-3">
                    <x-image-input name="logo_favicon" label="Logo Favicon" :current="$logo['favicon']" />
                    <x-image-input name="logo_primary" label="Logo Perusahaan (Primary Color)" :current="$logo['primary']" />
                    <x-image-input name="logo_white" label="Logo Perusahaan (White Color)" :current="$logo['white']" />
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-8">
                <h2 class="text-lg font-bold text-slate-900">Tentang Kami</h2>

                <div class="mt-5 grid gap-5">
                    <div>
                        <label for="tentang_judul" class="block text-sm font-medium text-slate-700">Judul</label>
                        <input type="text" id="tentang_judul" name="tentang_judul"
                               value="{{ old('tentang_judul', $profil['tentang']['judul']) }}" required
                               placeholder="Contoh: Tentang PT Solusi Koneksi"
                               class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                        @error('tentang_judul') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <x-image-input
                        name="tentang_gambar"
                        label="Gambar"
                        :current="$profil['tentang']['gambar']" />

                    <div>
                        <label for="tentang_isi" class="block text-sm font-medium text-slate-700">Paragraf <span class="text-xs font-normal text-slate-400">(pisahkan paragraf dengan enter)</span></label>
                        <textarea id="tentang_isi" name="tentang_isi" rows="5" required
                                  placeholder="Tulis isi tentang perusahaan..."
                                  class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">{{ old('tentang_isi', $profil['tentang']['isi']) }}</textarea>
                        @error('tentang_isi') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-8">
                <h2 class="text-lg font-bold text-slate-900">Visi &amp; Misi</h2>

                <div class="mt-5 grid gap-5">
                    <div>
                        <label for="visi" class="block text-sm font-medium text-slate-700">Visi</label>
                        <textarea id="visi" name="visi" rows="3" required
                                  placeholder="Tulis visi perusahaan..."
                                  class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">{{ old('visi', $profil['visi']) }}</textarea>
                        @error('visi') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="misi" class="block text-sm font-medium text-slate-700">Misi <span class="text-xs font-normal text-slate-400">(satu poin per baris)</span></label>
                        <textarea id="misi" name="misi" rows="5" required
                                  placeholder="Tulis misi perusahaan..."
                                  class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">{{ old('misi', $profil['misi']) }}</textarea>
                        @error('misi') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-8">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Nilai Perusahaan</h2>
                        <p class="mt-1 text-sm text-slate-500">Klik judul untuk membuka, lalu tambah atau kurangi nilai sesuai kebutuhan.</p>
                    </div>
                    <button type="button" id="tambah-nilai"
                            class="inline-flex flex-none items-center gap-2 rounded-lg bg-indigo-50 px-3 py-2 text-sm font-semibold text-indigo-600 transition hover:bg-indigo-100">
                        <i class="fa-solid fa-plus"></i> Tambah Nilai
                    </button>
                </div>

                <div id="nilai-list" class="mt-5 space-y-3">
                    @foreach ($profil['nilai'] as $i => $item)
                        <div class="nilai-item rounded-xl border border-slate-200">
                            <div class="flex items-center justify-between gap-2 px-4 py-3">
                                <button type="button" class="nilai-toggle flex flex-1 items-center gap-3 text-left text-sm font-semibold text-slate-700">
                                    <i class="nilai-chevron fa-solid fa-chevron-right text-xs text-slate-400 transition-transform"></i>
                                    <span class="nilai-title">{{ old('nilai_judul.'.$i, $item['judul']) ?: 'Nilai Baru' }}</span>
                                </button>
                                <button type="button" class="nilai-hapus rounded-md p-2 text-slate-400 transition hover:bg-red-50 hover:text-red-600" aria-label="Hapus nilai">
                                    <i class="fa-solid fa-trash text-sm"></i>
                                </button>
                            </div>
                            <div class="nilai-body hidden border-t border-slate-200 p-4">
                                <div class="grid gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700">Judul</label>
                                        <input type="text" name="nilai_judul[]" value="{{ old('nilai_judul.'.$i, $item['judul']) }}"
                                               placeholder="Contoh: Integritas"
                                               class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700">Deskripsi</label>
                                        <textarea name="nilai_deskripsi[]" rows="2"
                                                  placeholder="Contoh: Menjunjung tinggi kejujuran dalam setiap layanan"
                                                  class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">{{ old('nilai_deskripsi.'.$i, $item['deskripsi']) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @error('nilai_judul.*') <p class="mt-2 text-xs text-red-600">{{ $message }}</p> @enderror
                @error('nilai_deskripsi.*') <p class="mt-2 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <template id="nilai-template">
                <div class="nilai-item rounded-xl border border-slate-200">
                    <div class="flex items-center justify-between gap-2 px-4 py-3">
                        <button type="button" class="nilai-toggle flex flex-1 items-center gap-3 text-left text-sm font-semibold text-slate-700">
                            <i class="nilai-chevron fa-solid fa-chevron-right rotate-90 text-xs text-slate-400 transition-transform"></i>
                            <span class="nilai-title">Nilai Baru</span>
                        </button>
                        <button type="button" class="nilai-hapus rounded-md p-2 text-slate-400 transition hover:bg-red-50 hover:text-red-600" aria-label="Hapus nilai">
                            <i class="fa-solid fa-trash text-sm"></i>
                        </button>
                    </div>
                    <div class="nilai-body border-t border-slate-200 p-4">
                        <div class="grid gap-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700">Judul</label>
                                <input type="text" name="nilai_judul[]" value=""
                                       placeholder="Contoh: Integritas"
                                       class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700">Deskripsi</label>
                                <textarea name="nilai_deskripsi[]" rows="2"
                                          placeholder="Contoh: Menjunjung tinggi kejujuran dalam setiap layanan"
                                          class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </template>

            <div class="flex items-center gap-3">
                <button type="submit"
                        class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700">
                    <i class="fa-solid fa-floppy-disk text-lg"></i> Perbarui Konten
                </button>
                <a href="{{ route('profil') }}" target="_blank" class="text-sm font-medium text-slate-500 hover:text-slate-700">Lihat Halaman</a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        (function () {
            var list = document.getElementById('nilai-list');
            var template = document.getElementById('nilai-template');
            var tombolTambah = document.getElementById('tambah-nilai');

            function siapkanItem(item) {
                var toggle = item.querySelector('.nilai-toggle');
                var body = item.querySelector('.nilai-body');
                var chevron = item.querySelector('.nilai-chevron');
                var hapus = item.querySelector('.nilai-hapus');
                var input = item.querySelector('input[name="nilai_judul[]"]');
                var judul = item.querySelector('.nilai-title');

                toggle.addEventListener('click', function () {
                    body.classList.toggle('hidden');
                    chevron.classList.toggle('rotate-90');
                });

                input.addEventListener('input', function () {
                    judul.textContent = input.value.trim() || 'Nilai Baru';
                });

                hapus.addEventListener('click', function () {
                    item.remove();
                });
            }

            list.querySelectorAll('.nilai-item').forEach(siapkanItem);

            tombolTambah.addEventListener('click', function () {
                var item = template.content.firstElementChild.cloneNode(true);
                list.appendChild(item);
                siapkanItem(item);
                item.querySelector('input').focus();
            });
        })();
    </script>
@endpush
