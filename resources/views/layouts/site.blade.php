<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $metaTitle ?? ($siteSettings['siteTitle'] ?? config('app.name')) }}</title>
    <meta name="description" content="{{ $metaDescription ?? ($siteSettings['defaultSeo']['metaDescription'] ?? '') }}">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            :root { color-scheme: dark; }
            * { box-sizing: border-box; }
            body { margin: 0; font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif; background: #020617; color: #e2e8f0; }
            a { color: inherit; text-decoration: none; }
        </style>
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
