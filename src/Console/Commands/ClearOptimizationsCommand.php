<?php

namespace LaravelPackageStarterKit\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ClearOptimizationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravelpackagestarterkit:clear-optimizations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear optimizations for Laravel Package Starter Kit';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $this->info('Clearing optimizations for Laravel Package Starter Kit...');
        
        // Burada paketinizin optimize temizleme işlemleri yapılabilir
        // Örneğin: Önbellek temizleme, derlenmiş dosyaların temizlenmesi vb.
        
        $this->info('Laravel Package Starter Kit optimizations cleared successfully!');
        
        return 0;
    }
} 