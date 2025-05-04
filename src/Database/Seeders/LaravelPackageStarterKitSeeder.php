<?php

namespace LaravelPackageStarterKit\Database\Seeders;

use Illuminate\Database\Seeder;
use LaravelPackageStarterKit\Models\LaravelPackageStarterKitModel;

class LaravelPackageStarterKitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Veritabanı tohumlamalarını çalıştır.
     *
     * @return void
     */
    public function run()
    {
        LaravelPackageStarterKitModel::create([
            'name' => 'Example Record',
            'description' => 'This is an example description.',
        ]);
    }
} 