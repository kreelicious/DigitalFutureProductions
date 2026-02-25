<footer class="border-t border-slate-800 bg-slate-950">
    <div class="mx-auto flex max-w-7xl flex-col gap-4 px-6 py-10 text-sm text-slate-400 md:flex-row md:items-center md:justify-between">
        <p>{{ $siteSettings['siteTitle'] ?? 'Future Digital Productions' }}</p>
        <div class="flex flex-col gap-1 md:text-right">
            <p>{{ $siteSettings['contactEmail'] ?? 'hello@futuredigitalproductions.com' }}</p>
            <p>{{ $siteSettings['contactPhone'] ?? '' }}</p>
        </div>
    </div>
</footer>
