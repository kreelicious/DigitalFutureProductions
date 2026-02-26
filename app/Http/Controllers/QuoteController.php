<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class QuoteController extends Controller
{
    public function show(): View
    {
        return view('pages.quote', [
            'pageTitle' => 'Get a Quote',
            'heroHeadline' => 'Share your goals and timeline. We\'ll shape a production plan around your brief.',
        ]);
    }

    public function submit(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:120'],
            'phone' => ['required', 'string', 'max:30'],
            'service' => ['required', 'string', 'max:120'],
            'deadline' => ['required', 'string', 'max:120'],
            'description' => ['required', 'string', 'max:3000'],
            'budget' => ['nullable', 'string', 'max:120'],
        ]);

        // Prepared for future Sanity or CRM integration at this submission point.
        return back()->with('quote_success', 'Thanks! Your quote request has been received. We\'ll be in touch soon.');
    }
}
