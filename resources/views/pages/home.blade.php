@extends('layouts.app')

@section('content')
    @include('partials.hero', ['title' => $pageTitle, 'headline' => $heroHeadline])

    <section class="section container narrow">
        <h2>Broadcast-level filmmaking, produced with speed, precision, and a modern mobile-first approach.</h2>
        <p>Future Digital Productions brings together high-end broadcast experience and agile modern production. Founded by BBC filmmaker Mark Boucher, the company delivers premium-quality video without the traditional overhead of large crews and complex setups.</p>
        <p>Using a streamlined smartphone-first workflow, we produce powerful, story-driven films with exceptional turnaround times — often within 48 hours.</p>
    </section>

    <section class="section container">
        <h2>What We Do</h2>
        <div class="card-grid six">
            @foreach (['Weddings', 'Music Videos', 'Corporate Films', 'Content for Business', 'Vox Pops', 'Events'] as $service)
                <article class="card">
                    <div class="card-media" aria-hidden="true"></div>
                    <h3>{{ $service }}</h3>
                    <p>Placeholder summary describing the service offer, expected outcomes, and delivery style.</p>
                </article>
            @endforeach
        </div>
    </section>

    <section class="section container narrow">
        <h2>The Difference</h2>
        <ul class="bullets">
            <li>Story-first approach that balances emotion and strategy.</li>
            <li>Lean production workflows for fast turnarounds.</li>
            <li>Consistent cinematic visual language across channels.</li>
            <li>Collaborative process with transparent communication.</li>
        </ul>
    </section>

    <section class="strip">
        <div class="container narrow">
            <h2>Testimonial</h2>
            <blockquote>“Future Digital Productions turned our brief into a film that felt premium, human, and highly shareable.”</blockquote>
            <p class="muted">— Client Name, Brand / Company</p>
        </div>
    </section>

    <section class="section container narrow cta-block">
        <h2>Ready to bring your next project to life?</h2>
        <p>Tell us your objective, timeline, and creative direction. We’ll respond with a production outline and next steps.</p>
        <x-button href="/get-a-quote">Get a Quote</x-button>
    </section>
@endsection
