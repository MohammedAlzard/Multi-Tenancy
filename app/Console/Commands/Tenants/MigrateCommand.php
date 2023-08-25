<?php

namespace App\Console\Commands\Tenants;

use App\Models\Tenant;
use App\Services\TenantService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class MigrateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:migrate';

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

        $tenants = Tenant::all();
        $tenants->each(function ($tenant){
//            dd($tenant);
            TenantService::switchToTenant($tenant);
            $this->info('start migrating : ' . $tenant->domain);
            $this->info('----------------------------------');
            Artisan::call('migrate --path=database/migrations/tenant/ --database=tenant');
            $this->info(Artisan::output());
        });

        return Command::SUCCESS;
    }
}
