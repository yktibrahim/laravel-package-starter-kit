<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('package:seed {--class=LaravelPackageStarterKitSeeder}', function () {
    $class = $this->option('class');
    
    $this->info('Running seeder: ' . $class);
    
    $params = ['--class' => "Database\\Seeders\\{$class}"];
    
    if ($this->confirm('Do you wish to run this seeder?', true)) {
        $result = Artisan::call('db:seed', $params);
        
        if ($result === 0) {
            $this->info('Seeder run successfully!');
        } else {
            $this->error('Seeder failed to run. Make sure the class exists.');
        }
    }
})->purpose('Run Laravel Package Starter Kit seeders'); 