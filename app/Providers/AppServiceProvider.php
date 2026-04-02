<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\AppSettingService;
use App\Services\ThemeService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AppSettingService::class);
        $this->app->singleton(ThemeService::class);
    }

    public function boot(): void
    {
        $this->app->register(ViewServiceProvider::class);
    }
}
