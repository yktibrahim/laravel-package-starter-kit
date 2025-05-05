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
    public function run(): void
    {
        // You can add seeding logic here
        // Example: creating default records
        
        // You can also call other seeders
        // $this->call([
        //     AnotherSeeder::class,
        // ]);
        
        // You can use model factories
        // \LaravelPackageStarterKit\Models\YourModel::factory(10)->create();
        
        // For demonstration only
        echo "LaravelPackageStarterKitSeeder executed!" . PHP_EOL;
    }
} 