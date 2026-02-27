<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $metaTitle ?? ($siteSettings['siteTitle'] ?? config('app.name')) }}</title>
    <meta name="description" content="{{ $metaDescription ?? ($siteSettings['defaultSeo']['metaDescription'] ?? '') }}">
    @php
        $viteHotFile = public_path('hot');
        $viteManifestFile = public_path('build/manifest.json');
        $fallbackCssFile = resource_path('css/app.css');
        $publicCssFile = public_path('css/app.css');
        $publicJsFile = public_path('js/app.js');
        $hasViteAssets = file_exists($viteManifestFile) || file_exists($viteHotFile);
    @endphp

    @if ($hasViteAssets)
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @elseif (file_exists($fallbackCssFile))
        <style>{!! file_get_contents($fallbackCssFile) !!}</style>
    @elseif (file_exists($publicCssFile))
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @endif
</head>
<body class="bg-slate-950 text-slate-100 antialiased">
    @include('partials.nav', ['siteSettings' => $siteSettings ?? null])

    <main>
        @yield('content')
    </main>

    @include('partials.footer', ['siteSettings' => $siteSettings ?? null])

    @if (!$hasViteAssets && file_exists($publicJsFile))
        <script src="{{ asset('js/app.js') }}" defer></script>
    @else
    <script>
        (() => {
            const initNav = () => {
                const nav = document.querySelector('[data-site-nav]');
                const menuButton = document.querySelector('[data-nav-toggle]');
                const mobileMenu = document.querySelector('[data-nav-menu]');
                const initScrollReveal = () => {
                    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
                    const revealTargets = Array.from(document.querySelectorAll('.section, .card, .strip, .cta-block, .hero-content > *'));

                    revealTargets.forEach((element, index) => {
                        if (!element.hasAttribute('data-reveal')) {
                            element.setAttribute('data-reveal', '');
                        }

                        const delay = Math.min((index % 6) * 80, 400);
                        element.style.setProperty('--reveal-delay', `${delay}ms`);
                    });

                    if (prefersReducedMotion || !('IntersectionObserver' in window)) {
                        revealTargets.forEach((element) => {
                            element.classList.add('is-visible');
                        });
                        return;
                    }

                    const observer = new IntersectionObserver((entries, revealObserver) => {
                        entries.forEach((entry) => {
                            if (!entry.isIntersecting) {
                                return;
                            }

                            entry.target.classList.add('is-visible');
                            revealObserver.unobserve(entry.target);
                        });
                    }, {
                        root: null,
                        threshold: 0.15,
                        rootMargin: '0px 0px -8% 0px',
                    });

                    revealTargets.forEach((element) => observer.observe(element));
                };

                if (nav) {
                    const onScroll = () => {
                        const isStuck = window.scrollY > 60;
                        nav.dataset.stuck = isStuck ? 'true' : 'false';
                        nav.classList.toggle('is-stuck', isStuck);
                        nav.classList.toggle('is-at-top', !isStuck);
                        nav.style.backgroundColor = isStuck ? 'rgba(25, 40, 54, 0.98)' : 'transparent';
                        nav.style.boxShadow = isStuck ? '0 10px 24px rgba(0, 0, 0, 0.3)' : 'none';
                        nav.style.backdropFilter = isStuck ? 'saturate(130%) blur(6px)' : 'none';
                    };

                    onScroll();
                    window.addEventListener('scroll', onScroll, { passive: true });
                }

                initScrollReveal();

                if (!menuButton || !mobileMenu) return;

                const setMenuState = (isOpen) => {
                    mobileMenu.dataset.open = isOpen ? 'true' : 'false';
                    menuButton.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                    document.body.classList.toggle('menu-open', isOpen);
                };

                mobileMenu.querySelectorAll('a').forEach((item) => {
                    item.addEventListener('click', () => {
                        setMenuState(false);
                    });
                });

                window.addEventListener('keydown', (event) => {
                    if (event.key === 'Escape' && mobileMenu.dataset.open === 'true') {
                        setMenuState(false);
                    }
                });
            };

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initNav, { once: true });
            } else {
                initNav();
            }
        })();
    </script>
    @endif
</body>
</html>
