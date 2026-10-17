@php $layanan ??= null; @endphp

<div class="grid gap-5">
    <div>
        <label for="nama" class="block text-sm font-medium text-slate-700">Nama Layanan</label>
        <input type="text" id="nama" name="nama" value="{{ old('nama', $layanan->nama ?? '') }}" required
               class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
        @error('nama') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="kategori" class="block text-sm font-medium text-slate-700">Kategori</label>
        <input type="text" id="kategori" name="kategori" value="{{ old('kategori', $layanan->kategori ?? '') }}" required
               class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
        @error('kategori') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="gambar" class="block text-sm font-medium text-slate-700">URL Gambar</label>
        <input type="text" id="gambar" name="gambar" value="{{ old('gambar', $layanan->gambar ?? '') }}" required
               placeholder="https://..." class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
        @error('gambar') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="ringkas" class="block text-sm font-medium text-slate-700">Ringkasan</label>
        <textarea id="ringkas" name="ringkas" rows="2" required
                  class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">{{ old('ringkas', $layanan->ringkas ?? '') }}</textarea>
        @error('ringkas') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="deskripsi" class="block text-sm font-medium text-slate-700">Deskripsi</label>
        <textarea id="deskripsi" name="deskripsi" rows="5" required
                  class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">{{ old('deskripsi', $layanan->deskripsi ?? '') }}</textarea>
        @error('deskripsi') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="fitur" class="block text-sm font-medium text-slate-700">Fitur <span class="text-xs font-normal text-slate-400">(satu per baris)</span></label>
        <textarea id="fitur" name="fitur" rows="5" required
                  class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">{{ old('fitur', $layanan ? implode("\n", $layanan->fitur) : '') }}</textarea>
        @error('fitur') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>
</div>
