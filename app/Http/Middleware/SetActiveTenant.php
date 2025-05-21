<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

class SetActiveTenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $tenant = Tenant::active()->where('domain', $request->getHost())->first();
        // if ($tenant) {
        //     $db = $tenant->database_options['dbname'] ?? 'lims_' . $tenant->id;
        //     Config::set('database.connections.tenant.database', $db);
        //     DB::purge('tenant');
        //     DB::reconnect('tenant');
        //     DB::setDefaultConnection('tenant'); 

        //     app()->instance('tenant', $tenant);
        // }  
        return $next($request);
    }
}
