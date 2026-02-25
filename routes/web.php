<?php

use App\Repositories\SanityRepository;
use App\Services\Sanity;
use Illuminate\Support\Facades\Route;

Route::get('/sanity-test', function (Sanity $sanity) {
    // This works even before you create any schemas/content.
    // It just lists the first 5 document ids.
    $data = $sanity->query('*[defined(_id)][0..4]{_id,_type}');
    return response()->json($data);
});

Route::get('/', function (SanityRepository $repository) {
    return view('pages.home', $repository->homepageBundle());
});

Route::get('/about', function (SanityRepository $repository) {
    $data = [
        'siteSettings' => $repository->siteSettings(),
        'page' => $repository->pageBySlug('about'),
    ];

    abort_if(!$data['page'], 404);

    return view('pages.standard', $data);
});

Route::get('/contact', function (SanityRepository $repository) {
    $data = [
        'siteSettings' => $repository->siteSettings(),
        'page' => $repository->pageBySlug('contact'),
    ];

    abort_if(!$data['page'], 404);

    return view('pages.standard', $data);
});

Route::get('/get-a-quote', function (SanityRepository $repository) {
    $data = [
        'siteSettings' => $repository->siteSettings(),
        'page' => $repository->pageBySlug('get-a-quote'),
    ];

    abort_if(!$data['page'], 404);

    return view('pages.standard', $data);
});

Route::get('/services', function (SanityRepository $repository) {
    return view('services.index', [
        'siteSettings' => $repository->siteSettings(),
        'services' => $repository->services(),
    ]);
});

Route::get('/services/{slug}', function (string $slug, SanityRepository $repository) {
    $service = $repository->serviceBySlug($slug);

    abort_if(!$service, 404);

    return view('services.show', [
        'siteSettings' => $repository->siteSettings(),
        'service' => $service,
        'testimonials' => $repository->testimonials(),
    ]);
});

Route::get('/portfolio', function (SanityRepository $repository) {
    $category = request()->query('category');

    return view('portfolio.index', [
        'siteSettings' => $repository->siteSettings(),
        'categories' => $repository->portfolioCategories(),
        'items' => $repository->portfolioItems(
            is_string($category) && $category !== '' ? $category : null
        ),
        'activeCategory' => is_string($category) && $category !== '' ? $category : null,
    ]);
});

Route::get('/admin/content-health', function (SanityRepository $repository) {
    $health = $repository->contentHealth();

    return response()->json([
        'generatedAt' => now()->toIso8601String(),
        ...$health,
    ]);
});
