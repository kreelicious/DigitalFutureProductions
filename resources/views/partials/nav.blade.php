@php
    $navItems = [
        ['label' => 'Home', 'href' => '/'],
        ['label' => 'About', 'href' => '/about'],
        ['label' => 'Portfolio', 'href' => '/portfolio'],
        ['label' => 'Get a Quote', 'href' => '/get-a-quote'],
        ['label' => 'Contact', 'href' => '/contact'],
    ];

    $serviceItems = [
        ['label' => 'Weddings', 'href' => '/services/weddings'],
        ['label' => 'Music Videos', 'href' => '/services/music-videos'],
        ['label' => 'Corporate Content for Business', 'href' => '/services/content-for-business'],
        ['label' => 'Vox Pops', 'href' => '/services/vox-pops'],
        ['label' => 'Events', 'href' => '/services/events'],
    ];
@endphp

<header class="site-nav" data-site-nav data-stuck="false">
    <div class="container nav-inner">
        <a class="brand" href="/">Future Digital Productions</a>
        <button
            class="nav-toggle"
            type="button"
            data-nav-toggle
            aria-label="Toggle navigation"
            aria-expanded="false"
            aria-controls="primary-navigation"
        >
            Menu
        </button>

        <nav class="nav-links" id="primary-navigation" data-nav-menu data-open="false" aria-label="Primary">
            @foreach (array_slice($navItems, 0, 2) as $item)
                <a href="{{ $item['href'] }}">{{ $item['label'] }}</a>
            @endforeach

            <details class="nav-group">
                <summary>What We Do</summary>
                <div class="nav-submenu">
                    @foreach ($serviceItems as $item)
                        <a href="{{ $item['href'] }}">{{ $item['label'] }}</a>
                    @endforeach
                </div>
            </details>

            @foreach (array_slice($navItems, 2) as $item)
                <a href="{{ $item['href'] }}">{{ $item['label'] }}</a>
            @endforeach
        </nav>
    </div>
</header>
