<?php

namespace LaravelPackageStarterKit\Tests\Feature;

use Orchestra\Testbench\TestCase;
use LaravelPackageStarterKit\LaravelPackageStarterKitServiceProvider;

class LaravelPackageStarterKitTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [LaravelPackageStarterKitServiceProvider::class];
    }

    /**
     * Test the main page route.
     * Ana sayfa route testini gerçekleştirir.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('laravelpackagestarterkit');

        $response->assertStatus(200);
    }
} 