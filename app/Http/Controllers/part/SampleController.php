<?php

namespace App\Http\Controllers\part;

use Carbon\Carbon;
use App\Models\Plant;
use App\Models\Sample;
use App\Models\SamplePlant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\first_part\TestMethod;
use App\Models\first_part\TestMethodItem;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SampleController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request)
    {

        $this->authorize('sample_management');


        $ids = $request->bulk_ids;
        $now = Carbon::now()->toDateTimeString();
        if ($request->bulk_action_btn === 'update_status' && $request->status && is_array($ids) && count($ids)) {
            $data = ['status' => $request->status];
            $this->authorize('change_samples_status');

            Sample::whereIn('id', $ids)->update($data);
            return back()->with('success', __('general.updated_successfully'));
        }
        if ($request->bulk_action_btn === 'delete' &&  is_array($ids) && count($ids)) {


            Sample::whereIn('id', $ids)->delete();
            return back()->with('success', __('general.deleted_successfully'));
        }

        $samples = Sample::orderBy("created_at", "desc")->paginate(10);
        return view("samples.index", compact("samples"));
    }

    public function create()
    {
        $this->authorize('create_sample');

        $plants = Plant::select('id', 'name', 'plant_id')->with('samplePlants', 'mainPlant', 'sub_plants', 'sub_plants.samplePlants')->get();
        $test_methods = TestMethod::select('id', 'name')->get();
        $data = [
            'plants' => $plants,
            'test_methods' => $test_methods,
        ];
        return view("samples.create", $data);
    }

    public function store(Request $request)
    {
        dd($request->all());
        $this->authorize('create_sample');
        $request->validate([
            'main_plant_item' => 'required',
            'sample_name' => 'required',
        ]);
        $sample = Sample::create([
            'plant_id'  => $request->main_plant_item,
            'sub_plant_id'  => $request->sub_plant_item ?? null,
            'plant_sample_id'  => $request->plant_sample_item,
            'toxic'  => ($request->toxic == 'on') ? 1 : null,
        ]);
        $test_method = TestMethod::select('id')->where('id', $request->test_method)->first();
        if (isset($request->main_components) && $request->main_components == -1) {
            $test_method_items = TestMethodItem::select('id', 'test_method_id')->where('test_method_id', $request->test_method)->get();
            foreach ($test_method_items as $item) {
                $index = $item->id;
                if ($request->has("component-$index")) {
                    DB::table('sample_test_methods')->insert([
                        'test_method_id'        => $item->id,
                        'sample_id'             => $sample->id,
                        'warning_limit'       => $request->input("warning_limit-$index"),
                        'action_limit'        => $request->input("action_limit-$index"),
                        'warning_limit_type'  => $request->input("warning_limit_type-$index"),
                        'action_limit_type'   => $request->input("action_limit_type-$index"),
                    ]);
                }
            }
        }elseif(isset($request->main_components)){
            $test_method_items = TestMethodItem::select('id', 'test_method_id')->where('id' ,$request->main_components )->where('test_method_id', $request->test_method)->first();
                if ($request->has("component-$request->main_components")) {
                    DB::table('sample_test_methods')->insert([
                        'test_method_id'        => $test_method_items->id,
                        'sample_id'             => $sample->id,
                        'warning_limit'       => $request->input("warning_limit-$request->main_components"),
                        'action_limit'        => $request->input("action_limit-$request->main_components"),
                        'warning_limit_type'  => $request->input("warning_limit_type-$request->main_components"),
                        'action_limit_type'   => $request->input("action_limit_type-$request->main_components"),
                    ]);
                }
        }
        // $sample->sample_test_method()->create([
        //     'warning_limit' => $request->warning_limit,
        //     'action_limit' => $request->action_limit,
        //     'action_limit_type' => $request->action_limit_type,
        //     'warning_limit_value' => $request->warning_limit_value,
        // ]);
        return redirect()->route('admin.sample')->with('success', __('general.created_successfully'));
    }

    public function get_sub_from_plant($id)
    {
        $this->authorize('create_sample');
        $plants = Plant::select('id', 'name', 'plant_id')->with('samplePlants', 'mainPlant', 'sub_plants', 'sub_plants.samplePlants')->where('plant_id', $id)->get();
        if ($plants->isEmpty()) {
            $samples = SamplePlant::select('id', 'name', 'plant_id')->where('plant_id', $id)->get();
            return response()->json([
                'status'      => 200,
                "samples" => $samples,
            ]);
        }
        $samples = SamplePlant::select('id', 'name', 'plant_id')->where('plant_id', $id)->get();
        if (!$samples->isEmpty()) {
            return response()->json([
                'status'      => 200,
                "plants" => $plants,
                "samples" => $samples,
            ]);
        }
        return response()->json([
            'status'      => 200,
            "plants" => $plants,
        ]);
    }
    public function get_sample_from_plant($id)
    {
        $this->authorize('create_sample');
        $samples = SamplePlant::select('id', 'name', 'plant_id')->where('plant_id', $id)->get();
        return response()->json([
            'status'      => 200,
            "samples" => $samples,
        ]);
    }
    public function get_components_by_test_method($id)
    {
        $this->authorize('create_sample');
        $components = TestMethodItem::where('test_method_id', $id)->with('main_unit')->get();
        return response()->json([
            'status'      => 200,
            "components" => $components,
        ]);
    }
    public function get_one_component_by_test_method($id)
    {
        $this->authorize('create_sample');
        $component = TestMethodItem::where('id', $id)->with('main_unit')->first();
        return response()->json([
            'status'      => 200,
            "component" => $component,
        ]);
    }
}
