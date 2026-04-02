<div class="max-w-xl flex flex-col gap-6">

    <x-ui.card :title="__('settings.language_setting')">
        <form wire:submit="save" class="flex flex-col gap-5">

            <div class="flex flex-col gap-1.5">
                <x-ui.label for="locale">{{ __('settings.select_language') }}</x-ui.label>

                <div class="flex gap-3">
                    @foreach ($languages as $code => $label)
                        <button
                            type="button"
                            wire:click="$set('locale', '{{ $code }}')"
                            @class([
                                'flex-1 flex items-center gap-3 px-4 py-3 rounded-xl border text-sm font-medium transition-all duration-150 cursor-pointer',
                                'border-primary-500 bg-primary-50 dark:bg-primary-950/40 text-primary-700 dark:text-primary-300 ring-2 ring-primary-500/20' => $locale === $code,
                                'border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:border-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600' => $locale !== $code,
                            ])
                        >
                            <span class="text-lg leading-none">{{ $code === 'en' ? '🇬🇧' : '🇮🇩' }}</span>
                            <span>{{ $label }}</span>
                        </button>
                    @endforeach
                </div>

                <x-ui.form-error name="locale" />
            </div>

            <div class="flex justify-end">
                <x-ui.button type="submit" wire:loading.target="save" wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="save">{{ __('common.save') }}</span>
                    <svg wire:loading wire:target="save" class="animate-spin w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                    </svg>
                    <span wire:loading wire:target="save">{{ __('common.saving') }}</span>
                </x-ui.button>
            </div>

        </form>
    </x-ui.card>
</div>
