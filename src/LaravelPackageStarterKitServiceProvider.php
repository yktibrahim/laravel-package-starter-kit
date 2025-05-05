<?php

namespace LaravelPackageStarterKit;

use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use LaravelPackageStarterKit\Console\Commands\SeedCommand;

/**
 * Laravel Package Starter Kit Service Provider
 * Laravel Paket Başlangıç Kiti Servis Sağlayıcısı
 *
 * @author İbrahim Yakut <yktibrahim@gmail.com>
 * @package LaravelPackageStarterKit
 */
class LaravelPackageStarterKitServiceProvider extends BaseServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind the main package class
        $this->app->bind('laravel-package-starter-kit', function () {
            return new LaravelPackageStarterKit();
        });

        // Merge config
        $this->mergeConfigFrom(
            __DIR__.'/Config/laravelpackagestarterkit.php', 'laravelpackagestarterkit'
        );

        // Register commands
        $this->app->singleton(SeedCommand::class, function () {
            return new SeedCommand();
        });

        if ($this->app->runningInConsole()) {
            $this->commands([
                SeedCommand::class,
            ]);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Configuration publishing
        $this->publishes([
            __DIR__.'/Config/laravelpackagestarterkit.php' => config_path('laravelpackagestarterkit.php'),
        ], 'laravelpackagestarterkit-config');

        // Views
        $this->loadViewsFrom(__DIR__.'/Resources/Views', 'laravelpackagestarterkit');
        $this->publishes([
            __DIR__.'/Resources/Views' => resource_path('views/vendor/laravelpackagestarterkit'),
        ], 'laravelpackagestarterkit-views');

        // Translations
        $this->loadTranslationsFrom(__DIR__.'/Resources/Lang', 'laravelpackagestarterkit');
        $this->publishes([
            __DIR__.'/Resources/Lang' => resource_path('lang/vendor/laravelpackagestarterkit'),
        ], 'laravelpackagestarterkit-translations');

        // Routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

        // Migrations
        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
        $this->publishes([
            __DIR__.'/Database/Migrations' => database_path('migrations'),
        ], 'laravelpackagestarterkit-migrations');

        // Seeders & Factories
        $this->publishes([
            __DIR__.'/Database/Seeders' => database_path('seeders'),
        ], 'laravelpackagestarterkit-seeders');
        $this->publishes([
            __DIR__.'/Database/Factories' => database_path('factories'),
        ], 'laravelpackagestarterkit-factories');

        // Register package info
        if ($this->app->runningInConsole()) {
            AboutCommand::add('Laravel Package Starter Kit', fn () => [
                'Version' => '1.0.0', 
                'Laravel Versions' => '12.x',
                'PHP Version' => '8.2+',
                'Commands' => [
                    'laravelpackagestarterkit:seed' => 'Run package seeders'
                ]
            ]);
        }
    }
} 