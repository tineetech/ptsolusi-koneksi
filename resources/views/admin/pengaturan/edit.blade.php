@extends('layouts.admin')

@section('title', 'Pengaturan')

@section('content')
    <div class="mx-auto max-w-2xl">
        <div class="mb-6 flex items-center gap-4 rounded-2xl border border-slate-200 bg-white p-6">
            <span class="flex h-14 w-14 items-center justify-center rounded-full bg-indigo-600 text-xl font-bold text-white">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </span>
            <div>
                <div class="font-semibold text-slate-900">{{ $user->name }}</div>
                <div class="text-sm text-slate-400">{{ $user->email }}</div>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.pengaturan.update') }}" class="rounded-2xl border border-slate-200 bg-white p-8">
            @csrf
            @method('PUT')

            <div class="grid gap-5">
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700">Nama</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                           class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                    @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                           class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                    @error('email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <hr class="my-6 border-slate-100">

            <p class="text-sm text-slate-500">Biarkan kosong jika tidak ingin mengubah password.</p>

            <div class="mt-4 grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700">Password Baru</label>
                    <input type="password" id="password" name="password" autocomplete="new-password"
                           class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                    @error('password') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-700">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password"
                           class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                </div>
            </div>

            <button type="submit"
                    class="mt-6 inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700">
                <i class="bx bx-save text-lg"></i> Simpan Perubahan
            </button>
        </form>
    </div>
@endsection
