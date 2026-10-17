@php
    $galeri ??= null;
    $tanggal = old('tanggal', $galeri?->tanggal?->format('Y-m-d') ?? '');
@endphp

<div class="grid gap-5">
    <div>
        <label for="judul" class="block text-sm font-medium text-slate-700">Judul Kegiatan</label>
        <input type="text" id="judul" name="judul" value="{{ old('judul', $galeri->judul ?? '') }}" required
               class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
        @error('judul') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="tanggal" class="block text-sm font-medium text-slate-700">Tanggal</label>
        <input type="date" id="tanggal" name="tanggal" value="{{ $tanggal }}" required
               class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
        @error('tanggal') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="gambar" class="block text-sm font-medium text-slate-700">URL Gambar</label>
        <input type="text" id="gambar" name="gambar" value="{{ old('gambar', $galeri->gambar ?? '') }}" required
               placeholder="https://..." class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
        @error('gambar') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>
</div>
