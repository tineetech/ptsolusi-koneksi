<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    @php $branding = \App\Models\Cms::branding(); @endphp
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') &middot; Admin PT Solusi Koneksi</title>
    <link rel="icon" type="image/png" href="{{ asset($branding['favicon']) }}">
    @include('partials.tailwind')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    @stack('styles')
</head>
<body class="min-h-full bg-slate-100 font-sans text-slate-700 antialiased">

    <div class="min-h-screen md:flex">
        <aside id="admin-sidebar"
               class="fixed inset-y-0 left-0 z-50 w-64 -translate-x-full transform bg-slate-900 text-slate-300 transition-transform duration-200 md:static md:translate-x-0">
            <div class="flex items-center gap-2 border-b border-slate-800 px-6 py-5">
                <img src="{{ asset($branding['white']) }}" alt="PT Solusi Koneksi" class="h-10 w-auto px-2 py-1">
            </div>

            @php
                $menu = [
                    ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'icon' => 'fa-solid fa-table-cells-large'],
                    ['label' => 'Layanan', 'route' => 'admin.layanan.index', 'icon' => 'fa-solid fa-box'],
                    ['label' => 'Data Klien', 'route' => 'admin.klien.index', 'icon' => 'fa-solid fa-users'],
                    ['label' => 'Artikel', 'route' => 'admin.artikel.index', 'icon' => 'fa-regular fa-newspaper'],
                    ['label' => 'Galeri', 'route' => 'admin.galeri.index', 'icon' => 'fa-regular fa-image'],
                    ['label' => 'Pesan Masuk', 'route' => 'admin.pesan.index', 'icon' => 'fa-regular fa-envelope'],
                    ['label' => 'CMS Profil', 'route' => 'admin.cms.edit', 'icon' => 'fa-solid fa-pen-to-square'],
                    ['label' => 'Pengaturan', 'route' => 'admin.pengaturan.edit', 'icon' => 'fa-solid fa-gear'],
                ];
            @endphp

            <nav class="px-4 py-5">
                <ul class="space-y-1">
                    @foreach ($menu as $item)
                        @php $active = request()->routeIs($item['route']) || request()->routeIs(str_replace('.index', '.*', $item['route'])); @endphp
                        <li>
                            <a href="{{ route($item['route']) }}"
                               class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition {{ $active ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                                <i class="{{ $item['icon'] }} text-lg"></i>
                                {{ $item['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </nav>

            <div class="absolute inset-x-0 bottom-0 border-t border-slate-800 p-4">
                <a href="{{ route('home') }}" target="_blank"
                   class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-400 transition hover:bg-slate-800 hover:text-white">
                    <i class="fa-solid fa-arrow-up-right-from-square text-lg"></i> Lihat Website
                </a>
            </div>
        </aside>

        <div id="admin-overlay" class="fixed inset-0 z-40 hidden bg-slate-900/50 md:hidden"></div>

        <div class="flex min-w-0 flex-1 flex-col">
            <header class="sticky top-0 z-30 flex items-center justify-between gap-4 border-b border-slate-200 bg-white px-4 py-3 md:px-8">
                <div class="flex items-center gap-3">
                    <button id="sidebar-toggle" class="rounded-md p-2 text-slate-600 hover:bg-slate-100 md:hidden" aria-label="Buka menu">
                        <i class="fa-solid fa-bars text-2xl"></i>
                    </button>
                    <h1 class="text-lg font-bold text-slate-900">@yield('title', 'Dashboard')</h1>
                </div>

                <div class="flex items-center gap-4">
                    <div class="hidden text-right sm:block">
                        <div class="text-sm font-semibold text-slate-800">{{ auth()->user()->name }}</div>
                        <div class="text-xs text-slate-400">{{ auth()->user()->email }}</div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="flex items-center gap-1.5 rounded-lg border border-slate-200 px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-red-50 hover:text-red-600">
                            <i class="fa-solid fa-right-from-bracket text-lg"></i>
                            <span class="hidden sm:inline">Logout</span>
                        </button>
                    </form>
                </div>
            </header>

            <main class="flex-1 p-4 md:p-8">
                @if (session('success'))
                    <div class="mb-6 flex items-center gap-2 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                        <i class="fa-solid fa-circle-check text-lg"></i> {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 flex items-center gap-2 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                        <i class="fa-solid fa-circle-exclamation text-lg"></i> {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')

    <script>
        const sidebar = document.getElementById('admin-sidebar');
        const overlay = document.getElementById('admin-overlay');

        document.getElementById('sidebar-toggle')?.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        });

        overlay?.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });
    </script>
</body>
</html>
