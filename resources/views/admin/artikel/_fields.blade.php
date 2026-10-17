@php
    $artikel ??= null;
    $tanggal = old('tanggal', $artikel?->tanggal?->format('Y-m-d') ?? '');
@endphp

<div class="grid gap-5">
    <div>
        <label for="judul" class="block text-sm font-medium text-slate-700">Judul Artikel</label>
        <input type="text" id="judul" name="judul" value="{{ old('judul', $artikel->judul ?? '') }}" required
               class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
        @error('judul') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="grid gap-5 sm:grid-cols-2">
        <div>
            <label for="kategori" class="block text-sm font-medium text-slate-700">Kategori</label>
            <input type="text" id="kategori" name="kategori" value="{{ old('kategori', $artikel->kategori ?? '') }}" required
                   class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
            @error('kategori') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="tanggal" class="block text-sm font-medium text-slate-700">Tanggal</label>
            <input type="date" id="tanggal" name="tanggal" value="{{ $tanggal }}" required
                   class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
            @error('tanggal') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>
    </div>

    <div>
        <label for="penulis" class="block text-sm font-medium text-slate-700">Penulis</label>
        <input type="text" id="penulis" name="penulis" value="{{ old('penulis', $artikel->penulis ?? 'Tim Redaksi') }}" required
               class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
        @error('penulis') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="gambar" class="block text-sm font-medium text-slate-700">URL Gambar</label>
        <input type="text" id="gambar" name="gambar" value="{{ old('gambar', $artikel->gambar ?? '') }}" required
               placeholder="https://..." class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
        @error('gambar') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="ringkas" class="block text-sm font-medium text-slate-700">Ringkasan</label>
        <textarea id="ringkas" name="ringkas" rows="2" required
                  class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">{{ old('ringkas', $artikel->ringkas ?? '') }}</textarea>
        @error('ringkas') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="isi" class="block text-sm font-medium text-slate-700">Isi Artikel</label>
        <textarea id="isi" name="isi" rows="8" required
                  class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">{{ old('isi', $artikel->isi ?? '') }}</textarea>
        @error('isi') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>
</div>
