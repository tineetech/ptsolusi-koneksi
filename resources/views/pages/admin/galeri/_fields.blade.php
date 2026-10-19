@php
    $galeri ??= null;
    $tanggal = old('tanggal', $galeri?->tanggal?->format('Y-m-d') ?? '');
@endphp

<div class="grid gap-5">
    <div>
        <label for="judul" class="block text-sm font-medium text-slate-700">Judul Kegiatan</label>
        <input type="text" id="judul" name="judul" value="{{ old('judul', $galeri->judul ?? '') }}" required
               placeholder="Contoh: Pelatihan Teknisi Jaringan"
               class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
        @error('judul') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="tanggal" class="block text-sm font-medium text-slate-700">Tanggal</label>
        <input type="date" id="tanggal" name="tanggal" value="{{ $tanggal }}" required
               placeholder="Pilih tanggal"
               class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
        @error('tanggal') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <x-image-input name="gambar" label="Gambar Kegiatan" :current="$galeri->gambar ?? null" :required="$galeri === null" />
</div>
