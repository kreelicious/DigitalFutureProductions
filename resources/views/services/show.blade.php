@extends('layouts.site')

@php
    $hero = $service['hero'] ?? [];
    $blocks = $service['description'] ?? [];
@endphp

@section('content')
    @include('partials.hero', [
        'hero' => $hero,
        'title' => $service['title'] ?? 'Service',
        'headline' => $service['headline'] ?? '',
    ])

    <section class="mx-auto grid max-w-7xl gap-12 px-6 py-20 lg:grid-cols-3">
        <div class="lg:col-span-2">
            <h2 class="text-2xl font-semibold text-white">Overview</h2>
            <div class="mt-6 space-y-5 text-lg leading-relaxed text-slate-200">
                @forelse ($blocks as $block)
                    @php
                        $text = collect($block['children'] ?? [])->pluck('text')->implode('');
                    @endphp
                    @if ($text !== '')
                        <p>{{ $text }}</p>
                    @endif
                @empty
                    <p>{{ $service['summary'] ?? 'Service details coming soon.' }}</p>
                @endforelse
            </div>
        </div>

        <aside class="rounded-xl border border-slate-800 bg-slate-900/60 p-6">
            <h3 class="text-sm uppercase tracking-[0.15em] text-orange-300">Key Benefits</h3>
            <ul class="mt-4 space-y-4 text-sm text-slate-200">
                @forelse (($service['keyBenefits'] ?? []) as $benefit)
                    <li>
                        <p class="font-semibold text-white">{{ $benefit['title'] ?? '' }}</p>
                        <p class="mt-1 text-slate-300">{{ $benefit['description'] ?? '' }}</p>
                    </li>
                @empty
                    <li>No benefits listed yet.</li>
                @endforelse
            </ul>
        </aside>
    </section>

    @if (!empty($testimonials))
        <section class="border-t border-slate-800 bg-slate-900/30 py-16">
            <div class="mx-auto max-w-7xl px-6">
                <h2 class="text-2xl font-semibold text-white">What Clients Say</h2>
                <div class="mt-8 grid gap-6 md:grid-cols-2">
                    @foreach ($testimonials as $testimonial)
                        <article class="rounded-xl border border-slate-800 bg-slate-900 p-6">
                            <p class="text-slate-200">"{{ $testimonial['quote'] }}"</p>
                            <p class="mt-4 text-xs uppercase tracking-[0.14em] text-orange-300">
                                {{ $testimonial['name'] }}{{ !empty($testimonial['company']) ? ', '.$testimonial['company'] : '' }}
                            </p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
