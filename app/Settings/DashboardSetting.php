<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class DashboardSetting extends Settings
{
    public ?string $logo_large_dark;

    public ?string $logo_large_light;

    public ?string $logo_mini_dark;

    public ?string $logo_mini_light;

    public ?string $favicon;

    public ?string $name;

    public ?string $footer;

    public static function group(): string
    {
        return 'dashboard';
    }
}
