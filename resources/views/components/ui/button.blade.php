@props([
    'variant' => 'primary',
    'size' => 'md',
    'loading' => false,
    'type' => 'button',
])

@php
    $baseClasses = 'inline-flex items-center justify-center gap-2 font-semibold rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 cursor-pointer disabled:opacity-60 disabled:cursor-not-allowed';

    $sizes = [
        'sm' => 'px-3 py-1.5 text-xs',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-6 py-2.5 text-base',
    ];

    $variants = [
        'primary'   => 'bg-primary-600 hover:bg-primary-500 text-white shadow-sm shadow-primary-500/20 focus:ring-primary-500 dark:focus:ring-offset-gray-900',
        'secondary' => 'bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 shadow-sm focus:ring-gray-400 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-100 dark:border-gray-600 dark:focus:ring-offset-gray-900',
        'danger'    => 'bg-red-500 hover:bg-red-400 text-white shadow-sm shadow-red-500/20 focus:ring-red-500',
        'ghost'     => 'bg-transparent hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 focus:ring-gray-400 dark:focus:ring-offset-gray-900',
    ];
@endphp

<button
    type="{{ $type }}"
    {{ $attributes->class([$baseClasses, $sizes[$size] ?? $sizes['md'], $variants[$variant] ?? $variants['primary']]) }}
    @if ($loading) disabled @endif
>
    @if ($loading)
        <svg class="animate-spin w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
        </svg>
    @endif

    {{ $slot }}
</button>
