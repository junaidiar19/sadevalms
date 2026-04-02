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
        {{ $slot }}

        <x-ui.toast />

        @livewireScripts
    </body>
</html>
