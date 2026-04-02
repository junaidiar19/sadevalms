<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\AppSetting;

class AppSettingService
{
    public function name(): string
    {
        return AppSetting::get('app_name', config('app.name'));
    }

    public function tagline(): string
    {
        return AppSetting::get('app_tagline', 'Empowering learning, everywhere.');
    }

    public function locale(): string
    {
        return AppSetting::get('app_locale', config('app.locale', 'en'));
    }

    public function logoUrl(): ?string
    {
        $record = AppSetting::logoRecord();

        if (! $record->hasMedia('logo')) {
            return null;
        }

        return $record->getFirstMediaUrl('logo');
    }
}
