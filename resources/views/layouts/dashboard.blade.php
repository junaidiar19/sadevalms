<!DOCTYPE html>
<html
    lang="{{ app()->getLocale() }}"
    x-data="{ dark: localStorage.getItem('theme') === 'dark' }"
    x-bind:class="{ 'dark': dark }"
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

        {{-- Topbar --}}
        <nav class="h-16 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 flex items-center px-6 gap-4">
            {{-- Brand --}}
            <div class="flex items-center gap-3 flex-1">
                @if ($logoUrl)
                    <img src="{{ $logoUrl }}" alt="{{ $appName }}" class="h-7 object-contain" />
                @else
                    <div class="w-7 h-7 rounded-lg bg-primary-600 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 0 0-.491 6.347A48.627 48.627 0 0 1 12 20.904a48.627 48.627 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.57 50.57 0 0 0-2.658-.813A59.905 59.905 0 0 1 12 3.493a59.902 59.902 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                        </svg>
                    </div>
                @endif
                <span class="font-bold text-gray-900 dark:text-white text-sm">{{ $appName }}</span>
            </div>

            {{-- User info + actions --}}
            <div class="flex items-center gap-3">
                <x-ui.avatar :name="auth()->user()->name" color="indigo" size="sm" />
                <div class="hidden sm:block">
                    <p class="text-sm font-medium text-gray-900 dark:text-white leading-tight">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 leading-tight">{{ auth()->user()->email }}</p>
                </div>

                {{-- Dark mode toggle --}}
                <button
                    type="button"
                    @click="dark = !dark; localStorage.setItem('theme', dark ? 'dark' : 'light')"
                    class="w-9 h-9 flex items-center justify-center rounded-lg text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition cursor-pointer"
                >
                    <svg x-show="!dark" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                    </svg>
                    <svg x-show="dark" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                    </svg>
                </button>

                <livewire:auth.logout />
            </div>
        </nav>

        {{-- Content --}}
        <main class="min-h-[calc(100vh-4rem)] p-6 bg-gray-50 dark:bg-gray-950">
            {{ $slot }}
        </main>

        <x-ui.toast />

        @livewireScripts
    </body>
</html>
