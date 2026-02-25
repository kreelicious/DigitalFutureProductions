@php
    $navItems = $siteSettings['primaryNavigation'] ?? [
        ['label' => 'Home', 'href' => '/'],
        ['label' => 'About', 'href' => '/about'],
        ['label' => 'Services', 'href' => '/services'],
        ['label' => 'Portfolio', 'href' => '/portfolio'],
        ['label' => 'Get a Quote', 'href' => '/get-a-quote'],
        ['label' => 'Contact', 'href' => '/contact'],
    ];
@endphp

<header data-site-nav class="fixed inset-x-0 top-0 z-50 bg-transparent transition-all duration-200">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
        <a href="/" class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-100">
            {{ $siteSettings['siteTitle'] ?? 'Future Digital Productions' }}
        </a>

        <button type="button" data-menu-toggle class="rounded-md border border-slate-500/40 px-3 py-2 text-xs uppercase tracking-[0.15em] md:hidden">
            Menu
        </button>

        <nav class="hidden md:block">
            <ul class="flex items-center gap-6 text-xs uppercase tracking-[0.18em]">
                @foreach ($navItems as $item)
                    <li>
                        <a href="{{ $item['href'] ?? '/' }}" class="text-slate-200 transition hover:text-white">
                            {{ $item['label'] ?? 'Link' }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>

    <div data-mobile-menu class="hidden border-t border-slate-700/60 bg-[#192836] px-6 pb-4 pt-2 md:hidden">
        <ul class="space-y-3 text-xs uppercase tracking-[0.15em]">
            @foreach ($navItems as $item)
                <li>
                    <a href="{{ $item['href'] ?? '/' }}" class="block py-1 text-slate-200 transition hover:text-white">
                        {{ $item['label'] ?? 'Link' }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</header>
