<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Settings;

use App\Models\AppSetting;
use App\Services\ThemeService;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin')]
#[Title('Color Theme')]
class Theme extends Component
{
    #[Rule('required|in:indigo,blue,violet,rose,emerald,custom')]
    public string $preset = 'indigo';

    #[Rule('nullable|regex:/^#[0-9a-fA-F]{6}$/')]
    public ?string $customHex = null;

    /** @var array<string, array{name: string, shades: array<string, string>}> */
    public array $presets = [];

    public function mount(): void
    {
        $this->presets = ThemeService::PRESETS;
        $this->preset = AppSetting::get('theme_preset', 'indigo');
        $this->customHex = AppSetting::get('theme_custom_hex');
    }

    public function save(): void
    {
        $this->validate();

        AppSetting::set('theme_preset', $this->preset);
        AppSetting::set('theme_custom_hex', $this->preset === 'custom' ? $this->customHex : null);

        session()->flash('toast', [
            'type' => 'success',
            'message' => __('settings.theme_saved'),
        ]);

        $this->redirect(route('admin.settings.theme'), navigate: true);
    }

    /** Preview CSS for a given preset/custom hex — used by the blade. */
    public function previewColor(string $preset): string
    {
        if ($preset === 'custom' && $this->customHex) {
            return $this->customHex;
        }

        return ThemeService::PRESETS[$preset]['shades']['600'] ?? '#4f46e5';
    }

    public function render(): View
    {
        return view('livewire.admin.settings.theme');
    }
}
