<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\AppSetting;
use Illuminate\Database\Seeder;

class AppSettingSeeder extends Seeder
{
    /**
     * @var array<string, string>
     */
    private array $defaults = [
        'app_name' => 'Sadeva LMS',
        'app_tagline' => 'Empowering learning, everywhere.',
        'app_locale' => 'en',
    ];

    public function run(): void
    {
        foreach ($this->defaults as $key => $value) {
            AppSetting::set($key, $value);
        }
    }
}
