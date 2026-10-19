@php
    $artikel ??= null;
    $tanggal = old('tanggal', $artikel?->tanggal?->format('Y-m-d') ?? '');
@endphp

<div class="grid gap-5">
    <div>
        <label for="judul" class="block text-sm font-medium text-slate-700">Judul Artikel</label>
        <input type="text" id="judul" name="judul" value="{{ old('judul', $artikel->judul ?? '') }}" required
               placeholder="Contoh: Transformasi Digital untuk UMKM"
               class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
        @error('judul') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="grid gap-5 sm:grid-cols-2">
        <div>
            <label for="kategori" class="block text-sm font-medium text-slate-700">Kategori</label>
            <select id="kategori" name="kategori" required
                    class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                <option value="" disabled {{ old('kategori', $artikel->kategori ?? '') === '' ? 'selected' : '' }}>Pilih kategori</option>
                @foreach (['Teknologi', 'Keamanan', 'Jaringan'] as $kategori)
                    <option value="{{ $kategori }}" @selected(old('kategori', $artikel->kategori ?? '') === $kategori)>{{ $kategori }}</option>
                @endforeach
            </select>
            @error('kategori') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="tanggal" class="block text-sm font-medium text-slate-700">Tanggal</label>
            <input type="date" id="tanggal" name="tanggal" value="{{ $tanggal }}" required
                   placeholder="Pilih tanggal"
                   class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
            @error('tanggal') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>
    </div>

    <div>
        <label for="penulis" class="block text-sm font-medium text-slate-700">Penulis</label>
        <input type="text" id="penulis" name="penulis" value="{{ old('penulis', $artikel->penulis ?? 'Tim Redaksi') }}" required
               placeholder="Contoh: Tim Redaksi"
               class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
        @error('penulis') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <x-image-input name="gambar" label="Gambar Artikel" :current="$artikel->gambar ?? null" :required="$artikel === null" />

    <div>
        <label for="ringkas" class="block text-sm font-medium text-slate-700">Ringkasan</label>
        <textarea id="ringkas" name="ringkas" rows="2" required
                  placeholder="Tulis ringkasan singkat artikel..."
                  class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">{{ old('ringkas', $artikel->ringkas ?? '') }}</textarea>
        @error('ringkas') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="isi" class="block text-sm font-medium text-slate-700">Isi Artikel</label>
        <textarea id="isi" name="isi" rows="8" required
                  placeholder="Tulis isi artikel secara lengkap..."
                  class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">{{ old('isi', $artikel->isi ?? '') }}</textarea>
        @error('isi') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>
</div>
