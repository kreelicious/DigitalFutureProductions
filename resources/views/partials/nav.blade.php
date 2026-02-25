@php
    $navItems = [
        ['label' => 'Home', 'href' => '/'],
        ['label' => 'About', 'href' => '/about'],
        ['label' => 'Weddings', 'href' => '/services/weddings'],
        ['label' => 'Music Videos', 'href' => '/services/music-videos'],
        ['label' => 'Corporate', 'href' => '/services/corporate'],
        ['label' => 'Content for Business', 'href' => '/services/content-for-business'],
        ['label' => 'Vox Pops', 'href' => '/services/vox-pops'],
        ['label' => 'Events', 'href' => '/services/events'],
        ['label' => 'Portfolio', 'href' => '/portfolio'],
        ['label' => 'Get a Quote', 'href' => '/get-a-quote'],
        ['label' => 'Contact', 'href' => '/contact'],
    ];
@endphp

<header class="site-nav" data-site-nav>
    <div class="container nav-inner">
        <a class="brand" href="/">Future Digital Productions</a>
        <button class="nav-toggle" type="button" data-nav-toggle aria-label="Toggle navigation">Menu</button>

        <nav class="nav-links" data-nav-menu>
            @foreach ($navItems as $item)
                <a href="{{ $item['href'] }}">{{ $item['label'] }}</a>
            @endforeach
        </nav>
    </div>
</header>
