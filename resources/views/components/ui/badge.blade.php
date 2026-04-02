@props([
    'color' => 'indigo',
])

@php
    $colors = [
        'indigo' => 'bg-primary-50 text-primary-700 border-primary-200',
        'green'  => 'bg-green-50 text-green-700 border-green-200',
        'red'    => 'bg-red-50 text-red-700 border-red-200',
        'amber'  => 'bg-amber-50 text-amber-700 border-amber-200',
        'sky'    => 'bg-sky-50 text-sky-700 border-sky-200',
        'gray'   => 'bg-gray-100 text-gray-700 border-gray-200',
    ];
@endphp

<span {{ $attributes->class(['inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border', $colors[$color] ?? $colors['indigo']]) }}>
    {{ $slot }}
</span>
