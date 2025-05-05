<?php

namespace LaravelPackageStarterKit\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SeedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravelpackagestarterkit:seed {--class= : The class name of the seeder}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run Laravel Package Starter Kit seeders';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $class = $this->option('class') ?? 'LaravelPackageStarterKitSeeder';
        
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
    }
} 