@props(['title', 'headline', 'media' => null, 'video' => null, 'videoPoster' => null])

<section class="hero" style="--hero-media: url('{{ $media ?? 'https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?auto=format&fit=crop&w=2000&q=80' }}');">
    @if ($video)
        <video class="hero-video" autoplay muted loop playsinline preload="metadata" @if($videoPoster) poster="{{ $videoPoster }}" @endif>
            <source src="{{ $video }}" type="video/mp4">
        </video>
    @endif
    <div class="hero-overlay"></div>
    <div class="container hero-content">
        <p class="hero-title">{{ $title }}</p>
        <h1>{{ $headline }}</h1>
    </div>
</section>
