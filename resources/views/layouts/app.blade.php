<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ ($pageTitle ?? 'Future Digital Productions') . ' | Future Digital Productions' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    @php
        $viteHotFile = public_path('hot');
        $viteManifestFile = public_path('build/manifest.json');
    @endphp

    @if (file_exists($viteHotFile) || file_exists($viteManifestFile))
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
