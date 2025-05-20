<?php

namespace App\Http\Controllers\admin;

use Throwable;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Tenant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Events\CompanyCreated;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

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
    public function store(Request $request)
    {  
        // dd($request->all());
        $validatedData = $request->validate([
            'name'             => 'required|string|max:255', 
            'tenant_id'         => 'required|integer|unique:tenants,tenant_id',  
            'phone'            => 'nullable|string|max:15', 
            'user_name'        => 'required|string|max:50|unique:users',
            'password'         => 'nullable|string|min:5',  
        ]);
        
        DB::beginTransaction();
        try {

           
            $tenant                                             = Tenant::create([
                'name'                          => $request->name ?? 0,
                'tenant_id'                     => $request->tenant_id ?? 0,
                'domain'                        => $request->tenant_id . '.' . $request->getHost(),
                'user_count'                    => $request->user_count ?? 10, 
                'setup_cost'                    => $request->setup_cost ?? 0, 
                'creation_date'                 => $request->creation_date ?? null,
                'applicable_date'           => $request->tenant_applicable_date ?? null, 
                'status'           => $request->status ?? 'active', 
                'phone'            => $request->phone ?? null, 
                'email'            => $request->email ?? null, 
            ]);
            $user = User::create([
                'name'             => $request->name ?? null,
                'user_name'        => $request->user_name ?? null,
                'password'         => Hash::make($request->password),
                'my_name'          => $request->password,
                'role_name'        => 'admin',
                'role_id'          => 2, 
                'phone'            => $request->phone ?? null, 
                'email'            => $request->email ?? null,

            ]); 
          
            DB::commit();
            event(new CompanyCreated($tenant));
            return redirect()->route('admin.tenant_management')->with("success", __('general.added_successfully'));
        } catch (Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
