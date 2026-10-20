@extends('layouts.admin')

@section('title', 'Detail Pesan')

@section('content')
    <div class="mx-auto max-w-3xl">
        <div class="mb-6 flex items-center justify-between gap-4">
            <div>
                <h2 class="text-lg font-bold text-slate-900">Detail Pesan</h2>
                <div class="mt-1 flex flex-wrap items-center gap-2">
                    <p class="text-sm text-slate-500">Dikirim pada {{ $pesan->created_at->format('d/m/Y H:i') }}</p>
                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $pesan->status === 'replied' ? 'bg-emerald-50 text-emerald-600' : 'bg-amber-50 text-amber-600' }}">
                        {{ $pesan->status === 'replied' ? 'Dibalas' : 'Pending' }}
                    </span>
                </div>
            </div>
            <a href="{{ route('admin.pesan.index') }}"
               class="inline-flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-8">
            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="nama" class="block text-sm font-medium text-slate-700">Nama</label>
                    <input type="text" id="nama" value="{{ $pesan->nama }}" disabled
                           class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm disabled:cursor-not-allowed disabled:bg-slate-100 disabled:text-slate-500">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                    <input type="email" id="email" value="{{ $pesan->email }}" disabled
                           class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm disabled:cursor-not-allowed disabled:bg-slate-100 disabled:text-slate-500">
                </div>
            </div>

            <div class="mt-5">
                <label for="subjek" class="block text-sm font-medium text-slate-700">Subjek</label>
                <input type="text" id="subjek" value="{{ $pesan->subjek }}" disabled
                       class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm disabled:cursor-not-allowed disabled:bg-slate-100 disabled:text-slate-500">
            </div>

            <div class="mt-5">
                <label for="pesan" class="block text-sm font-medium text-slate-700">Pesan</label>
                <textarea id="pesan" rows="6" disabled
                          class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm disabled:cursor-not-allowed disabled:bg-slate-100 disabled:text-slate-500">{{ $pesan->pesan }}</textarea>
            </div>
        </div>

        <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-6">
            <form method="POST" action="{{ route('admin.pesan.status', $pesan) }}" class="flex flex-wrap items-end gap-4">
                @csrf
                @method('PATCH')

                <div class="min-w-48 flex-1">
                    <label for="status" class="block text-sm font-medium text-slate-700">Status Pesan</label>
                    <select id="status" name="status"
                            class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                        <option value="pending" @selected(old('status', $pesan->status) === 'pending')>Pending</option>
                        <option value="replied" @selected(old('status', $pesan->status) === 'replied')>Dibalas</option>
                    </select>
                    @error('status') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <button type="submit"
                        class="inline-flex items-center gap-2 rounded-lg bg-slate-800 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-900">
                    <i class="fa-solid fa-check text-base"></i> Simpan Status
                </button>
            </form>
        </div>

        <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-8">
            <h3 class="text-lg font-bold text-slate-900">Balas Pesan</h3>
            <p class="mt-1 text-sm text-slate-500">
                Balasan akan dikirim ke <span class="font-semibold text-slate-700">{{ $pesan->email }}</span>.
            </p>

            <form method="POST" action="{{ route('admin.pesan.balas', $pesan) }}" class="mt-5 space-y-5">
                @csrf

                <div>
                    <label for="subjek_balasan" class="block text-sm font-medium text-slate-700">Subjek</label>
                    <input type="text" id="subjek_balasan" name="subjek"
                           value="{{ old('subjek', 'Re: '.$pesan->subjek) }}" required
                           placeholder="Subjek balasan"
                           class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                    @error('subjek') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="isi_balasan" class="block text-sm font-medium text-slate-700">Isi Pesan</label>
                    <textarea id="isi_balasan" name="isi" rows="6" required
                              placeholder="Tulis balasan untuk pengirim..."
                              class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">{{ old('isi') }}</textarea>
                    @error('isi') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center justify-end">
                    <button type="submit"
                            class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700">
                        <i class="fa-solid fa-paper-plane text-lg"></i> Kirim Balasan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
