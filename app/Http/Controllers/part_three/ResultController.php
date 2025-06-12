<?php

namespace App\Http\Controllers\part_three;

use Carbon\Carbon;
use App\Models\Sample;
use App\Models\part\Unit;
use Illuminate\Http\Request;
use App\Models\part_three\Result;
use App\Http\Controllers\Controller;
use App\Models\second_part\Submission;
use App\Models\second_part\SampleRoutineScheduler;

class ResultController extends Controller
{
      public function index(Request $request)
    {
        // $this->authorize('result');
        $ids     = $request->bulk_ids;
        // $lastRun = Cache::get('last_result_expiry_run');
        // if (! $lastRun || now()->diffInHours($lastRun) >= 24) {
        //     $result_settings = get_business_settings('result')->where('type', 'result_expire_date')->first();
        //     $expiry_days       = $result_settings ? (int) $result_settings->value : 0;
        //     if ($expiry_days > 0) {
        //         expire_unit($expiry_days, 'Proposal', 'ProposalUnits');
        //         Cache::put('last_result_expiry_run', now(), now()->addDay());
        //     }
        // }
        // if ($request->bulk_action_btn === 'update_status' && is_array($ids) && count($ids)) {
        //     $data = ['status' => 1];
        //     (new Proposal())->setConnection('tenant')->whereIn('id', $ids)->update($data);
        //     return back()->with('success', __('general.updated_successfully'));
        // }
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
        $results   = Result::when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('result_no', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })->where('status', 'pending')->orWhere('status', 'result')
            ->latest()->orderBy('created_at', 'asc')->paginate()->appends($query_param);
        if ($request->bulk_action_btn === 'filter') {
            $data         = ['status' => 1];
            $report_query = Result::query();
            if ($request->booking_status && $request->booking_status != -1) {
                $report_query->where('booking_status', $request->booking_status);
            }
            if ($request->status && $request->status != -1) {
                $report_query->where('status', $request->status);
            }
            if ($request->from && $request->to) {
                $startDate = Carbon::createFromFormat('d/m/Y', $request->from)->startOfDay();
                $endDate   = Carbon::createFromFormat('d/m/Y', $request->to)->endOfDay();
                $report_query->whereBetween('created_at', [$startDate, $endDate]);
            }
            $results = $report_query->orderBy('created_at', 'desc')->paginate();
        }
        $data = [
            'results' => $results,
            'search'    => $search,

        ];
        return view("part_three.results.result_list", $data);
    }
    public function show($id)
    {
        
        $result = Result::findOrFail($id);
        return view('part_three.results.result_show', compact('result'));
    }
    public function destroy($id)
    {
        $result = Result::findOrFail($id);
        $result->delete();
        return redirect()->route('part_three.results.index')->with('success', __('general.deleted_successfully'));
    }
    public function create($id , $type)
    {
        $units  = Unit::select('id', 'name')->get();
        if($type == 'submission'){
            $sample = Submission::with('plant','master_sample' , 'sub_plant', 'sample_main', 'sample', 'submission_test_method_items')->findOrFail($id);
        }elseif($type == 'schedule'){
            $sample = SampleRoutineScheduler::with('sample' , 'plant','sub_plant' , 'sample_routine_scheduler_items')->findOrFail($id);
        } 
        return view('part_three.results.create', compact('sample','units'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'test_method_items' => 'required|array',
            'sample_id' => 'required', 
            'submission_id' => 'required',
        ]);
        $sample = Sample::where('id', $request->sample_id)->first();
        $submission = Submission::where('id', $request->submission_id)->first();
                
           dd($request->all());
        $result = Result::create([
            'result_no' => $request->result_no,
            'sample_id' => $request->sample_id,
            'submission_id' => $request->submission_id, 
            'plant_id' => $sample->plant_id,
            'sub_plant_id' => ($sample->sub_plant_id) ? $sample->sub_plant_id : null,
            'plant_sample_id' => $sample->plant_sample_id,
            'priority' => $submission->priority,
            'sampling_date_and_time' => $submission->sampling_date_and_time ?  $submission->sampling_date_and_time  : null,
            'internal_comment' => $request->internal_comment,
            'external_comment' => $request->external_comment,
            'submission_number' => $submission->submission_number,
            'status' => 'pending',
        ]);
        foreach ($request->test_method_items as $test_method_item) {
            $result->result_test_method_items()->create([
                'test_method_item_id' => $test_method_item,
                'unit_id' => $request->input("unit_id-$test_method_item"),
                'result_id' => $request->input("result-$test_method_item"), 
            ]);
        }
        
        return redirect()->route('part_three.results.index')->with('success', __('general.created_successfully'));
    }

}
