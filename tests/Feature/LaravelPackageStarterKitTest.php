<?php

namespace LaravelPackageStarterKit\Tests\Feature;

use Orchestra\Testbench\TestCase;
use LaravelPackageStarterKit\LaravelPackageStarterKit;
use LaravelPackageStarterKit\LaravelPackageStarterKitServiceProvider;

class LaravelPackageStarterKitTest extends TestCase
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
        // Setup default database to use sqlite :memory:
        // Varsayılan veritabanını sqlite :memory: kullanacak şekilde ayarla
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);

        // Set up encryption key
        // Şifreleme anahtarını ayarla
        $app['config']->set('app.key', 'base64:'.base64_encode(
            '01234567890123456789012345678901'
        ));
    }

    /**
     * Test the package instance.
     * Paket örneğini test et.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $packageInstance = $this->app->make('laravel-package-starter-kit');
        $this->assertInstanceOf(LaravelPackageStarterKit::class, $packageInstance);
        $this->assertEquals('Laravel Package Starter Kit is working!', $packageInstance->doSomething());
    }
} 