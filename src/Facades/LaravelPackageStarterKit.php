<?php

namespace LaravelPackageStarterKit\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Laravel Package Starter Kit Facade
 * Laravel Paket Başlangıç Kiti Facade Sınıfı
 *
 * @author İbrahim Yakut <yktibrahim@gmail.com>
 * @package LaravelPackageStarterKit\Facades
 */
class LaravelPackageStarterKit extends Facade
{
    /**
     * Get the registered name of the component.
     * Bileşenin kayıtlı adını al.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravelpackagestarterkit';
    }
} 