<?php

namespace LaravelPackageStarterKit;

/**
 * Laravel Package Starter Kit ana sınıfı
 *
 * @author İbrahim Yakut <yktibrahim@gmail.com>
 * @package LaravelPackageStarterKit
 */
class LaravelPackageStarterKit
{
    /**
     * Paket versiyonu
     * 
     * @var string
     */
    const VERSION = '1.0.0';

    /**
     * Örnek bir metot
     *
     * @return string
     */
    public function doSomething(): string
    {
        return 'Laravel Package Starter Kit is working!';
    }

    /**
     * Paket versiyonunu döndürür
     * 
     * @return string
     */
    public function getVersion(): string
    {
        return self::VERSION;
    }
} 