<?php

namespace LaravelPackageStarterKit;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Console\AboutCommand;

/**
 * Laravel Package Starter Kit Service Provider
 * Laravel Paket Başlangıç Kiti Servis Sağlayıcısı
 *
 * @author İbrahim Yakut <yktibrahim@gmail.com>
 * @package LaravelPackageStarterKit
 */
class LaravelPackageStarterKitServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     * Servisleri kayıt eder.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/Config/laravelpackagestarterkit.php', 'laravelpackagestarterkit'
        );

        $this->app->bind('laravel-package-starter-kit', function () {
            return new LaravelPackageStarterKit();
        });
    }

    /**
     * Bootstrap services.
     * Servisleri başlatır.
     *
     * @return void
     */
    public function boot(): void
    {
        // Configuration publishing
        // Yapılandırma dosyasını yayınlama
        $this->publishes([
            __DIR__.'/Config/laravelpackagestarterkit.php' => config_path('laravelpackagestarterkit.php'),
        ], 'laravelpackagestarterkit-config');

        // Views
        // Görünümler
        $this->loadViewsFrom(__DIR__.'/Resources/Views', 'laravelpackagestarterkit');
        $this->publishes([
            __DIR__.'/Resources/Views' => resource_path('views/vendor/laravelpackagestarterkit'),
        ], 'laravelpackagestarterkit-views');

        // Translations
        // Çeviriler
        $this->loadTranslationsFrom(__DIR__.'/Resources/Lang', 'laravelpackagestarterkit');
        $this->publishes([
            __DIR__.'/Resources/Lang' => resource_path('lang/vendor/laravelpackagestarterkit'),
        ], 'laravelpackagestarterkit-translations');

        // Routes
        // Rotalar
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

        // Migrations
        // Migrasyonlar
        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
        $this->publishes([
            __DIR__.'/Database/Migrations' => database_path('migrations'),
        ], 'laravelpackagestarterkit-migrations');

        // Seeders
        // Tohumlayıcılar
        $this->publishes([
            __DIR__.'/Database/Seeders' => database_path('seeders'),
        ], 'laravelpackagestarterkit-seeders');

        // Factories
        // Fabrikalar
        $this->publishes([
            __DIR__.'/Database/Factories' => database_path('factories'),
        ], 'laravelpackagestarterkit-factories');

        // Register Seeders Command
        // Tohumlayıcı Komutunu Kaydet
        if ($this->app->runningInConsole()) {
            $this->commands([
                \LaravelPackageStarterKit\Console\Commands\SeedCommand::class,
            ]);
        }

        // Register the package version with the About command
        // About komutu için paket versiyonunu kaydet
        if ($this->app->runningInConsole()) {
            AboutCommand::add('Laravel Package Starter Kit', fn () => [
                'Version' => '1.0.0', 
                'Laravel Versions' => '12.x'
            ]);
        }
    }
} 