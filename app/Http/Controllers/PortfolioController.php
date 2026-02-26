<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class PortfolioController extends Controller
{
    public function index(): View
    {
        return view('pages.portfolio', [
            'pageTitle' => 'Portfolio',
            'heroHeadline' => 'Selected work across weddings, campaigns, live events, and branded storytelling.',
        ]);
    }
}
