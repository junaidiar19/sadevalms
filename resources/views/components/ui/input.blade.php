@props([
    'label' => null,
    'hint' => null,
    'error' => null,
    'id' => null,
    'name' => null,
    'type' => 'text',
])

@php
    $inputId = $id ?? $name ?? $attributes->get('wire:model') ?? $attributes->get('name');
    $hasError = $error || ($errors->has($name ?? $inputId));
    $errorMessage = $error ?? ($errors->first($name ?? $inputId));
@endphp

<div class="flex flex-col gap-1.5">
    @if ($label)
        <label
            for="{{ $inputId }}"
            class="text-sm font-medium text-gray-700 dark:text-gray-300"
        >{{ $label }}</label>
    @endif

    <input
        id="{{ $inputId }}"
        name="{{ $name ?? $inputId }}"
        type="{{ $type }}"
        {{ $attributes->class([
            'w-full px-3 py-2 rounded-lg text-sm transition focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500',
            'bg-white dark:bg-gray-800 border text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500',
            'border-gray-300 dark:border-gray-600' => ! $hasError,
            'border-red-400 ring-1 ring-red-400/30' => $hasError,
        ]) }}
    />

    @if ($hint && ! $hasError)
        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $hint }}</p>
    @endif

    @if ($hasError)
        <p class="text-xs text-red-500">{{ $errorMessage }}</p>
    @endif
</div>
