<?php

namespace IsapOu\AgileCrm;

use Illuminate\Foundation\Console\AboutCommand;
use IsapOu\AgileCrm\Services\AgileCrmClient;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/config.php',
            'agile-crm'
        );
        $this->app->bind('AgileCrm', fn () => new AgileCrmClient);
    }

    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/config.php' => config_path('agile-crm.php'),
        ], 'config');

        AboutCommand::add('Agile CRM', fn () => ['Version' => '1.0.0']);
    }
}
