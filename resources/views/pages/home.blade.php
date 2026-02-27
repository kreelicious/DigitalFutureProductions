@extends('layouts.app')

@section('content')
    @include('partials.hero', ['title' => $pageTitle, 'headline' => $heroHeadline, 'video' => asset('video/FDP-hero.mp4')])

    <section class="section container narrow">
        <h2>Broadcast-level filmmaking, produced with speed, precision, and a modern mobile-first approach.</h2>
        <p>Future Digital Productions brings together high-end broadcast experience and agile modern production. Founded by BBC filmmaker Mark Boucher, the company delivers premium-quality video without the traditional overhead of large crews and complex setups.</p>
        <p>Using a streamlined smartphone-first workflow, we produce powerful, story-driven films with exceptional turnaround times — often within 48 hours.</p>
    </section>

    <section class="section container">
        <h2>What We Do</h2>
        @php
            $services = [
                [
                    'title' => 'Weddings',
                    'description' => 'Beautifully crafted wedding films that capture atmosphere, emotion, and story — delivered with care and precision.',
                    'mediaType' => 'video',
                    'mediaSrc' => 'https://player.vimeo.com/external/434045526.sd.mp4?s=86d5fbc5ec9e89be7213f53f74c3e0c79f9f3f57&profile_id=164&oauth2_token_id=57447761',
                    'mediaPoster' => 'https://images.pexels.com/photos/2781104/pexels-photo-2781104.jpeg?auto=compress&cs=tinysrgb&w=1200',
                    'mediaAlt' => 'Wedding couple sharing a quiet cinematic moment',
                ],
                [
                    'title' => 'Music Videos',
                    'description' => 'Visually striking productions designed for impact, energy, and artistic expression.',
                    'mediaType' => 'image',
                    'mediaSrc' => 'https://images.pexels.com/photos/1763075/pexels-photo-1763075.jpeg?auto=compress&cs=tinysrgb&w=1200',
                    'mediaAlt' => 'Performer under concert lighting during a music video shoot',
                ],
                [
                    'title' => 'Corporate Films',
                    'description' => 'Clear, compelling storytelling for brands and organisations that need to communicate with confidence.',
                    'mediaType' => 'image',
                    'mediaSrc' => 'https://images.pexels.com/photos/3183150/pexels-photo-3183150.jpeg?auto=compress&cs=tinysrgb&w=1200',
                    'mediaAlt' => 'Professional team in a modern office discussing strategy',
                ],
                [
                    'title' => 'Content for Business',
                    'description' => 'Fast, professional content built specifically for digital platforms and modern audiences.',
                    'mediaType' => 'video',
                    'mediaSrc' => 'https://player.vimeo.com/external/447812236.sd.mp4?s=2f66f0ec51d8f95c4f5f13f8f0d6be9f64f9d95d&profile_id=165&oauth2_token_id=57447761',
                    'mediaPoster' => 'https://images.pexels.com/photos/4348404/pexels-photo-4348404.jpeg?auto=compress&cs=tinysrgb&w=1200',
                    'mediaAlt' => 'Mobile filming setup capturing vertical social media content',
                ],
                [
                    'title' => 'Vox Pops',
                    'description' => 'Engaging, authentic interview content captured efficiently and delivered at speed.',
                    'mediaType' => 'image',
                    'mediaSrc' => 'https://images.pexels.com/photos/373543/pexels-photo-373543.jpeg?auto=compress&cs=tinysrgb&w=1200',
                    'mediaAlt' => 'Street interview in natural light with camera and microphone',
                ],
                [
                    'title' => 'Events',
                    'description' => 'Dynamic event films that capture key moments, atmosphere, and audience energy — edited quickly for post-event promotion and social sharing.',
                    'mediaType' => 'image',
                    'mediaSrc' => 'https://images.pexels.com/photos/2774556/pexels-photo-2774556.jpeg?auto=compress&cs=tinysrgb&w=1200',
                    'mediaAlt' => 'Conference stage with presenter and engaged audience',
                ],
            ];
        @endphp
        <div class="card-grid six">
            @foreach ($services as $service)
                <article class="card">
                    <div class="card-media">
                        @if ($service['mediaType'] === 'video')
                            <video autoplay muted loop playsinline preload="metadata" poster="{{ $service['mediaPoster'] }}">
                                <source src="{{ $service['mediaSrc'] }}" type="video/mp4">
                            </video>
                        @else
                            <img src="{{ $service['mediaSrc'] }}" alt="{{ $service['mediaAlt'] }}" loading="lazy">
                        @endif
                    </div>
                    <h3>{{ $service['title'] }}</h3>
                    <p>{{ $service['description'] }}</p>
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
