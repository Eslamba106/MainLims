<?php

namespace App\Http\Controllers\admin;

use Throwable;
use Carbon\Carbon;
use App\Models\Tenant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;

class TenantController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request){

    // $this->authorize('tenant_management');


        $ids = $request->bulk_ids;
        $now = Carbon::now()->toDateTimeString();
        if ($request->bulk_action_btn === 'update_status' && $request->status && is_array($ids) && count($ids)) {
            $data = ['status' => $request->status];
            $this->authorize('change_tenants_status');
          
            Tenant::whereIn('id', $ids)->update($data);
            return back()->with('success', __('general.updated_successfully'));
        }  
        if ($request->bulk_action_btn === 'delete' &&  is_array($ids) && count($ids)) {


            Tenant::whereIn('id', $ids)->delete();
            return back()->with('success', __('general.deleted_successfully'));
        }

        $tenants = Tenant::orderBy("created_at","desc")->paginate(10);
        return view("admin.tenant.tenant_list", compact("tenants"  ));
    }
    // public function edit($id){
    //     $this->authorize('edit_driver');
    //     $driver = Driver::findOrFail($id);
    //     $countries = Countries::select('id', 'name' , 'nationality')->get();
    //     $dail_code_main = Countries::select('id', 'dial_code')->get();
    //     return view("general.drivers.edit", compact("driver", "countries" ,'dail_code_main'));
    // }

    public function create(){  

        return view("admin.tenant.create"  );
    }
    public function store(Request $request){
        // $this->authorize('create_driver');
        $request->validate([
            'name' => 'required|string|max:255|unique:tenants,name',
            
        ]);
        // $tenant1 = App\Models\Tenant::create(['id' => 'foo']);
        // >>> $tenant1->domains()->create(['domain' => 'foo.localhost']);
        // DB::beginTransaction();
        // try{

        $tenant = Tenant::create([
            'name' => $request->name,
            'id' => Str::slug($request->name,'_'), 
        ]);
        $host = $request->getHost();
        $tenant->domains()->create(['domain' => Str::slug($request->name,'_').$host]);
        // $user = User::create([
        //     'name' => $request->name,
        //     'user_name' => $request->user_name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        //     'role_name' => 'admin',
        //     'role_id' => 2,
        // ]);
    //     DB::commit();
    //     return redirect()->route('admin.tenant_management')->with('success', __('general.added_successfully')); 
    // } catch (Throwable $e) {
    //     DB::rollBack();
    //     return redirect()->back()->with("error", $e->getMessage()); 
    // }
    }
}
