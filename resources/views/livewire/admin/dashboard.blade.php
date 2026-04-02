<div class="flex flex-col gap-6">
    <div class="flex items-center gap-4">
        <x-ui.avatar :name="$user->name" color="indigo" size="lg" />
        <div>
            <h2 class="text-xl font-bold text-gray-900">
                {{ __('auth.welcome_back', ['name' => $user->name]) }}
            </h2>
            <p class="text-sm text-gray-500">{{ $user->email }}</p>
        </div>
    </div>

    <x-ui.card>
        <div class="text-center py-8">
            <x-ui.badge color="sky">Admin</x-ui.badge>
            <p class="text-gray-500 text-sm mt-3">{{ __('common.dashboard') }} — content coming soon.</p>
        </div>
    </x-ui.card>
</div>
