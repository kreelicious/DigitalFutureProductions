@extends('layouts.app')

@section('content')
    @include('partials.hero', ['title' => $pageTitle, 'headline' => $heroHeadline])

    <section class="section container narrow">
        <h2>Contact Details</h2>
        <p><strong>Email:</strong> hello@futuredigitalproductions.com</p>
        <p><strong>Phone:</strong> +44 0000 000000</p>
        <p><strong>Office:</strong> Studio address placeholder, City, Postcode</p>

        <div class="card">
            <h3>Optional Contact Form Placeholder</h3>
            <p>This area can be replaced with a dedicated contact workflow if required.</p>
        </div>
    </section>
@endsection
