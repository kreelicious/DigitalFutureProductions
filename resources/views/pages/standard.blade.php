@extends('layouts.site')

@php
    $hero = $page['hero'] ?? [];
    $title = $page['title'] ?? 'Page';
    $headline = $page['headline'] ?? '';
    $blocks = $page['body'] ?? [];
@endphp

@section('content')
    @include('partials.hero', ['hero' => $hero, 'title' => $title, 'headline' => $headline])

    <section class="mx-auto max-w-4xl px-6 py-20">
        <div class="space-y-6 text-lg leading-relaxed text-slate-200">
            @forelse ($blocks as $block)
                @php
                    $text = collect($block['children'] ?? [])->pluck('text')->implode('');
                @endphp
                @if ($text !== '')
                    <p>{{ $text }}</p>
                @endif
            @empty
                <p>Content is coming soon.</p>
            @endforelse
        </div>
    </section>
@endsection
