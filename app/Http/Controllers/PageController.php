<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        return view('pages.home', [
            'pageTitle' => 'Home',
            'heroHeadline' => 'High-impact cinematic production for brands, artists, and unforgettable moments.',
        ]);
    }

    public function about(): View
    {
        return view('pages.about', [
            'pageTitle' => 'About',
            'heroHeadline' => 'We build cinematic work that balances story, pace, and measurable outcomes.',
        ]);
    }

    public function contact(): View
    {
        return view('pages.contact', [
            'pageTitle' => 'Contact',
            'heroHeadline' => 'Let\'s talk about your next production. We\'re ready when you are.',
        ]);
    }

    public function weddings(): View
    {
        return $this->servicePage('Weddings', 'Cinematic wedding films that preserve emotion, detail, and legacy.');
    }

    public function musicVideos(): View
    {
        return $this->servicePage('Music Videos', 'Bold visual storytelling that amplifies your sound and identity.');
    }

    public function corporate(): View
    {
        return $this->servicePage('Corporate', 'Polished corporate productions for internal comms and public trust.');
    }

    public function contentForBusiness(): View
    {
        return $this->servicePage('Content for Business', 'Strategic short-form and long-form assets for modern business growth.');
    }

    public function voxPops(): View
    {
        return $this->servicePage('Vox Pops', 'Fast-turnaround interview content that captures authentic voices.');
    }

    public function events(): View
    {
        return $this->servicePage('Events', 'Event coverage designed for both memory and marketing impact.');
    }

    private function servicePage(string $title, string $headline): View
    {
        return view('pages.services.' . str($title)->slug('-'), [
            'pageTitle' => $title,
            'heroHeadline' => $headline,
        ]);
    }
}
