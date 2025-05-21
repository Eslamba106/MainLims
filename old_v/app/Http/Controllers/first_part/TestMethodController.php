<?php

namespace App\Http\Controllers\first_part;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\first_part\TestMethod;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TestMethodController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request){

    $this->authorize('test_method_management');


        $ids = $request->bulk_ids;
        $now = Carbon::now()->toDateTimeString();
        if ($request->bulk_action_btn === 'update_status' && $request->status && is_array($ids) && count($ids)) {
            $data = ['status' => $request->status];
            $this->authorize('change_test_methods_status');
          
            TestMethod::whereIn('id', $ids)->update($data);
            return back()->with('success', __('general.updated_successfully'));
        }  
        if ($request->bulk_action_btn === 'delete' &&  is_array($ids) && count($ids)) {


            TestMethod::whereIn('id', $ids)->delete();
            return back()->with('success', __('general.deleted_successfully'));
        }

        $test_methods = TestMethod::orderBy("created_at","desc")->paginate(10);
        return view("first_part.test_method.test_method_list", compact("test_methods"  ));
    }
}
