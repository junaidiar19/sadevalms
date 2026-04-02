<div class="max-w-2xl flex flex-col gap-6">
    <x-ui.card :title="__('settings.color_theme')">
        <form wire:submit="save" class="flex flex-col gap-6">

            {{-- Preset swatches --}}
            <div class="flex flex-col gap-2">
                <x-ui.label>{{ __('settings.select_preset') }}</x-ui.label>
                <div class="grid grid-cols-3 gap-3">
                    @foreach ($presets as $key => $palette)
                        <button
                            type="button"
                            wire:click="$set('preset', '{{ $key }}')"
                            @class([
                                'relative flex items-center gap-3 px-4 py-3 rounded-xl border text-sm font-medium transition-all duration-150 cursor-pointer',
                                'border-gray-900 dark:border-white ring-2 ring-gray-900/20 dark:ring-white/20' => $preset === $key,
                                'border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:border-gray-300 dark:hover:bg-gray-600' => $preset !== $key,
                            ])
                        >
                            <span
                                class="w-6 h-6 rounded-full shrink-0 ring-1 ring-black/10"
                                style="background-color: {{ $palette['shades']['600'] }}"
                            ></span>
                            <span class="dark:text-gray-200">{{ $palette['name'] }}</span>

                            @if ($preset === $key)
                                <span class="ml-auto">
                                    <svg class="w-4 h-4 text-gray-900 dark:text-white" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                </span>
                            @endif
                        </button>
                    @endforeach

                    {{-- Custom --}}
                    <button
                        type="button"
                        wire:click="$set('preset', 'custom')"
                        @class([
                            'relative flex items-center gap-3 px-4 py-3 rounded-xl border text-sm font-medium transition-all duration-150 cursor-pointer',
                            'border-gray-900 dark:border-white ring-2 ring-gray-900/20 dark:ring-white/20' => $preset === 'custom',
                            'border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:border-gray-300 dark:hover:bg-gray-600' => $preset !== 'custom',
                        ])
                    >
                        <span class="w-6 h-6 rounded-full shrink-0 ring-1 ring-black/10 bg-linear-to-br from-pink-400 via-purple-400 to-blue-400"></span>
                        <span class="dark:text-gray-200">{{ __('settings.custom') }}</span>
                        @if ($preset === 'custom')
                            <span class="ml-auto">
                                <svg class="w-4 h-4 text-gray-900 dark:text-white" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                            </span>
                        @endif
                    </button>
                </div>
            </div>

            {{-- Custom hex input --}}
            @if ($preset === 'custom')
                <div
                    x-data
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 -translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="flex flex-col gap-2"
                >
                    <x-ui.label for="customHex" :required="true">{{ __('settings.custom_hex') }}</x-ui.label>
                    <div class="flex items-center gap-3">
                        <input
                            type="color"
                            id="customHexPicker"
                            wire:model.live="customHex"
                            class="w-10 h-10 rounded-lg cursor-pointer border border-gray-300 dark:border-gray-600 p-0.5 bg-white dark:bg-gray-700"
                        />
                        <input
                            type="text"
                            id="customHex"
                            wire:model.live="customHex"
                            placeholder="#6366f1"
                            maxlength="7"
                            class="flex-1 px-3 py-2 rounded-lg bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500"
                        />
                    </div>
                    <x-ui.form-error name="customHex" />
                </div>
            @endif

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
