<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {  
        $this->migrator->add('dashboard.name',config('app.name'));
        $this->migrator->add('dashboard.logo_large_dark');
        $this->migrator->add('dashboard.logo_large_light');
        $this->migrator->add('dashboard.logo_mini_dark');
        $this->migrator->add('dashboard.logo_mini_light');
        $this->migrator->add('dashboard.favicon');
        $this->migrator->add('dashboard.footer', config('app.name'));
    }
};
