<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

$servicePages = [
    'weddings' => [
        'title' => 'Weddings',
        'headline' => 'Cinematic wedding films that preserve emotion, detail, and legacy.',
    ],
    'music-videos' => [
        'title' => 'Music Videos',
        'headline' => 'Bold visual storytelling that amplifies your sound and identity.',
    ],
    'corporate' => [
        'title' => 'Corporate',
        'headline' => 'Polished corporate productions for internal comms and public trust.',
    ],
    'content-for-business' => [
        'title' => 'Content for Business',
        'headline' => 'Strategic short-form and long-form assets for modern business growth.',
    ],
    'vox-pops' => [
        'title' => 'Vox Pops',
        'headline' => 'Fast-turnaround interview content that captures authentic voices.',
    ],
    'events' => [
        'title' => 'Events',
        'headline' => 'Event coverage designed for both memory and marketing impact.',
    ],
];

Route::view('/', 'pages.home', [
    'pageTitle' => 'Home',
    'heroHeadline' => 'High-impact cinematic production for brands, artists, and unforgettable moments.',
]);

Route::view('/about', 'pages.about', [
    'pageTitle' => 'About',
    'heroHeadline' => 'We build cinematic work that balances story, pace, and measurable outcomes.',
]);

Route::view('/portfolio', 'pages.portfolio', [
    'pageTitle' => 'Portfolio',
    'heroHeadline' => 'Selected work across weddings, campaigns, live events, and branded storytelling.',
]);

Route::get('/get-a-quote', function () {
    return view('pages.get-a-quote', [
        'pageTitle' => 'Get a Quote',
        'heroHeadline' => 'Share your goals and timeline. We\'ll shape a production plan around your brief.',
    ]);
});

Route::post('/get-a-quote', function (Request $request) {
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:120'],
        'email' => ['required', 'email', 'max:120'],
        'phone' => ['required', 'string', 'max:30'],
        'service' => ['required', 'string', 'max:120'],
        'deadline' => ['required', 'string', 'max:120'],
        'description' => ['required', 'string', 'max:3000'],
        'budget' => ['nullable', 'string', 'max:120'],
    ]);

    return back()
        ->withInput()
        ->with('quote_success', 'Thanks! Your quote request has been received. We\'ll be in touch soon.')
        ->with('quote_payload', $validated);
});

Route::view('/contact', 'pages.contact', [
    'pageTitle' => 'Contact',
    'heroHeadline' => 'Let\'s talk about your next production. We\'re ready when you are.',
]);

Route::get('/services/{slug}', function (string $slug) use ($servicePages) {
    abort_unless(array_key_exists($slug, $servicePages), 404);

    return view('pages.service', [
        'pageTitle' => $servicePages[$slug]['title'],
        'heroHeadline' => $servicePages[$slug]['headline'],
        'serviceSlug' => $slug,
    ]);
});
