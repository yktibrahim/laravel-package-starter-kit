<?php

namespace LaravelPackageStarterKit\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

class ExampleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravelpackagestarterkit:example {argument? : Argument description} {--option=default : Option description}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Example console command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $argument = $this->argument('argument') ?? 'default value';
        $option = $this->option('option');
        
        $this->components->info('Example command executed!');
        $this->components->info('Argument: ' . $argument);
        $this->components->info('Option: ' . $option);
        
        if ($this->components->confirm('Do you confirm this operation?', true)) {
            $this->components->info('Operation confirmed and completed successfully.');
            return SymfonyCommand::SUCCESS;
        }
        
        $this->components->warn('Operation cancelled.');
        return SymfonyCommand::FAILURE;
    }
} 