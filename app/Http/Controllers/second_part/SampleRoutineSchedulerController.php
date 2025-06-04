<?php

namespace App\Http\Controllers\second_part;

use Carbon\Carbon;
use App\Models\Plant;
use App\Models\Sample;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\second_part\Frequency;
use App\Models\second_part\SampleRoutineScheduler;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SampleRoutineSchedulerController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request)
    {

        $this->authorize('submission_management');


        $ids = $request->bulk_ids;
        $now = Carbon::now()->toDateTimeString();
        if ($request->bulk_action_btn === 'update_status' && $request->status && is_array($ids) && count($ids)) {
            $data = ['status' => $request->status];
            $this->authorize('change_submissions_status');

            SampleRoutineScheduler::whereIn('id', $ids)->update($data);
            return back()->with('success', __('general.updated_successfully'));
        }
        if ($request->bulk_action_btn === 'delete' &&  is_array($ids) && count($ids)) {


            SampleRoutineScheduler::whereIn('id', $ids)->delete();
            return back()->with('success', __('general.deleted_successfully'));
        }

        $submissions = SampleRoutineScheduler::orderBy("created_at", "desc")->paginate(10);
        return view("second_part.schedule.index", compact("submissions"));
    }
    public function create(Request $request)
    {
        $this->authorize('create_sample_routine_scheduler');
        $plants = Plant::select('id', 'name', 'plant_id')->whereNull('plant_id')->get();
        $frequencies = Frequency::select('id', 'name')->get();
        $data = [
            'plants' => $plants,
            'frequencies' => $frequencies,
        ];

        return  view('second_part.schedule.create', $data);;
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $this->authorize('create_sample_routine_scheduler');
        $request->validate([
            'plant_id' => 'required|exists:plants,id',
            'sub_plant_id' => 'nullable|exists:plants,id',
            'sample_points' => 'required|array',

        ]);

        foreach ($request->sample_points as $index => $sample_point) {
            $sechdeule_routing = SampleRoutineScheduler::create([
                'plant_id' => $request->plant_id,
                'sub_plant_id' => $request->sub_plant_id,
                'sample_id' => $sample_point,
            ]);
            $sechdeule_routing->submission_number = 'SUB-' . str_pad($sechdeule_routing->id, 6, '0', STR_PAD_LEFT);
            $sechdeule_routing->save();
            foreach ($request->test_method_id[$sample_point] as $key => $test_method_id) {
                $schedule_routine_items = $sechdeule_routing->sample_routine_scheduler_items()->create([
                    'sample_id' => $request->sample_points[$index],
                    'plant_id' => $request->plant_id,
                    'sub_plant_id' => $request->sub_plant_id,
                    'frequency_id' => ($request->input("frequency_id-$sample_point-$test_method_id")) ? $request->input("frequency_id-$sample_point-$test_method_id") : null,
                    'schedule_hour' => ($request->input("schedule_hour-$sample_point-$test_method_id")) ? $request->input("frequency_id-$sample_point-$test_method_id") : null,
                    'test_method_ids' => $test_method_id,
                ]);
            }
        }

        return redirect()->route('admin.submission.schedule')->with('success', __('general.created_successfully'));
    }











    public function get_sample_by_plant_id($id)
    {
        $samples = Sample::where('plant_id', $id)->orWhere('sub_plant_id', $id)
            ->with(['test_methods', 'test_methods.master_test_method', 'sample_plant'])
            ->select('id', 'sub_plant_id', 'plant_id', 'plant_sample_id')
            ->get();

        // dd($samples->toArray());
        return response()->json([
            'status'      => 200,
            "all_samples" => $samples,
        ]);
    }
    //     public function get_sample_by_plant_id($id)
    //     {
    //         $plant = Plant::with('sub_plants.samplePlants')->findOrFail($id);
    //         $mainSamples = $plant->samplePlants()->with('mainPlant', 'sample', 'sample.test_methods', 'sample.test_methods.master_test_method')->select('id', 'name', 'plant_id')->get();
    //         // dd($plant->samplePlants()->with('sample')->first());

    //         $subPlantSamples = collect();
    //         foreach ($plant->sub_plants as $subPlant) {
    //             $subPlantSamples = $subPlantSamples->merge($subPlant->samplePlants()->with('mainPlant', 'sample', 'sample.test_methods', 'sample.test_methods.master_test_method')->select('id', 'name', 'plant_id')->get());
    //         }
    //         $allSamples = $mainSamples->merge($subPlantSamples);
    // dd($allSamples->toArray());

    //         return response()->json([
    //             'status'      => 200,
    //             "all_samples" => $allSamples,
    //         ]);
    //     }
}
