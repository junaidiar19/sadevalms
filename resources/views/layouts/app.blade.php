<!DOCTYPE html>
<html
    lang="{{ app()->getLocale() }}"
    x-data="{ dark: localStorage.getItem('theme') === 'dark' }"
    x-bind:class="{ 'dark': dark }"
    x-init="
        if (localStorage.getItem('theme') === null) {
            localStorage.setItem('theme', 'light');
        }
    "
>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ ($title ?? '') ? $title.' — ' : '' }}{{ $appName }}</title>

        @if ($themeCss)
            <style>{!! $themeCss !!}</style>
        @endif

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="antialiased font-sans bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100 transition-colors duration-300">
        
        {{-- Absolute Dark mode toggle --}}
        <div class="absolute top-4 right-6 z-50">
            <button
                type="button"
                @click="dark = !dark; localStorage.setItem('theme', dark ? 'dark' : 'light')"
                class="w-10 h-10 flex items-center justify-center rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition shadow-sm cursor-pointer"
                :title="dark ? 'Switch to light mode' : 'Switch to dark mode'"
            >
                <svg x-cloak x-show="!dark" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                </svg>
                <svg x-cloak x-show="dark" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                </svg>
            </button>
        </div>

        {{ $slot }}

        <x-ui.toast />

        @livewireScripts
    </body>
</html>
