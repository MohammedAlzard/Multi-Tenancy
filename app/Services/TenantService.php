<?php

namespace App\Services;

use App\Models\Tenant;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Symfony\Component\CssSelector\Exception\ParseException;

class TenantService
{

    private static $tenant;
    private static $domain;
    private static $database;

    public static function switchToTenant(Tenant $tenant)
    {
        if (!$tenant instanceof Tenant) {
            // throw error or tenant class
            throw ValidationException::withMessages(['field_name' => 'this value is instance']);
        }

        //        dd($tenant);
        DB::purge('system');
        DB::purge('tenant');
        Config::set('database.connections.tenant.database', $tenant->database);
//        DB::reconnect('tenant');
        DB::connection('tenant')->reconnect();
        DB::setDefaultConnection('tenant');

        self::$tenant = $tenant;
        self::$domain = $tenant->domain;
        self::$database = $tenant->database;
    }

    public static function switchToDefalut()
    {
        DB::purge('system');
        DB::purge('tenant');
//        Config::set('database.connections.tenant.database', $tenant->database);
//        DB::reconnect('tenant');
        DB::connection('system')->reconnect();
        DB::setDefaultConnection('system');
    }

    public static function getTenant()
    {
        return self::$tenant;
    }
}
