<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class PharmacySetup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pharmacy:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup the pharmacy application with fresh database and mock seed data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting Pharmacy Application Setup...');
        
        $this->info('Running fresh migrations and database seeders...');
        Artisan::call('migrate:fresh', ['--seed' => true]);
        
        $this->info(Artisan::output());
        
        $this->info('Setup completed successfully!');
        $this->line('Admin Login: admin@pharma.com / admin123');
        $this->line('Customer Login: user@pharma.com / user123');
    }
}
