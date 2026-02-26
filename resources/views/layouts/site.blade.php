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
    @endphp

    @if (file_exists($viteManifestFile) || file_exists($viteHotFile))
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

    <script>
        (() => {
            const nav = document.querySelector('[data-site-nav]');
            const menuButton = document.querySelector('[data-menu-toggle]');
            const mobileMenu = document.querySelector('[data-mobile-menu]');
            if (!nav) return;

            const onScroll = () => {
                if (window.scrollY > 50) {
                    nav.classList.add('bg-[#192836]', 'shadow-xl');
                    nav.classList.remove('bg-transparent');
                } else {
                    nav.classList.add('bg-transparent');
                    nav.classList.remove('bg-[#192836]', 'shadow-xl');
                }
            };

            onScroll();
            window.addEventListener('scroll', onScroll, { passive: true });

            if (menuButton && mobileMenu) {
                menuButton.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        })();
    </script>
</body>
</html>
