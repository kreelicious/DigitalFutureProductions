@extends('layouts.site')

@section('content')
    @include('partials.hero', [
        'hero' => ['mediaType' => 'image'],
        'title' => 'Services',
        'headline' => 'Choose a production track that matches your audience and outcome.',
    ])

    <section class="mx-auto max-w-7xl px-6 py-20">
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($services as $service)
                <article class="rounded-xl border border-slate-800 bg-slate-900/60 p-6">
                    <h2 class="text-xl font-semibold text-white">{{ $service['title'] }}</h2>
                    <p class="mt-3 text-sm text-slate-300">{{ $service['summary'] }}</p>
                    <a href="/services/{{ $service['slug'] }}" class="mt-5 inline-block text-xs uppercase tracking-[0.16em] text-orange-300 hover:text-orange-200">
                        View Service
                    </a>
                </article>
            @empty
                <p class="text-slate-300">No services published yet.</p>
            @endforelse
        </div>
    </section>
@endsection
