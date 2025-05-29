<?php

namespace App\Http\Controllers\second_part;

use Carbon\Carbon;
use App\Models\Plant;
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
        dd($request->all());
        $this->authorize('create_sample_routine_scheduler');
        $data = $request->validate([
            'plant_id' => 'required|exists:plants,id',
            'frequency_id' => 'required|exists:frequencies,id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        SampleRoutineScheduler::create($data);
        return redirect()->route('sample_routine_scheduler.index')->with('success', __('general.created_successfully'));
    }











    public function get_sample_by_plant_id($id)
    {
        $plant = Plant::with('sub_plants.samplePlants')->findOrFail($id);
        $mainSamples = $plant->samplePlants()->with('mainPlant'  , 'sample', 'sample.test_methods', 'sample.test_methods.master_test_method')->select('id', 'name', 'plant_id')->get(); 
        // dd($plant->samplePlants()->with('sample')->first());

        $subPlantSamples = collect();
        foreach ($plant->sub_plants as $subPlant) {
            $subPlantSamples = $subPlantSamples->merge($subPlant->samplePlants()->with('mainPlant' , 'sample' , 'sample.test_methods' , 'sample.test_methods.master_test_method')->select('id', 'name', 'plant_id')->get());
        }
        $allSamples = $mainSamples->merge($subPlantSamples);

        return response()->json([
            'status'      => 200,
            "all_samples" => $allSamples,
        ]);
    }
}
