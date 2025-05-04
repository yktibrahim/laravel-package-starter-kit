<?php

namespace LaravelPackageStarterKit;

use Illuminate\Support\ServiceProvider;

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
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/Config/laravelpackagestarterkit.php', 'laravelpackagestarterkit'
        );
    }

    /**
     * Bootstrap services.
     * Servisleri başlatır.
     *
     * @return void
     */
    public function boot()
    {
        // Configuration publishing
        // Yapılandırma dosyasını yayınlama
        $this->publishes([
            __DIR__.'/Config/laravelpackagestarterkit.php' => config_path('laravelpackagestarterkit.php'),
        ], 'config');

        // Views
        // Görünümler
        $this->loadViewsFrom(__DIR__.'/Resources/Views', 'laravelpackagestarterkit');
        $this->publishes([
            __DIR__.'/Resources/Views' => resource_path('views/vendor/laravelpackagestarterkit'),
        ], 'views');

        // Translations
        // Çeviriler
        $this->loadTranslationsFrom(__DIR__.'/Resources/Lang', 'laravelpackagestarterkit');
        $this->publishes([
            __DIR__.'/Resources/Lang' => resource_path('lang/vendor/laravelpackagestarterkit'),
        ], 'translations');

        // Routes
        // Rotalar
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

        // Migrations
        // Migrasyonlar
        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
        $this->publishes([
            __DIR__.'/Database/Migrations' => database_path('migrations'),
        ], 'migrations');
    }
} 