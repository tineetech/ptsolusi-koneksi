<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin &middot; PT Solusi Koneksi</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-sk4.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>
<body class="flex min-h-full items-center justify-center bg-slate-100 px-4 font-sans text-slate-700 antialiased">
    <div class="w-full max-w-md">
        <div class="mb-8 text-center">
            <img src="{{ asset('images/logo-sk1.png') }}" alt="PT Solusi Koneksi" class="mx-auto h-14 w-auto">
            <h1 class="mt-4 text-xl font-bold text-slate-900">Panel Administrator</h1>
            <p class="mt-1 text-sm text-slate-500">Masuk untuk mengelola konten website.</p>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
            @if ($errors->any())
                <div class="mb-5 flex items-start gap-2 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-600">
                    <i class="bx bx-error-circle mt-0.5 text-lg"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login.attempt') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                           class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                    <div class="relative mt-2">
                        <input type="password" id="password" name="password" required
                               class="w-full rounded-lg border border-slate-300 px-4 py-2.5 pr-11 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                        <button type="button" id="toggle-password" tabindex="-1" aria-label="Tampilkan password" style="top: 12px"
                                class="absolute inset-y-0 right-0 flex w-11 items-center justify-center text-slate-400 transition cursor-pointer hover:text-slate-600">
                            <i id="toggle-password-icon" class="bx bx-show text-lg"></i>
                        </button>
                    </div>
                    @error('password') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <label class="flex items-center gap-2 text-sm text-slate-600">
                    <input type="checkbox" name="remember" value="1"
                           class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                    Ingat saya
                </label>

                <button type="submit"
                        class="flex w-full items-center justify-center gap-2 rounded-lg bg-indigo-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700">
                    <i class="bx bx-log-in text-lg"></i> Masuk
                </button>
            </form>
        </div>

        <p class="mt-6 text-center text-xs text-slate-400">
            &copy; {{ date('Y') }} PT Solusi Koneksi. Panel Administrator.
        </p>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const toggleButton = document.getElementById('toggle-password');
        const toggleIcon = document.getElementById('toggle-password-icon');

        toggleButton?.addEventListener('click', () => {
            const show = passwordInput.type === 'password';
            passwordInput.type = show ? 'text' : 'password';
            toggleIcon.classList.toggle('bx-show', ! show);
            toggleIcon.classList.toggle('bx-hide', show);
            toggleButton.setAttribute('aria-label', show ? 'Sembunyikan password' : 'Tampilkan password');
        });
    </script>
</body>
</html>
