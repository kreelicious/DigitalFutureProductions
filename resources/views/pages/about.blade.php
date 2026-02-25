@extends('layouts.app')

@section('content')
    @include('partials.hero', ['title' => $pageTitle, 'headline' => $heroHeadline])

    <section class="section container narrow">
        <h2>About Future Digital Productions</h2>
        <p>We are a compact team focused on cinematic craft, practical execution, and content that performs in the real world.</p>
        <p>This page is a skeleton placeholder for future Sanity-managed story blocks, founder profiles, and process content.</p>
    </section>
@endsection
