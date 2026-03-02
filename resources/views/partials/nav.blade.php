@php
    $navItems = [
        ['label' => 'Home', 'href' => '/'],
        ['label' => 'About', 'href' => '/about'],
        ['label' => 'Portfolio', 'href' => '/portfolio'],
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

<header class="site-nav is-at-top" data-site-nav data-stuck="false">
    <div class="container nav-inner">
        <a class="brand" href="/">
            <img src="{{ asset('images/fdp-logo.png') }}" alt="Future Digital Productions" class="brand-logo">
        </a>
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

            <button type="button" class="nav-submenu-trigger" data-nav-submenu-open aria-expanded="false" aria-controls="mobile-submenu">
                What We Do <span aria-hidden="true">›</span>
            </button>

            @foreach (array_slice($navItems, 2) as $item)
                <a href="{{ $item['href'] }}">{{ $item['label'] }}</a>
            @endforeach

            <a href="/get-a-quote" class="nav-quote-mobile">Get A Quote</a>
        </nav>

    <div class="nav-submenu-panel" id="mobile-submenu" data-nav-submenu data-open="false" role="dialog" aria-label="What We Do">
        <button type="button" class="nav-submenu-back" data-nav-submenu-close aria-label="Back to menu">
            <span aria-hidden="true">‹</span> Back
        </button>
        <p class="nav-submenu-heading">What We Do</p>
        @foreach ($serviceItems as $item)
            <a href="{{ $item['href'] }}">{{ $item['label'] }}</a>
        @endforeach
    </div>

        <a href="/get-a-quote" class="nav-cta">Get A Quote</a>
    </div>
</header>
