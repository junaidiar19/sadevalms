<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Settings;

use App\Models\AppSetting;
use App\Services\AppSettingService;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin')]
#[Title('App Profile')]
class AppProfile extends Component
{
    use WithFileUploads;

    #[Rule('required|string|max:100')]
    public string $appName = '';

    #[Rule('nullable|string|max:255')]
    public string $appTagline = '';

    #[Rule('nullable|image|max:2048')]
    public $logo = null;

    public ?string $currentLogoUrl = null;

    public function mount(): void
    {
        $this->appName = AppSetting::get('app_name', config('app.name'));
        $this->appTagline = AppSetting::get('app_tagline', '');
        $this->currentLogoUrl = app(AppSettingService::class)->logoUrl();
    }

    public function save(): void
    {
        $this->validate();

        AppSetting::set('app_name', $this->appName);
        AppSetting::set('app_tagline', $this->appTagline);

        if ($this->logo) {
            $record = AppSetting::logoRecord();
            $record->clearMediaCollection('logo');
            $record->addMedia($this->logo->getRealPath())
                ->usingFileName($this->logo->getClientOriginalName())
                ->toMediaCollection('logo');

            $this->currentLogoUrl = $record->getFirstMediaUrl('logo');
            $this->logo = null;
        }

        session()->flash('toast', [
            'type' => 'success',
            'message' => __('settings.profile_saved'),
        ]);

        $this->redirect(route('admin.settings.app-profile'), navigate: true);
    }

    public function removeLogo(): void
    {
        AppSetting::logoRecord()->clearMediaCollection('logo');
        $this->currentLogoUrl = null;

        session()->flash('toast', [
            'type' => 'success',
            'message' => __('settings.profile_saved'),
        ]);
    }

    public function render(): View
    {
        return view('livewire.admin.settings.app-profile');
    }
}
