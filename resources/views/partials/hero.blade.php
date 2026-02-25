@props(['title', 'headline', 'media' => null])

<section class="hero" style="--hero-media: url('{{ $media ?? 'https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?auto=format&fit=crop&w=2000&q=80' }}');">
    <div class="hero-overlay"></div>
    <div class="container hero-content">
        <p class="hero-title">{{ $title }}</p>
        <h1>{{ $headline }}</h1>
    </div>
</section>
