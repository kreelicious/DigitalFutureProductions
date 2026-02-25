@props(['href' => '#'])
<a href="{{ $href }}" {{ $attributes->merge(['class' => 'btn btn-primary']) }}>{{ $slot }}</a>
