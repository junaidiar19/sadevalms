<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? config('app.name') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles
    </head>
    <body class="antialiased font-sans bg-slate-900 text-white">
        {{ $slot }}

        {{-- Toast Notifications --}}
        @if (session('toast'))
            <div
                x-data="{
                    show: false,
                    type: '{{ session('toast.type') }}',
                    message: '{{ session('toast.message') }}',
                    init() {
                        this.$nextTick(() => { this.show = true });
                        setTimeout(() => { this.show = false }, 3500);
                    }
                }"
                x-show="show"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-2"
                class="fixed bottom-6 right-6 z-50 flex items-center gap-3 min-w-64 max-w-sm px-4 py-3 rounded-xl border shadow-2xl backdrop-blur-md"
                :class="{
                    'bg-emerald-500/10 border-emerald-500/20 text-emerald-300': type === 'success',
                    'bg-red-500/10 border-red-500/20 text-red-300': type === 'error',
                    'bg-amber-500/10 border-amber-500/20 text-amber-300': type === 'warning',
                }"
            >
                {{-- Icon --}}
                <div
                    class="shrink-0 flex items-center justify-center w-8 h-8 rounded-lg"
                    :class="{
                        'bg-emerald-500/20': type === 'success',
                        'bg-red-500/20': type === 'error',
                        'bg-amber-500/20': type === 'warning',
                    }"
                >
                    <template x-if="type === 'success'">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                    </template>
                    <template x-if="type === 'error'">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </template>
                    <template x-if="type === 'warning'">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>
                    </template>
                </div>

                {{-- Message --}}
                <p class="text-sm font-medium leading-snug" x-text="message"></p>

                {{-- Close --}}
                <button
                    @click="show = false"
                    class="ml-auto shrink-0 opacity-60 hover:opacity-100 transition cursor-pointer"
                >
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        @livewireScripts
    </body>
</html>
