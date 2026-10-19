@extends('layouts.admin')

@section('title', 'CMS Profil')

@section('content')
    <div class="mx-auto max-w-3xl">
        <div class="mb-6 rounded-2xl border border-indigo-100 bg-indigo-50 px-5 py-4 text-sm text-indigo-700">
            <i class="fa-solid fa-circle-info"></i> Halaman ini hanya untuk mengubah konten bagian <strong>Profil Perusahaan</strong>.
        </div>

        <form method="POST" action="{{ route('admin.cms.update') }}" class="space-y-6">
            @csrf
            @method('PUT')

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

                    <div>
                        <label for="tentang_gambar" class="block text-sm font-medium text-slate-700">URL Gambar</label>
                        <input type="text" id="tentang_gambar" name="tentang_gambar"
                               value="{{ old('tentang_gambar', $profil['tentang']['gambar']) }}" required
                               placeholder="Contoh: images/profil/kantor.jpg"
                               class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                        @error('tentang_gambar') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="tentang_isi" class="block text-sm font-medium text-slate-700">Paragraf <span class="text-xs font-normal text-slate-400">(satu paragraf per baris)</span></label>
                        <textarea id="tentang_isi" name="tentang_isi" rows="5" required
                                  placeholder="Tulis satu paragraf per baris..."
                                  class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">{{ old('tentang_isi', implode("\n", $profil['tentang']['isi'])) }}</textarea>
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
                                  placeholder="Tulis satu poin misi per baris..."
                                  class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">{{ old('misi', implode("\n", $profil['misi'])) }}</textarea>
                        @error('misi') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-8">
                <h2 class="text-lg font-bold text-slate-900">Nilai Perusahaan</h2>
                <p class="mt-1 text-sm text-slate-500">Satu nilai per baris dengan format <code class="rounded bg-slate-100 px-1.5 py-0.5 text-xs">Judul | Deskripsi</code></p>

                <textarea id="nilai" name="nilai" rows="5" required
                          placeholder="Contoh: Integritas | Menjunjung tinggi kejujuran"
                          class="mt-4 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">{{ old('nilai', collect($profil['nilai'])->map(fn ($n) => $n['judul'].' | '.$n['deskripsi'])->implode("\n")) }}</textarea>
                @error('nilai') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

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
