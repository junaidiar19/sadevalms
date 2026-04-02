<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\AppSettingService;
use App\Services\ThemeService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        try {
            $settings = $this->app->make(AppSettingService::class);
            $theme = $this->app->make(ThemeService::class);

            View::share('appName', $settings->name());
            View::share('appTagline', $settings->tagline());
            View::share('logoUrl', $settings->logoUrl());
            View::share('themeCss', $theme->themeCss());
        } catch (\Throwable) {
            View::share('appName', config('app.name'));
            View::share('appTagline', '');
            View::share('logoUrl', null);
            View::share('themeCss', '');
        }
    }
}
