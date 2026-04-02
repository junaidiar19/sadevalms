@props([
    'name' => '',
    'color' => 'indigo',
    'size' => 'md',
    'src' => null,
])

@php
    $sizes = [
        'sm' => 'w-7 h-7 text-xs',
        'md' => 'w-9 h-9 text-sm',
        'lg' => 'w-12 h-12 text-base',
    ];

    $colors = [
        'indigo' => 'bg-primary-100 text-primary-700',
        'sky'    => 'bg-sky-100 text-sky-700',
        'green'  => 'bg-green-100 text-green-700',
        'amber'  => 'bg-amber-100 text-amber-700',
        'violet' => 'bg-violet-100 text-violet-700',
    ];

    $initials = collect(explode(' ', $name))
        ->map(fn ($w) => strtoupper(substr($w, 0, 1)))
        ->take(2)
        ->implode('');
@endphp

<div {{ $attributes->class(['rounded-full flex items-center justify-center font-bold shrink-0 overflow-hidden', $sizes[$size] ?? $sizes['md'], $colors[$color] ?? $colors['indigo']]) }}>
    @if ($src)
        <img src="{{ $src }}" alt="{{ $name }}" class="w-full h-full object-cover" />
    @else
        {{ $initials }}
    @endif
</div>
