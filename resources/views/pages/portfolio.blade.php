@extends('layouts.app')

@section('content')
    @include('partials.hero', ['title' => $pageTitle, 'headline' => $heroHeadline])

    <section class="section container">
        <p class="narrow">Explore placeholder portfolio categories and project cards. This structure is ready for dynamic filtering and Sanity-powered collections later.</p>

        <div class="filter-placeholder">
            <button type="button">All</button>
            <button type="button">Weddings</button>
            <button type="button">Commercial</button>
            <button type="button">Events</button>
            <button type="button">Music Videos</button>
        </div>

        <div class="card-grid three">
            @for ($i = 1; $i <= 9; $i++)
                <article class="card">
                    <div class="card-media" aria-hidden="true"></div>
                    <h3>Portfolio Item {{ $i }}</h3>
                    <p>Placeholder project summary, category tags, and short context.</p>
                </article>
            @endfor
        </div>
    </section>
@endsection
