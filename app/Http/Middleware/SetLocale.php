<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\AppSetting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $locale = $request->session()->get(
                'locale',
                AppSetting::get('app_locale', config('app.locale', 'en'))
            );
        } catch (\Throwable) {
            $locale = config('app.locale', 'en');
        }

        if (in_array($locale, ['en', 'id'], strict: true)) {
            App::setLocale($locale);
        }

        return $next($request);
    }
}
