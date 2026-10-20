@php $klien ??= null; @endphp

<div class="grid gap-5">
    <div>
        <label for="layanan_id" class="block text-sm font-medium text-slate-700">Layanan</label>
        <select id="layanan_id" name="layanan_id" required
                class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
            <option value="" disabled @selected((string) old('layanan_id', $klien->layanan_id ?? '') === '')>Pilih layanan</option>
            @foreach ($layanan as $item)
                <option value="{{ $item->id }}" @selected((string) old('layanan_id', $klien->layanan_id ?? '') === (string) $item->id)>
                    {{ $item->nama }} &mdash; {{ $item->kategori }}
                </option>
            @endforeach
        </select>
        @error('layanan_id') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="grid gap-5 sm:grid-cols-2">
        <div>
            <label for="nama_client" class="block text-sm font-medium text-slate-700">Nama Client</label>
            <input type="text" id="nama_client" name="nama_client" value="{{ old('nama_client', $klien->nama_client ?? '') }}" required
                   placeholder="Contoh: Budi Santoso"
                   class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
            @error('nama_client') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="nama_perusahaan" class="block text-sm font-medium text-slate-700">Nama Perusahaan</label>
            <input type="text" id="nama_perusahaan" name="nama_perusahaan" value="{{ old('nama_perusahaan', $klien->nama_perusahaan ?? '') }}" required
                   placeholder="Contoh: PT Nusantara Digital"
                   class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
            @error('nama_perusahaan') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="grid gap-5 sm:grid-cols-2">
        <div>
            <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $klien->email ?? '') }}" required
                   placeholder="nama@perusahaan.com"
                   class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
            @error('email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="no_telephone" class="block text-sm font-medium text-slate-700">No. Telepon</label>
            <input type="text" id="no_telephone" name="no_telephone" value="{{ old('no_telephone', $klien->no_telephone ?? '') }}" required
                   placeholder="Contoh: 0812-3456-7890"
                   class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
            @error('no_telephone') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>
    </div>

    <div>
        <label for="alamat_perusahaan" class="block text-sm font-medium text-slate-700">Alamat Perusahaan</label>
        <textarea id="alamat_perusahaan" name="alamat_perusahaan" rows="2" required
                  placeholder="Tulis alamat lengkap perusahaan..."
                  class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">{{ old('alamat_perusahaan', $klien->alamat_perusahaan ?? '') }}</textarea>
        @error('alamat_perusahaan') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="grid gap-5 sm:grid-cols-1">
        <div>
            <label for="status" class="block text-sm font-medium text-slate-700">Status</label>
            <select id="status" name="status" required
                    class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                @foreach (['proses' => 'Proses', 'konsultasi' => 'Konsultasi', 'terjual' => 'Terjual'] as $value => $label)
                    <option value="{{ $value }}" @selected(old('status', $klien->status ?? 'proses') === $value)>{{ $label }}</option>
                @endforeach
            </select>
            @error('status') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="notes" class="block text-sm font-medium text-slate-700">Catatan <span class="text-xs font-normal text-slate-400">(opsional)</span></label>
            <textarea id="notes" name="notes" rows="3"
                      placeholder="Catatan tambahan..."
                      class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">{{ old('notes', $klien->notes ?? '') }}</textarea>
            @error('notes') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>
    </div>
</div>
