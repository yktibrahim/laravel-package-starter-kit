<?php

namespace LaravelPackageStarterKit\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LaravelPackageStarterKitMiddleware
{
    /**
     * Handle an incoming request.
     * Gelen isteği işle.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Continue if package is enabled in configuration
        // Paket yapılandırmasında etkinleştirilmişse devam et
        if (config('laravelpackagestarterkit.enabled')) {
            return $next($request);
        }

        // Return error if package is disabled
        // Paket devre dışı bırakılmışsa hata döndür
        abort(403, 'Package is disabled.');
    }
} 