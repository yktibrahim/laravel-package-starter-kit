<?php

namespace LaravelPackageStarterKit;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Console\AboutCommand;
use LaravelPackageStarterKit\Console\Commands\SeedCommand;
use LaravelPackageStarterKit\Console\Commands\OptimizeCommand;
use LaravelPackageStarterKit\Console\Commands\ClearOptimizationsCommand;

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
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        'laravel-package-starter-kit' => LaravelPackageStarterKit::class,
    ];

    /**
     * Paket komutları listesi.
     * 
     * @var array
     */
    protected $commands = [
        SeedCommand::class,
        OptimizeCommand::class,
        ClearOptimizationsCommand::class,
    ];

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

        // Komutları kaydet
        $this->commands($this->commands);
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

        // Register commands in console only
        // Komutları sadece konsolda kaydet
        if ($this->app->runningInConsole()) {
            // Register optimize commands
            // Optimize komutlarını kaydet
            $this->optimizes(
                optimize: 'laravelpackagestarterkit:optimize',
                clear: 'laravelpackagestarterkit:clear-optimizations',
            );
            
            // Register the package version with the About command
            // About komutu için paket versiyonunu kaydet
            AboutCommand::add('Laravel Package Starter Kit', fn () => [
                'Version' => '1.0.0', 
                'Laravel Versions' => '12.x',
                'PHP Version' => '8.2+',
                'Commands' => [
                    'laravelpackagestarterkit:seed' => 'Run package seeders',
                    'laravelpackagestarterkit:optimize' => 'Optimize package',
                    'laravelpackagestarterkit:clear-optimizations' => 'Clear package optimizations'
                ]
            ]);
        }
    }
} 