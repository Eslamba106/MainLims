<?php

namespace App\Http\Controllers\first_part;

use Carbon\Carbon;
use App\Models\part\Unit;
use Illuminate\Http\Request;
use App\Models\part\ResultType;
use Illuminate\Support\Facades\DB;
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

        $test_methods = TestMethod::select('id' , 'name' , 'status' , 'description')->with('test_method_items')->orderBy("created_at","desc")->paginate(10);
        return view("first_part.test_method.test_method_list", compact("test_methods"  ));
    }
    
    public function create(){
        $this->authorize('create_test_method'); 
        $units = Unit::select('id', 'name')->get();
        $result_types = ResultType::select('id', 'name')->get();
        $data = [
            'units' => $units,
            'result_types' => $result_types,
        ];
        return view("first_part.test_method.create"  ,$data);
    }

    public function store(Request $request){
         
        $this->authorize('create_test_method'); 
        $request->validate([
            'name' => 'required|string|max:255', 
            'description' => 'nullable|string|max:1000',
            'item_name' => 'required|array',
            'item_name.*' => 'required|string|max:255',
            'unit' => 'required|array',
            'unit.*' => 'required|string|max:255',
            'result_type' => 'required|array',
            'result_type.*' => 'required|string|max:255',
        ]);
        
        DB::beginTransaction();
        try {
            $test_method = TestMethod::create([
                'name' => $request->name,
                'description' => $request->description,
               
            ]);
            foreach($request->item_name as $index => $test_method_item){
                $test_method->test_method_items()->create([
                    'name' => $test_method_item,
                    'unit' =>  isset($request->unit[$index]) ? $request->unit[$index] : null,
                    'result_type' =>  isset($request->result_type[$index]) ? $request->result_type[$index] : null,
                    'precision' =>  isset($request->precision[$index]) ? $request->precision[$index] : null,
                    'lower_range' =>  isset($request->lower_range[$index]) ? $request->lower_range[$index] : null,
                    'upper_range' =>  isset($request->upper_range[$index]) ? $request->upper_range[$index] : null,
                    'reportable' => isset($request->reportable[$index]) ? $request->reportable[$index] : null,
                ]);
            }
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', __('general.something_went_wrong'));
        }
        
        return redirect()->route('admin.test_method')->with('success', __('general.created_successfully'));
    }
}
