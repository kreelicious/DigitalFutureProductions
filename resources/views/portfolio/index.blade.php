@extends('layouts.site')

@section('content')
    @include('partials.hero', [
        'hero' => ['mediaType' => 'image'],
        'title' => 'Portfolio',
        'headline' => 'Selected films across weddings, campaigns, and branded storytelling.',
    ])

    <section class="mx-auto max-w-7xl px-6 py-14">
        <div class="flex flex-wrap gap-3">
            <a href="/portfolio" class="rounded-full border px-4 py-2 text-xs uppercase tracking-[0.14em] {{ !$activeCategory ? 'border-orange-300 text-orange-300' : 'border-slate-700 text-slate-300' }}">
                All
            </a>
            @foreach ($categories as $category)
                <a
                    href="/portfolio?category={{ $category['slug'] }}"
                    class="rounded-full border px-4 py-2 text-xs uppercase tracking-[0.14em] {{ $activeCategory === $category['slug'] ? 'border-orange-300 text-orange-300' : 'border-slate-700 text-slate-300' }}">
                    {{ $category['title'] }}
                </a>
            @endforeach
        </div>

        <div class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($items as $item)
                <article class="overflow-hidden rounded-xl border border-slate-800 bg-slate-900/70">
                    <div class="aspect-video bg-slate-800">
                        @if (!empty($item['posterUrl']))
                            <img src="{{ $item['posterUrl'] }}" alt="{{ $item['posterAlt'] ?? $item['title'] }}" class="h-full w-full object-cover" />
                        @else
                            <div class="flex h-full items-center justify-center text-xs uppercase tracking-[0.14em] text-slate-400">Poster Missing</div>
                        @endif
                    </div>
                    <div class="p-5">
                        <p class="text-xs uppercase tracking-[0.14em] text-orange-300">{{ $item['category']['title'] ?? 'Uncategorized' }}</p>
                        <h2 class="mt-2 text-lg font-semibold text-white">{{ $item['title'] }}</h2>
                        <p class="mt-2 text-sm text-slate-300">{{ $item['summary'] }}</p>
                        @if (!empty($item['tags']) && is_array($item['tags']))
                            <p class="mt-3 text-xs text-slate-400">{{ implode(' • ', $item['tags']) }}</p>
                        @endif
                    </div>
                </article>
            @empty
                <p class="text-slate-300">No portfolio items published yet.</p>
            @endforelse
        </div>
    </section>
@endsection
