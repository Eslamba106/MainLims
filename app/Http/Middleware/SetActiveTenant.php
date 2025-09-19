<?php
namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
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
        $host       = $request->getHost();
        // $mainDomain = 'localhost';
        $mainDomain = 'limsstage.com';
        // dd($host);
        if ($host != $mainDomain) {
            $tenant = Tenant::where('domain', $host)->first();

            if ($tenant) {
                app()->instance('current_tenant', $tenant);
                $db = $tenant->database_options['dbname'] ?? 'lims_' . $tenant->id;
                Config::set('database.connections.tenant.database', $db);
                DB::purge('tenant');
                DB::reconnect('tenant');
                DB::setDefaultConnection('tenant');
            } else {
                return abort(404);
            }

        }
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
