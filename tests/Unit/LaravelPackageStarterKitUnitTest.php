<?php

namespace LaravelPackageStarterKit\Tests\Unit;

use Orchestra\Testbench\TestCase;
use LaravelPackageStarterKit\LaravelPackageStarterKitServiceProvider;

class LaravelPackageStarterKitUnitTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [LaravelPackageStarterKitServiceProvider::class];
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
    }
} 