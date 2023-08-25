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

        /*if (!empty($tenant)) {
            DB::purge('system');
            Config::set('database.connections.tenant.database', $tenant->database);
//        DB::reconnect('tenant');
            DB::connection('tenant')->reconnect();
            DB::setDefaultConnection('tenant');
        }*/

        // Code 2
        TenantService::switchToTenant($tenant);

        return $next($request);
    }
}
