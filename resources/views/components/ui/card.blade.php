@props([
    'title' => null,
    'padded' => true,
])

<div {{ $attributes->class(['bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden']) }}>
    @if ($title)
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-base font-semibold text-gray-900 dark:text-gray-100">{{ $title }}</h2>
        </div>
    @endif

    <div @class(['p-6' => $padded])>
        {{ $slot }}
    </div>
</div>
