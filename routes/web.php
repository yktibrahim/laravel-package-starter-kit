<?php

use Illuminate\Support\Facades\Route;
use LaravelPackageStarterKit\Http\Controllers\LaravelPackageStarterKitController;

/*
|--------------------------------------------------------------------------
| Web Routes
| Web Rotaları
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your package.
| Paketiniz için web rotalarını burada kaydedebilirsiniz.
|
*/

Route::middleware('web')->group(function () {
    Route::get('laravelpackagestarterkit', [LaravelPackageStarterKitController::class, 'index'])->name('laravelpackagestarterkit.index');
}); 