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

        <div class="flex h-screen overflow-hidden">

            {{-- ── Sidebar ─────────────────────────────────────────── --}}
            <aside class="w-64 shrink-0 bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-800 flex flex-col">

                {{-- Brand --}}
                <div class="h-16 flex items-center gap-3 px-5 border-b border-gray-200 dark:border-gray-800 shrink-0">
                    @if ($logoUrl)
                        <img src="{{ $logoUrl }}" alt="{{ $appName }}" class="h-8 object-contain" />
                    @else
                        <div class="w-8 h-8 rounded-lg bg-primary-600 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 0 0-.491 6.347A48.627 48.627 0 0 1 12 20.904a48.627 48.627 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.57 50.57 0 0 0-2.658-.813A59.905 59.905 0 0 1 12 3.493a59.902 59.902 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                            </svg>
                        </div>
                    @endif
                    <span class="font-bold text-gray-900 dark:text-white text-sm leading-tight">{{ $appName }}</span>
                </div>

                {{-- Nav --}}
                <nav class="flex-1 overflow-y-auto py-4 px-3 flex flex-col gap-1">
                    <a
                        href="{{ route('admin.dashboard') }}"
                        @class([
                            'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-150',
                            'bg-primary-50 dark:bg-primary-950/40 text-primary-700 dark:text-primary-300' => request()->routeIs('admin.dashboard'),
                            'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' => ! request()->routeIs('admin.dashboard'),
                        ])
                    >
                        <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                        </svg>
                        {{ __('common.dashboard') }}
                    </a>

                    {{-- Settings group --}}
                    <div class="mt-4 mb-1 px-3">
                        <p class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider">{{ __('common.settings') }}</p>
                    </div>

                    @php
                        $settingsNav = [
                            ['route' => 'admin.settings.app-profile', 'label' => __('settings.app_profile'), 'icon' => 'M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z'],
                            ['route' => 'admin.settings.theme', 'label' => __('settings.color_theme'), 'icon' => 'M4.098 19.902a3.75 3.75 0 0 0 5.304 0l6.401-6.402M6.75 21A3.75 3.75 0 0 1 3 17.25V4.125C3 3.504 3.504 3 4.125 3h5.25c.621 0 1.125.504 1.125 1.125v4.072M6.75 21a3.75 3.75 0 0 0 3.75-3.75V8.197M6.75 21h13.125c.621 0 1.125-.504 1.125-1.125v-5.25c0-.621-.504-1.125-1.125-1.125h-4.072M10.5 8.197l2.88-2.88c.438-.439 1.15-.439 1.59 0l3.712 3.713c.44.44.44 1.152 0 1.59l-2.879 2.88M6.75 17.25h.008v.008H6.75v-.008Z'],
                            ['route' => 'admin.settings.language', 'label' => __('settings.language'), 'icon' => 'm10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802'],
                        ];
                    @endphp

                    @foreach ($settingsNav as $item)
                        <a
                            href="{{ route($item['route']) }}"
                            @class([
                                'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-150',
                                'bg-primary-50 dark:bg-primary-950/40 text-primary-700 dark:text-primary-300' => request()->routeIs($item['route']),
                                'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' => ! request()->routeIs($item['route']),
                            ])
                        >
                            <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}" />
                            </svg>
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </nav>

                {{-- User footer --}}
                <div class="border-t border-gray-200 dark:border-gray-800 p-4 flex items-center gap-3 shrink-0">
                    <x-ui.avatar :name="auth()->user()->name" color="indigo" size="sm" />
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ auth()->user()->email }}</p>
                    </div>
                    <livewire:auth.logout />
                </div>
            </aside>

            {{-- ── Main area ──────────────────────────────────────── --}}
            <div class="flex-1 flex flex-col overflow-hidden">

                {{-- Topbar --}}
                <header class="h-16 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 flex items-center px-6 gap-4 shrink-0">
                    <h1 class="text-lg font-semibold text-gray-900 dark:text-white flex-1">{{ $title ?? __('common.dashboard') }}</h1>

                    {{-- Dark mode toggle --}}
                    <button
                        type="button"
                        @click="dark = !dark; localStorage.setItem('theme', dark ? 'dark' : 'light')"
                        class="w-9 h-9 flex items-center justify-center rounded-lg text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition cursor-pointer"
                        :title="dark ? 'Switch to light mode' : 'Switch to dark mode'"
                    >
                        <svg x-cloak x-show="!dark" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                        </svg>
                        <svg x-cloak x-show="dark" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                        </svg>
                    </button>
                </header>

                {{-- Page content --}}
                <main class="flex-1 overflow-y-auto p-6 bg-gray-50 dark:bg-gray-950">
                    {{ $slot }}
                </main>
            </div>
        </div>

        <x-ui.toast />

        @livewireScripts
    </body>
</html>
