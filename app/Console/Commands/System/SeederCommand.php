<?php

namespace App\Console\Commands\System;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SeederCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:seeder {class}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $class = $this->argument('class');
//        dd($class);
        $this->info('start seeding LandLord SYSTEM');
        $this->info('----------------------------------');
        Artisan::call('db:seed', [
            '--class' => 'Database\\Seeders\\System\\'.$class,
            '--database' => 'system'
        ]);
        $this->info(Artisan::output());
        return Command::SUCCESS;
    }
}
