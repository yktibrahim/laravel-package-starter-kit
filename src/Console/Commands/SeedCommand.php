<?php

namespace LaravelPackageStarterKit\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

class SeedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravelpackagestarterkit:seed {--class=LaravelPackageStarterKitSeeder : The class name of the seeder}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run Laravel Package Starter Kit seeders';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $class = $this->option('class');
        
        $this->components->info('Running seeder: ' . $class);
        
        $params = ['--class' => "Database\\Seeders\\{$class}"];
        
        if ($this->components->confirm('Do you wish to run this seeder?', true)) {
            try {
                $result = Artisan::call('db:seed', $params);
                
                if ($result === 0) {
                    $this->components->info('Seeder run successfully!');
                    return SymfonyCommand::SUCCESS;
                } else {
                    $this->components->error('Seeder failed to run. Make sure the class exists.');
                    return SymfonyCommand::FAILURE;
                }
            } catch (\Exception $e) {
                $this->components->error('Error running seeder: ' . $e->getMessage());
                return SymfonyCommand::FAILURE;
            }
        }
        
        return SymfonyCommand::INVALID;
    }
} 