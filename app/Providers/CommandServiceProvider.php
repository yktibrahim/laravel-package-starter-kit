<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Artisan;
use LaravelPackageStarterKit\Console\Commands\SeedCommand;

class CommandServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Register Laravel Package Starter Kit seed command
        if ($this->app->runningInConsole()) {
            $this->commands([
                SeedCommand::class,
            ]);
        }
    }
} 