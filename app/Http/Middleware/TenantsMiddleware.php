<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use App\Services\TenantService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class TenantsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost();
        $tenant = Tenant::where('domain', $host)->first();

        // Step 1
        /*if (!empty($tenant)) {
            DB::purge('system');
            Config::set('database.connections.tenant.database', $tenant->database);
//        DB::reconnect('tenant');
            DB::connection('tenant')->reconnect();
            DB::setDefaultConnection('tenant');
        }*/


        // Step 2
//        TenantService::switchToTenant($tenant);

        // Step 3
        if (!empty($tenant)) {
            TenantService::switchToTenant($tenant);
        }else{
            TenantService::switchToDefalut();
        }

        return $next($request);
    }
}
