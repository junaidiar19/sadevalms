<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Settings;

use App\Models\AppSetting;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin')]
#[Title('Language')]
class Language extends Component
{
    /** @var array<string, string> */
    public array $languages = [
        'en' => 'English',
        'id' => 'Indonesian (Bahasa Indonesia)',
    ];

    #[Rule('required|in:en,id')]
    public string $locale = 'en';

    public function mount(): void
    {
        $this->locale = AppSetting::get('app_locale', 'en');
    }

    public function save(): void
    {
        $this->validate();

        AppSetting::set('app_locale', $this->locale);

        session()->put('locale', $this->locale);
        App::setLocale($this->locale);

        session()->flash('toast', [
            'type' => 'success',
            'message' => __('settings.language_saved'),
        ]);

        $this->redirect(route('admin.settings.language'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.settings.language');
    }
}
