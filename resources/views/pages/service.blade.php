@extends('layouts.app')

@section('content')
    @include('partials.hero', ['title' => $pageTitle, 'headline' => $heroHeadline])

    <section class="section container narrow">
        <h2>{{ $pageTitle }} Production</h2>
        <p>Placeholder paragraph introducing {{ strtolower($pageTitle) }} services, production style, and ideal project fit.</p>
        <p>Placeholder paragraph covering pre-production, filming approach, and post-production workflow for this service.</p>
        <p>Placeholder paragraph outlining timelines, collaboration model, and expected deliverables.</p>
    </section>

    <section class="section container narrow">
        <h2>Key Benefits</h2>
        <ul class="bullets">
            <li>Benefit placeholder tailored to {{ strtolower($pageTitle) }} deliverables.</li>
            <li>Benefit placeholder focused on audience impact and clarity.</li>
            <li>Benefit placeholder highlighting quality and speed.</li>
            <li>Benefit placeholder emphasizing measurable outcomes.</li>
        </ul>
    </section>

    <section class="section container narrow cta-block">
        <h2>Need {{ strtolower($pageTitle) }} support for an upcoming project?</h2>
        <x-button href="/get-a-quote">Request a Quote</x-button>
    </section>
@endsection
