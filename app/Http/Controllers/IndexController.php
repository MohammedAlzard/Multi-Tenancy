<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(Request $request) {

//        $array = [
//          'app1.multi-tenancy.test' => 'multi_tenancy_app1',
//          'app2.multi-tenancy.test' => 'multi_tenancy_app2',
//        ];
//
//        $host = $request->getHost();
//        $keys = array_keys($array);
//
//        if (in_array($host, $keys)){
//            $db = $array[$host];
//            DB::purge('system');
//            Config::set('database.connections.mysql.database', $db);
//            DB::reconnect('system');
//        }
//        dd($request->getHost());


//        dd(DB::getConnections());
        return DB::table('posts')->get();
        return Tenant::all();
    }
}
