<div class="max-w-2xl flex flex-col gap-6">

    <x-ui.card :title="__('settings.app_profile')">
        <form wire:submit="save" class="flex flex-col gap-5">

            {{-- Logo Preview + Upload --}}
            <div class="flex flex-col gap-2">
                <x-ui.label>{{ __('settings.app_logo') }}</x-ui.label>

                <div class="flex items-center gap-4">
                    {{-- Current Logo --}}
                    <div class="w-16 h-16 rounded-xl border border-gray-200 bg-gray-50 flex items-center justify-center overflow-hidden shrink-0">
                        @if ($currentLogoUrl)
                            <img src="{{ $currentLogoUrl }}" alt="Logo" class="w-full h-full object-contain p-1" />
                        @else
                            <div class="w-10 h-10 rounded-lg bg-primary-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-primary-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="logo-upload" class="cursor-pointer">
                            <x-ui.button variant="secondary" size="sm" type="button">
                                {{ $currentLogoUrl ? __('settings.change_logo') : __('settings.upload_logo') }}
                            </x-ui.button>
                        </label>
                        <input
                            id="logo-upload"
                            type="file"
                            wire:model="logo"
                            accept="image/*"
                            class="sr-only"
                        />

                        @if ($currentLogoUrl)
                            <x-ui.button
                                variant="ghost"
                                size="sm"
                                type="button"
                                wire:click="removeLogo"
                            >
                                {{ __('settings.remove_logo') }}
                            </x-ui.button>
                        @endif
                    </div>
                </div>

                <p class="text-xs text-gray-400">{{ __('settings.app_logo_hint') }}</p>
                <x-ui.form-error name="logo" />

                @if ($logo)
                    <div class="flex items-center gap-2 text-xs text-primary-600">
                        <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>
                        Uploading…
                    </div>
                @endif
            </div>

            <x-ui.input
                name="appName"
                wire:model="appName"
                :label="__('settings.app_name')"
                :error="$errors->first('appName')"
            />

            <x-ui.input
                name="appTagline"
                wire:model="appTagline"
                :label="__('settings.app_tagline')"
                :error="$errors->first('appTagline')"
            />

            <div class="flex justify-end">
                <x-ui.button type="submit" wire:loading.attr="disabled">
                    <span wire:loading.remove>{{ __('common.save') }}</span>
                    <svg wire:loading class="animate-spin w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                    </svg>
                    <span wire:loading>{{ __('common.saving') }}</span>
                </x-ui.button>
            </div>

        </form>
    </x-ui.card>
</div>
