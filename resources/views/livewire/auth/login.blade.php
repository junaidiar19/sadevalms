<div class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-950 px-4 transition-colors duration-300">
    <div class="w-full max-w-md">

        {{-- Logo / Brand --}}
        <div class="text-center mb-8">
            @if ($logoUrl)
                <img src="{{ $logoUrl }}" alt="{{ $appName }}" class="h-12 mx-auto mb-4 object-contain" />
            @else
                <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-primary-600 shadow-lg shadow-primary-500/20 mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 0 0-.491 6.347A48.627 48.627 0 0 1 12 20.904a48.627 48.627 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.57 50.57 0 0 0-2.658-.813A59.905 59.905 0 0 1 12 3.493a59.902 59.902 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                    </svg>
                </div>
            @endif

            <h1 class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight">{{ $appName }}</h1>
            <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">{{ __('auth.sign_in_to_account') }}</p>
        </div>

        {{-- Card --}}
        <x-ui.card>
            <form wire:submit="login" class="flex flex-col gap-5">

                <x-ui.input
                    id="email"
                    name="email"
                    type="email"
                    wire:model="email"
                    autocomplete="email"
                    placeholder="you@example.com"
                    :label="__('auth.email_address')"
                />

                <x-ui.input
                    id="password"
                    name="password"
                    type="password"
                    wire:model="password"
                    autocomplete="current-password"
                    placeholder="••••••••"
                    :label="__('auth.password')"
                />

                {{-- Remember me --}}
                <div class="flex items-center gap-2">
                    <input
                        id="remember"
                        type="checkbox"
                        wire:model="remember"
                        class="w-4 h-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500 cursor-pointer"
                    />
                    <label for="remember" class="text-sm text-gray-600 dark:text-gray-400 cursor-pointer select-none">
                        {{ __('auth.remember_me') }}
                    </label>
                </div>

                <x-ui.button
                    id="login-submit"
                    type="submit"
                    class="w-full"
                    :loading="false"
                    wire:loading.attr="disabled"
                >
                    <span wire:loading.remove>{{ __('auth.sign_in') }}</span>
                    <svg wire:loading class="animate-spin w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                    </svg>
                    <span wire:loading>{{ __('auth.signing_in') }}</span>
                </x-ui.button>

            </form>
        </x-ui.card>
    </div>
</div>
