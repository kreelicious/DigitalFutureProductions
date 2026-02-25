@extends('layouts.app')

@section('content')
    @include('partials.hero', ['title' => $pageTitle, 'headline' => $heroHeadline])

    <section class="section container narrow">
        <p>Share your production requirements and we’ll come back with timeline, scope guidance, and next-step recommendations.</p>

        @if (session('quote_success'))
            <div class="alert-success">{{ session('quote_success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert-error">
                <p>Please resolve the following:</p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="quote-form" method="POST" action="/get-a-quote">
            @csrf
            <label>Name
                <input type="text" name="name" value="{{ old('name') }}" required>
            </label>

            <label>Email
                <input type="email" name="email" value="{{ old('email') }}" required>
            </label>

            <label>Phone
                <input type="text" name="phone" value="{{ old('phone') }}" required>
            </label>

            <label>Service
                <input type="text" name="service" value="{{ old('service') }}" required>
            </label>

            <label>Deadline
                <input type="text" name="deadline" value="{{ old('deadline') }}" required>
            </label>

            <label>Description
                <textarea name="description" rows="6" required>{{ old('description') }}</textarea>
            </label>

            <label>Optional Budget
                <input type="text" name="budget" value="{{ old('budget') }}">
            </label>

            <button class="btn btn-primary" type="submit">Submit Quote Request</button>
        </form>
    </section>
@endsection
