<div class="max-w-2xl mx-auto flex flex-col gap-6">
    <div class="flex items-center gap-4">
        <x-ui.avatar :name="$user->name" color="amber" size="lg" />
        <div>
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                {{ __('auth.welcome_back', ['name' => $user->name]) }}
            </h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
        </div>
    </div>

    <x-ui.card>
        <div class="text-center py-8">
            <x-ui.badge color="amber">Student</x-ui.badge>
            <p class="text-gray-500 dark:text-gray-400 text-sm mt-3">Your Student dashboard is ready. Content coming soon.</p>
        </div>
    </x-ui.card>
</div>
