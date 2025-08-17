<?php
namespace App\Http\Controllers\part_three;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\part\Unit;
use App\Models\part_three\Result;
use App\Models\part_three\ResultTestMethod;
use App\Models\part_three\ResultTestMethodItem;
use App\Models\Plant;
use App\Models\Sample;
use App\Models\second_part\SampleRoutineScheduler;
use App\Models\second_part\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    public function index(Request $request)
    {
        $ids         = $request->bulk_ids;
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
        $results     = Result::when($request['search'], function ($q) use ($request) {
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
            if ($request->sample_name && ! is_null($request->sample_name)) {
                $report_query->whereHas('plant_sample', function ($q) use ($request) {
                    $q->where('name', 'LIKE', '%' . $request->sample_name . '%');
                });
            }
            if ($request->sample_id && ! is_null($request->sample_id)) {
                $report_query->where('submission_number', $request->sample_id);
            }
            if ($request->plant_id && ! is_null($request->plant_id)) {
                $report_query->where('plant_id', $request->plant_id);
            }
            if ($request->collection_date && ! is_null($request->collection_date)) {
                $report_query->whereDate('sampling_date_and_time', $request->collection_date);
            }
            if ($request->priority && ! is_null($request->priority)) {
                $report_query->where('priority', $request->priority);
            }

            $results = $report_query->where('status', 'pending')->orderBy('created_at', 'desc')->paginate();
        }
        $clients = Client::select('id', 'name')->get();
        $plants  = Plant::select('id', 'name')->get();
        $data    = [
            'results' => $results,
            'search'  => $search,
            'clients' => $clients,
            'plants'  => $plants,
        ];
        return view("part_three.results.result_list", $data);
    }
    public function completed_list(Request $request)
    {
        $ids         = $request->bulk_ids;
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
        $results     = Result::when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('result_no', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })->where('status', '!=', 'pending')->orWhere('status', 'result')
            ->latest()->orderBy('created_at', 'asc')->paginate()->appends($query_param);
        if ($request->bulk_action_btn === 'filter') {
            $report_query = Result::query();
            if ($request->sample_name && ! is_null($request->sample_name)) {
                $report_query->whereHas('plant_sample', function ($q) use ($request) {
                    $q->where('name', 'LIKE', '%' . $request->sample_name . '%');
                });
            }
            if ($request->sample_id && ! is_null($request->sample_id)) {
                $report_query->where('submission_number', $request->sample_id);
            }
            if ($request->plant_id && ! is_null($request->plant_id)) {
                $report_query->where('plant_id', $request->plant_id);
            }
            if ($request->collection_date && ! is_null($request->collection_date)) {
                $report_query->whereDate('sampling_date_and_time', $request->collection_date);
            }
            if ($request->priority && ! is_null($request->priority)) {
                $report_query->where('priority', $request->priority);
            }
            $results = $report_query->where('status', 'completed')->orderBy('created_at', 'desc')->paginate();
        }

        $clients = Client::select('id', 'name')->get();
        $plants  = Plant::select('id', 'name')->get();

        $data = [
            'results' => $results,
            'search'  => $search,
            'clients' => $clients,
            'plants'  => $plants,

        ];
        return view("part_three.results.result_list", $data);
    }
    public function show($id)
    {

        $result = Result::findOrFail($id);
        return view('part_three.results.result_show', compact('result'));
    }
    public function edit($id)
    {
        $units  = Unit::select('id', 'name')->get();
        $sample = Submission::with('plant', 'master_sample', 'sub_plant', 'sample_main', 'sample', 'submission_test_method_items', 'result')->findOrFail($id);

        $recent_results = Result::where('sample_id', $sample->master_sample?->id)->latest()->limit(3)->get();
        return view('part_three.results.edit', compact('sample'));
    }
    public function review($id)
    {
        $result = Result::with('result_test_method', 'result_test_method.result_test_method_child')->whereId($id)->first();

        return view('part_three.results.review', compact('result'));
    }
    public function destroy($id)
    {
        $result = Result::findOrFail($id);
        $result->delete();
        return redirect()->route('admin.result')->with('success', __('general.deleted_successfully'));
    }
    public function create($id, $type)
    {
        $units = Unit::select('id', 'name')->get();
        if ($type == 'submission') {
            $sample = Submission::with('plant', 'master_sample', 'sub_plant', 'sample_main', 'sample', 'submission_test_method_items')->findOrFail($id);
        } elseif ($type == 'schedule') {
            $sample = SampleRoutineScheduler::with('sample', 'plant', 'sub_plant', 'sample_routine_scheduler_items')->findOrFail($id);
        }
        $recent_results = Result::where('sample_id', $sample->master_sample?->id)->latest()->limit(3)->get();
        return view('part_three.results.create', compact('sample', 'units', 'recent_results'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'test_method_items' => 'required|array',
            'sample_id'         => 'required',
            'submission_id'     => 'required',
        ]);
        $sample     = Sample::where('id', $request->sample_id)->first();
        $submission = Submission::where('id', $request->submission_id)->first();
        DB::beginTransaction();
        try {
            $result = Result::where('submission_id', $request->submission_id)->first();
            if (! $result) {
                $result = Result::create([
                    'sample_id'              => $request->sample_id,
                    'submission_id'          => $request->submission_id,
                    'plant_id'               => $sample->plant_id,
                    'sub_plant_id'           => ($sample->sub_plant_id) ? $sample->sub_plant_id : null,
                    'plant_sample_id'        => $sample->plant_sample_id,
                    'priority'               => $submission->priority,
                    'sampling_date_and_time' => $submission->sampling_date_and_time ? $submission->sampling_date_and_time : null,
                    'internal_comment'       => $request->internal_comment,
                    'external_comment'       => $request->external_comment,
                    'submission_number'      => $submission->submission_number,
                    'status'                 => 'pending',
                    'user_id'                => auth()->id() ?? null,
                ]);
            }
            foreach ($request->sample_test_method_id as $test_method_item) {
                $main_test_method    = DB::table('sample_test_methods')->whereId($test_method_item)->first();
                $result_test_methods = ResultTestMethod::firstOrCreate([
                    'test_method_id' => $main_test_method->test_method_id,
                    'result_id'      => $result->id,
                ]);
                foreach ($request->test_method_items as $component) {
                    if ($request->input("result-$component-$main_test_method->test_method_id")) {

                        $component = ResultTestMethodItem::create([
                            'result_test_method_id' => $result_test_methods->id,
                            'result_id'             => $result->id,
                            'result'                => $request->input("result-$component-$main_test_method->test_method_id"),
                            'submission_item'       => $request->input("submission_item-$component-$main_test_method->test_method_id"),
                            'status'                => $request->input(key: "status-$component-$main_test_method->test_method_id") ?? "in_range",
                            'test_method_item_id'   => $component,
                        ]);
                    }
                }
            }
            
            $submissionMaster = Submission::find($request->submission_id);
             $submissionMaster->update([
                    'status' => 'fourth_step',
                ]);
            $allHaveResults   = $submissionMaster->submission_test_method_items->every(function ($item) {
                return $item->result !== null;
            });

            if ($allHaveResults) {
                $submissionMaster->update([
                    'status' => 'fifth_step',
                ]);
            }
            DB::commit();
            return redirect()->route('admin.result')->with('success', __('general.created_successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    public function confirm_results($id)
    {
        $result = Result::with(
            'submission',
            'plant',
            'sub_plant',
            'plant_sample',
            'sample',
            'result_test_method_items',
            'result_test_method_items.test_method',
            'result_test_method_items.result_test_method_items'
        )->findOrFail($id);
        $data = [
            'result' => $result,
        ];
        // dd($result);
        return view('part_three.results.confirm_results', $data);
    }
    public function approve_confirm_results($id)
    {
        $result = Result::findOrFail($id);
        foreach ($result->result_test_method_items as $test_method) {
            foreach ($test_method->result_test_method_items as $result_item) {
                $result_item->update([
                    'acceptance_status' => 'approve',
                ]);
            }
        }
        $result->update([
            'status' => 'approve',
        ]);
        return redirect()->route('admin.result')->with('success', __('results.approve_confirmed_successfully'));
    }
    public function cancel_confirm_results($id)
    {
        $result = Result::findOrFail($id);
        foreach ($result->result_test_method_items as $test_method) {
            foreach ($test_method->result_test_method_items as $result_item) {
                $result_item->update([
                    'acceptance_status' => 'cancel',
                ]);
            }
        }
        $result->update([
            'status' => 'cancel',
        ]);
        return redirect()->route('admin.result')->with('success', __('results.cancel_confirmed_successfully'));
    }
    public function approve_confirm_results_by_item($id)
    {
        $test_method = ResultTestMethod::findOrFail($id);

        foreach ($test_method->result_test_method_items as $result_item) {
            $result_item->update([
                'acceptance_status' => 'approve',
            ]);
        }
        $result        = Result::findOrFail($test_method->result_id);
        $allNotPending = $result->result_test_method_items->every(function ($item) {
            return $item->status !== 'pending';
        });

        if ($allNotPending) {
            $result = Result::findOrFail($test_method->result_id);
            $result->update([
                'status' => 'completed',
            ]);
        }
        return redirect()->back()->with('success', __('results.approve_confirmed_successfully'));
    }
    public function cancel_confirm_results_by_item($id)
    {
        $test_method = ResultTestMethod::findOrFail($id);
        foreach ($test_method->result_test_method_items as $result_item) {
            $result_item->update([
                'acceptance_status' => 'cancel',
            ]);
        }

        return redirect()->back()->with('success', __('results.cancel_confirmed_successfully'));
    }
}
