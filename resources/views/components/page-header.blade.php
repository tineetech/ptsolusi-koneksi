@props([
    'title' => '',
    'subtitle' => '',
    'breadcrumb' => [],
])

<section class="bg-slate-900">
    <div class="mx-auto max-w-6xl px-4 py-16">
        <nav class="flex flex-wrap items-center gap-2 text-sm text-slate-400">
            <a href="{{ route('home') }}" class="hover:text-white">Home</a>
            @foreach ($breadcrumb as $label => $url)
                <span>/</span>
                @if ($url)
                    <a href="{{ $url }}" class="hover:text-white">{{ $label }}</a>
                @else
                    <span class="text-slate-200">{{ $label }}</span>
                @endif
            @endforeach
        </nav>
        <h1 class="mt-4 text-3xl font-bold text-white md:text-4xl">{{ $title }}</h1>
        @if ($subtitle)
            <p class="mt-3 max-w-2xl text-slate-300">{{ $subtitle }}</p>
        @endif
    </div>
</section>
