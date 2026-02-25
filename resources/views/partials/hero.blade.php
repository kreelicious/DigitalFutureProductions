@php
    $hero = $hero ?? [];
    $overlayOpacity = $hero['overlayOpacity'] ?? 0.45;
    $title = $title ?? '';
    $headline = $headline ?? '';
@endphp

<section class="relative flex min-h-screen items-end overflow-hidden">
    @if (($hero['mediaType'] ?? 'image') === 'video' && !empty($hero['vimeoId']))
        <div class="absolute inset-0">
            <iframe
                class="h-full w-full scale-125"
                src="https://player.vimeo.com/video/{{ $hero['vimeoId'] }}?background=1&autoplay=1&loop=1&muted=1&controls=0"
                title="{{ $title }}"
                allow="autoplay; fullscreen; picture-in-picture"
                loading="lazy"></iframe>
        </div>
    @elseif (!empty($hero['imageUrl']))
        <img
            src="{{ $hero['imageUrl'] }}"
            alt="{{ $hero['imageAlt'] ?? $title }}"
            class="absolute inset-0 h-full w-full object-cover" />
    @else
        <div class="absolute inset-0 bg-gradient-to-br from-slate-900 to-slate-700"></div>
    @endif

    <div class="absolute inset-0 bg-black" style="opacity: {{ $overlayOpacity }};"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/30 to-transparent"></div>

    <div class="relative z-10 mx-auto w-full max-w-7xl px-6 pb-20 pt-40">
        <p class="mb-3 text-xs uppercase tracking-[0.2em] text-orange-300">Future Digital Productions</p>
        <h1 class="max-w-4xl text-4xl font-semibold leading-tight text-white md:text-6xl">{{ $title }}</h1>
        <p class="mt-5 max-w-3xl text-base text-slate-200 md:text-xl">{{ $headline }}</p>
    </div>
</section>
