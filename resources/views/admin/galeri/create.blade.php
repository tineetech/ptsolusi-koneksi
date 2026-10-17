@extends('layouts.admin')

@section('title', 'Tambah Galeri')

@section('content')
    <div class="mx-auto max-w-3xl rounded-2xl border border-slate-200 bg-white p-8">
        <form method="POST" action="{{ route('admin.galeri.store') }}">
            @csrf

            @include('admin.galeri._fields')

            <div class="mt-6 flex items-center gap-3">
                <button type="submit"
                        class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700">
                    <i class="bx bx-save text-lg"></i> Simpan
                </button>
                <a href="{{ route('admin.galeri.index') }}" class="text-sm font-medium text-slate-500 hover:text-slate-700">Batal</a>
            </div>
        </form>
    </div>
@endsection
