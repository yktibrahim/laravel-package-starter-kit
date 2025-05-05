<?php

namespace LaravelPackageStarterKit\Tests\Feature;

use Orchestra\Testbench\TestCase;
use Illuminate\Testing\TestResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
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
     * Artisan komutu çalıştır.
     *
     * @param string $command
     * @param array $parameters
     * @return int
     */
    public function artisan($command, $parameters = [])
    {
        return $this->app['Illuminate\Contracts\Console\Kernel']->call($command, $parameters);
    }
    
    /**
     * Be kullanıcı olarak işlem yap.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @param string|null $driver
     * @return $this
     */
    public function be($user, $driver = null)
    {
        $this->app['auth']->guard($driver)->setUser($user);
        
        return $this;
    }
    
    /**
     * Başka bir method çağrısı yap.
     *
     * @param string $method
     * @param string $uri
     * @param array $parameters
     * @param array $files
     * @param array $server
     * @param string|null $content
     * @param bool $changeHistory
     * @return \Illuminate\Testing\TestResponse
     */
    public function call($method, $uri, $parameters = [], $files = [], $server = [], $content = null, $changeHistory = true)
    {
        $kernel = $this->app->make('Illuminate\Contracts\Http\Kernel');
        
        $response = $kernel->handle(
            Request::create($uri, $method, $parameters, [], $files, $server, $content)
        );
        
        if ($changeHistory) {
            $this->flushSession();
        }
        
        return $this->createTestResponse($response);
    }
    
    /**
     * Oturumu temizle.
     *
     * @return void
     */
    public function flushSession()
    {
        $this->app['session']->flush();
    }
    
    /**
     * Test yanıtı oluştur.
     *
     * @param  \Illuminate\Http\Response  $response
     * @param  \Illuminate\Http\Request|null  $request
     * @return \Illuminate\Testing\TestResponse
     */
    public function createTestResponse($response, $request = null)
    {
        return TestResponse::fromBaseResponse($response);
    }
    
    /**
     * Seed metodu.
     *
     * @param string $class
     * @return void
     */
    public function seed($class = 'DatabaseSeeder')
    {
        $this->artisan('db:seed', ['--class' => $class]);
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