@props([
    'title',
    'headline',
    'media' => null,
    'video' => null,
    'videoPoster' => null,
    'showreelUrl' => null,
])

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

        @if ($showreelUrl)
            <div class="hero-actions">
                <button type="button" class="btn btn-primary" data-open-showreel-modal>Watch Showreel</button>
            </div>
        @endif
    </div>

    @if ($showreelUrl)
        <div class="showreel-modal" data-showreel-modal hidden>
            <div class="showreel-modal-backdrop" data-close-showreel-modal></div>
            <div class="showreel-modal-dialog" role="dialog" aria-modal="true" aria-label="Future Digital Productions showreel video">
                <button type="button" class="showreel-modal-close" aria-label="Close showreel" data-close-showreel-modal>×</button>
                <div class="showreel-modal-video-wrap">
                    <iframe
                        data-showreel-iframe
                        src=""
                        title="Future Digital Productions showreel"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen
                    ></iframe>
                </div>
            </div>
        </div>

        <script>
            (() => {
                const openButton = document.querySelector('[data-open-showreel-modal]');
                const modal = document.querySelector('[data-showreel-modal]');
                const iframe = document.querySelector('[data-showreel-iframe]');
                const closeButtons = modal ? Array.from(modal.querySelectorAll('[data-close-showreel-modal]')) : [];
                const embedUrl = @json($showreelUrl);

                if (!openButton || !modal || !iframe || !embedUrl) {
                    return;
                }

                const openModal = () => {
                    modal.hidden = false;
                    document.body.classList.add('modal-open');
                    iframe.src = embedUrl;
                };

                const closeModal = () => {
                    modal.hidden = true;
                    document.body.classList.remove('modal-open');
                    iframe.src = '';
                };

                openButton.addEventListener('click', openModal);
                closeButtons.forEach((button) => button.addEventListener('click', closeModal));

                window.addEventListener('keydown', (event) => {
                    if (event.key === 'Escape' && !modal.hidden) {
                        closeModal();
                    }
                });
            })();
        </script>
    @endif
</section>
