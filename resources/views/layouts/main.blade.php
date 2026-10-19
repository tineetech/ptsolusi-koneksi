<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'PT Solusi Koneksi - Penyedia solusi jaringan, internet, dan infrastruktur teknologi informasi.')">
    <title>@yield('title', 'Beranda') &middot; PT Solusi Koneksi</title>

    <link rel="icon" type="image/png" href="{{ asset('images/logo-sk4.png') }}">

    {{-- Tailwind CSS (via CDN) --}}
    @include('partials.tailwind')

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    {{-- Animasi fade-in saat halaman dimuat / di-scroll --}}
    <script>document.documentElement.classList.add('js');</script>
    <style>
        .js .reveal {
            opacity: 0;
        }

        .js .reveal.is-visible {
            animation: reveal-up 700ms cubic-bezier(0.22, 1, 0.36, 1) both;
            animation-delay: var(--reveal-delay, 0ms);
        }

        @keyframes reveal-up {
            from {
                opacity: 0;
                transform: translateY(24px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .js .reveal {
                opacity: 1;
            }

            .js .reveal.is-visible {
                animation: none;
            }
        }
    </style>

    @stack('styles')
</head>
<body class="bg-slate-50 font-sans text-slate-700 antialiased">

    <header class="sticky top-0 z-50 border-b border-slate-200 bg-white/90 backdrop-blur">
        <nav class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4">
            <a href="{{ route('home') }}" class="flex items-center">
                <img src="{{ asset('images/logo-sk1.png') }}" alt="PT Solusi Koneksi" class="h-10 w-auto">
            </a>

            @php
                $menu = [
                    ['label' => 'Home', 'route' => 'home'],
                    ['label' => 'Profil', 'route' => 'profil'],
                    ['label' => 'Layanan', 'route' => 'produk'],
                    ['label' => 'Artikel', 'route' => 'artikel'],
                    ['label' => 'Galeri', 'route' => 'galeri'],
                    ['label' => 'Kontak', 'route' => 'kontak'],
                ];
            @endphp

            <ul class="hidden items-center gap-1 md:flex">
                @foreach ($menu as $item)
                    @php $active = request()->routeIs($item['route']) || request()->routeIs($item['route'].'.*'); @endphp
                    <li>
                        <a href="{{ route($item['route']) }}"
                           class="block rounded-md px-3 py-2 text-sm font-medium transition {{ $active ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                            {{ $item['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <a href="{{ route('kontak') }}" class="hidden items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-indigo-700 md:inline-flex">
                Hubungi Kami
                <i class="fa-solid fa-arrow-right text-sm"></i>
            </a>

            <button id="menu-toggle" class="rounded-md p-2 text-slate-600 hover:bg-slate-100 md:hidden" aria-label="Buka menu">
                <i class="fa-solid fa-bars text-2xl"></i>
            </button>
        </nav>

        <div id="mobile-menu" class="hidden border-t border-slate-200 bg-white md:hidden">
            <ul class="space-y-1 px-4 py-3">
                @foreach ($menu as $item)
                    @php $active = request()->routeIs($item['route']) || request()->routeIs($item['route'].'.*'); @endphp
                    <li>
                        <a href="{{ route($item['route']) }}"
                           class="block rounded-md px-3 py-2 text-sm font-medium transition {{ $active ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600 hover:bg-slate-100' }}">
                            {{ $item['label'] }}
                        </a>
                    </li>
                @endforeach
                <li class="pt-2 border-t border-slate-100">
                    @auth
                        <a href="{{ route('admin.dashboard') }}"
                           class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-medium text-white transition hover:bg-indigo-700">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('kontak') }}"
                           class="flex items-center justify-center gap-2 rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-medium text-white transition hover:bg-indigo-700">
                            <i class="fa-solid fa-phone-volume text-base"></i>
                            Hubungi Kami
                        </a>
                    @endauth
                </li>
            </ul>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="mt-20 bg-slate-900 text-slate-300">
        <div class="mx-auto grid max-w-6xl gap-8 px-4 py-12 md:grid-cols-4">
            <div class="md:col-span-2">
                <div class="flex items-center">
                    <img src="{{ asset('images/logo-sk8.png') }}" alt="PT Solusi Koneksi"
                         class="h-12 w-auto">
                </div>
                <p class="mt-4 max-w-md text-sm leading-relaxed">
                    Penyedia solusi jaringan, internet, keamanan, dan infrastruktur teknologi informasi
                    untuk perkantoran, kampus, dan industri di seluruh Indonesia.
                </p>
                <div class="mt-5 flex gap-3">
                    <a href="#" class="flex h-9 w-9 items-center justify-center rounded-full bg-slate-800 text-lg transition hover:bg-indigo-600"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="flex h-9 w-9 items-center justify-center rounded-full bg-slate-800 text-lg transition hover:bg-indigo-600"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="flex h-9 w-9 items-center justify-center rounded-full bg-slate-800 text-lg transition hover:bg-indigo-600"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="#" class="flex h-9 w-9 items-center justify-center rounded-full bg-slate-800 text-lg transition hover:bg-indigo-600"><i class="fa-brands fa-youtube"></i></a>
                </div>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-white">Navigasi</h3>
                <ul class="mt-4 space-y-2 text-sm">
                    <li><a href="{{ route('profil') }}" class="hover:text-white">Profil Perusahaan</a></li>
                    <li><a href="{{ route('produk') }}" class="hover:text-white">Layanan</a></li>
                    <li><a href="{{ route('artikel') }}" class="hover:text-white">Artikel</a></li>
                    <li><a href="{{ route('galeri') }}" class="hover:text-white">Galeri Kegiatan</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-white">Kontak</h3>
                <ul class="mt-4 space-y-2 text-sm">
                    <li class="flex items-start gap-2"><i class="fa-solid fa-location-dot mt-0.5 text-indigo-400"></i> Jl. Raya Pajajaran No. 88 F Kota Bogor 16153</li>
                    <li class="flex items-start gap-2"><i class="fa-solid fa-phone mt-0.5 text-indigo-400"></i> (021) 1234-5678</li>
                    <li class="flex items-start gap-2"><i class="fa-solid fa-envelope mt-0.5 text-indigo-400"></i> info@solusikoneksi.id</li>
                    <li class="flex items-start gap-2"><i class="fa-regular fa-clock mt-0.5 text-indigo-400"></i> Senin - Jumat, 08.00 - 17.00 WIB</li>
                </ul>
            </div>
        </div>
        <div class="border-t border-slate-800 py-5 text-center text-xs text-slate-400">
            &copy; {{ date('Y') }} PT Solusi Koneksi. Seluruh hak cipta dilindungi.
        </div>
    </footer>

    @stack('scripts')

    <script>
        document.getElementById('menu-toggle')?.addEventListener('click', function () {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });

        (function () {
            if (!('IntersectionObserver' in window) || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                return;
            }

            const skip = (el) => el.matches('script, style, template') || el.classList.contains('absolute');

            const expand = (el) => {
                if (el.matches('.grid')) {
                    return Array.from(el.children).filter((child) => !skip(child));
                }
                return [el];
            };

            const collectItems = (group) => {
                let children = Array.from(group.children).filter((el) => !skip(el));

                if (children.length === 1 && children[0].tagName === 'DIV' && !children[0].classList.contains('grid')) {
                    const inner = Array.from(children[0].children).filter((el) => !skip(el));
                    if (inner.length > 1) {
                        children = inner;
                    }
                }

                return children.flatMap(expand).filter((el) => !skip(el));
            };

            const seen = new Set();

            document.querySelectorAll('main > section, main > header, footer').forEach((group) => {
                collectItems(group).forEach((el, index) => {
                    if (seen.has(el)) {
                        return;
                    }
                    seen.add(el);

                    el.classList.add('reveal');
                    el.style.setProperty('--reveal-delay', `${Math.min(index, 6) * 80}ms`);
                });
            });

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (!entry.isIntersecting) {
                        return;
                    }

                    const el = entry.target;
                    el.classList.add('is-visible');
                    observer.unobserve(el);

                    el.addEventListener('animationend', () => {
                        el.classList.remove('reveal', 'is-visible');
                        el.style.removeProperty('--reveal-delay');
                    }, { once: true });
                });
            }, { threshold: 0 });

            requestAnimationFrame(() => {
                requestAnimationFrame(() => {
                    document.querySelectorAll('.reveal').forEach((el) => observer.observe(el));
                });
            });
        })();
    </script>
</body>
</html>
