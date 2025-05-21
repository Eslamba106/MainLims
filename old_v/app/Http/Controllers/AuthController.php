<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Config;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        try {
            $request->validate([
                'company_id' => 'required',
                'domain'     => 'required',
                'user_name'  => 'required',
                'password'   => 'required',
            ]);
           
            $company = (new Tenant()) 
                ->where('company_id', $request->company_id)
                ->where('domain', $request->domain)
                ->first();     

            if (! $company) {
                return redirect()->back()->with('error', __('login.company_not_found'));
            }

            $dbOptions = json_decode($company->database_options, true);   
            if (! isset($dbOptions['dbname'])) {
                return redirect()->back()->with('error', __('login.database_not_found'));
            }
 
        
            $user = (new User()) 
                ->where('user_name', $request['user_name'])
                ->first();        

            if ($user && Hash::check($request['password'], $user->password)) { 
                auth()->login($user, true);  
                return redirect()->route('dashboard');
            } else {
                return redirect()->back()->with('error', __('login.user_not_found'));
            }

        } catch (\Throwable $th) {
            return redirect()->back()->with("error", $th->getMessage());
        }
    }
  
    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login-page');
    }
    public function admin_login(Request $request)
    {
        // dd($request['user_name']);
        // dd(DB::getDatabaseName());
        if (isset($request['user_name']) && Auth::guard('admins')->attempt(['user_name' => $request->input('user_name'), 'password' => $request->input('password')])) {
           
            return redirect()->route('admin.dashboard');
        } 
        // elseif (isset($request['email']) && Auth::guard('admins')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
        //     return redirect()->route('admin.dashboard');
        // }
    
        return redirect()->back()->with('error', __('login.user_not_found'));
    }
    


    public function admin_logout()
    { 
        Auth::guard('admins')->logout(); 
        return redirect()->route('login-page') ;
    }
 


}
