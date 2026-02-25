@extends('layouts.site')

@php
    $hero = $page['hero'] ?? [];
    $title = $page['title'] ?? 'Home';
    $headline = $page['headline'] ?? 'Cinematic work built for attention and trust.';
@endphp

@section('content')
    @include('partials.hero', ['hero' => $hero, 'title' => $title, 'headline' => $headline])

    <section class="mx-auto max-w-7xl px-6 py-20">
        <div class="max-w-3xl">
            <h2 class="text-2xl font-semibold md:text-3xl">Services</h2>
            <p class="mt-4 text-slate-300">Story-first production for weddings, artists, and brands.</p>
        </div>

        <div class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($services as $service)
                <a href="/services/{{ $service['slug'] }}" class="group rounded-xl border border-slate-800 bg-slate-900/60 p-6 transition hover:-translate-y-1 hover:border-orange-300/50">
                    <p class="text-xs uppercase tracking-[0.15em] text-orange-300">Service</p>
                    <h3 class="mt-3 text-xl font-semibold text-white">{{ $service['title'] }}</h3>
                    <p class="mt-3 text-sm text-slate-300">{{ $service['summary'] }}</p>
                </a>
            @empty
                <p class="text-slate-300">No services published yet.</p>
            @endforelse
        </div>
    </section>

    <section class="bg-slate-900/50 py-20">
        <div class="mx-auto max-w-7xl px-6">
            <h2 class="text-2xl font-semibold md:text-3xl">Featured Testimonials</h2>
            <div class="mt-8 grid gap-6 md:grid-cols-2">
                @forelse ($testimonials as $testimonial)
                    <article class="rounded-xl border border-slate-800 bg-slate-900 p-6">
                        <p class="text-base leading-relaxed text-slate-200">"{{ $testimonial['quote'] }}"</p>
                        <p class="mt-4 text-sm uppercase tracking-[0.12em] text-orange-300">
                            {{ $testimonial['name'] }}{{ !empty($testimonial['company']) ? ', '.$testimonial['company'] : '' }}
                        </p>
                    </article>
                @empty
                    <p class="text-slate-300">No testimonials published yet.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection
