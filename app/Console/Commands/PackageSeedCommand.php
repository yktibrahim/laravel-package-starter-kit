<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class PackageSeedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:package-seed {--class=LaravelPackageStarterKitSeeder : The class name of the seeder}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run Laravel Package Starter Kit seeders';

    /**
     * Execute the console command.
     */
    public function handle()
    {
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
    }
} 