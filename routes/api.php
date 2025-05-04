<?php

use Illuminate\Support\Facades\Route;
use LaravelPackageStarterKit\Http\Controllers\Api\LaravelPackageStarterKitApiController;

/*
|--------------------------------------------------------------------------
| API Routes
| API Rotaları
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your package.
| Paketiniz için API rotalarını burada kaydedebilirsiniz.
|
*/

Route::middleware('api')->prefix('api')->group(function () {
    Route::get('laravelpackagestarterkit', [LaravelPackageStarterKitApiController::class, 'index'])->name('api.laravelpackagestarterkit.index');
}); 