<?php

namespace Database\Seeders\System;

use App\Models\Tenant;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenants = [
            ['name' => 'App1', 'domain' => 'app1.multi-tenancy.test', 'database' => 'multi_tenancy_app1', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['name' => 'App2', 'domain' => 'app2.multi-tenancy.test', 'database' => 'multi_tenancy_app2', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
        ];

        Tenant::insert($tenants);
    }
}
