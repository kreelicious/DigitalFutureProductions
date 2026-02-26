<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ ($pageTitle ?? 'Future Digital Productions') . ' | Future Digital Productions' }}</title>
    @php
        $viteManifest = public_path('build/manifest.json');
        $viteHotFile = public_path('hot');
    @endphp

    @if (file_exists($viteManifest) || file_exists($viteHotFile))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body>
    @include('partials.nav')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')
</body>
</html>
