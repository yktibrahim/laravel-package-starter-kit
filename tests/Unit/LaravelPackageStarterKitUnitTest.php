<?php

namespace LaravelPackageStarterKit\Tests\Unit;

use Orchestra\Testbench\TestCase;
use LaravelPackageStarterKit\LaravelPackageStarterKitServiceProvider;

class LaravelPackageStarterKitUnitTest extends TestCase
{
    /**
     * Get package providers.
     * Paket sağlayıcılarını al.
     * 
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [LaravelPackageStarterKitServiceProvider::class];
    }

    /**
     * Define environment setup.
     * Çevre kurulumunu tanımla.
     *
     * @param \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Set up encryption key
        // Şifreleme anahtarını ayarla
        $app['config']->set('app.key', 'base64:'.base64_encode(
            '01234567890123456789012345678901'
        ));

        // Set the package configuration
        // Paket yapılandırmasını ayarla
        $app['config']->set('laravelpackagestarterkit.name', 'Laravel Package Starter Kit');
        $app['config']->set('laravelpackagestarterkit.enabled', true);
    }

    /**
     * Test that configuration files are loaded.
     * Yapılandırma dosyalarının yüklendiğini test eder.
     *
     * @return void
     */
    public function testConfigIsLoaded()
    {
        $this->assertEquals('Laravel Package Starter Kit', config('laravelpackagestarterkit.name'));
        $this->assertTrue(config('laravelpackagestarterkit.enabled'));
    }
} 