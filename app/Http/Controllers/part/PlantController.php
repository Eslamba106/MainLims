<?php

namespace App\Http\Controllers\part;

use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PlantController extends Controller
{
    public function plant_index(Request $request)
    {
        $plants = Plant::select('id', 'name')->orderBy("created_at", "desc")->paginate(10);
        $data = [
            'main' => $plants,
            'route' => 'plant',
        ];
        return view('part.index', $data);
    }

    public function plant_create()
    {
        $data = [
            'route' => 'plant',
        ];
        return view('part.create', $data);
    }

    public function plant_store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:plants',
        ]);


        $plant = Plant::create([
            'name' => $request->name,
        ]);


        $generalSamples = $request->input('sample_name', []);
        foreach ($generalSamples as $sampleName) {
            $plant->samplePlants()->create([
                'name' => $sampleName,
                'plant_id' => $plant->id,
            ]);
        }

        $subPlantCount = (int) $request->input('sub_plant_count', 0);

        for ($i = 1; $i <= $subPlantCount; $i++) {
            $subPlantName = $request->input("sub_plant_name-$i");
            $subPlant = $plant->sub_plants()->create([
                'name' => $subPlantName,
                'plant_id'  => $plant->id,
            ]);

            $sampleCount = (int) $request->input("sample_counter.$i", 0);
            for ($j = 1; $j <= $sampleCount; $j++) {
                $sampleName = $request->input("sample_name-$i-$j");
                $subPlant->samplePlants()->create([
                    'name' => $sampleName,
                    'plant_id'  => $subPlant->id,
                ]);
            }
        }

        return redirect()->route('admin.plant')->with('success', __('general.added_successfully'));
    }

    public function plant_edit($id)
    {
        $plant = Plant::findOrFail($id);
        $sub_plants = $plant->sub_plants()->with('samplePlants')->get();
        $data = [
            'main' => $plant,
            'route' => 'plant',
            'sub_plants'    => $sub_plants,
        ];
        return view('part.edit', $data);
    }
    public function plant_update(Request $request, $id)
    {
        // dd($request->all());
        // $request->validate([
        //     'name' => 'required|string|max:255|unique:plants,name,' . $id . ',id',
        // ]);
        $plant = Plant::findOrFail($id);

        if ($request->has('sub_plant_name')) {
            foreach ($request->sub_plant_name as $subPlantId => $subPlantName) {
                DB::table('plants')->where('id', $subPlantId)->update([
                    'name' => $subPlantName,
                ]);
            }
        }


        if ($request->has('sample_name')) {
            foreach ($request->sample_name as $sampleId => $sampleName) {
                DB::table('plant_samples')->where('id', $sampleId)->update([
                    'name' => $sampleName,
                ]);
            }
        }
        if ($request->has('sub_plant_name_new')) {
            foreach ($request->sub_plant_name_new as  $subPlantName) {
                $plant = Plant::create([
                    'name' => $subPlantName,
                ]);
            }
        }



        if ($request->has('sample_name_new')) {
            foreach ($request->sample_name_new as  $sampleName) {
                $plant->samplePlants()->create([
                    'name' => $sampleName,
                    'plant_id' => $plant->id,
                ]);
            }
        }





        return redirect()->route('admin.plant')->with('success', __('general.updated_successfully'));
    }
    public function plant_destroy($id)
    {
        $plant = Plant::findOrFail($id);
        $plant->delete();
        return redirect()->route('admin.plant')->with('success', __('general.deleted_successfully'));
    }
    public function delete_sample_from_plant($id)
    {
        $deleted = DB::connection('tenant')->table('plant_samples')->where('id', $id)->delete();

        return response()->json([
            'status'  => 200,
            'success' => $deleted > 0,
        ]);
    }
    public function delete_sub_plant_from_plant($id)
    {
        $plant = Plant::findOrFail($id);
        if ($plant->samplePlants()->count() > 0) {
            $deleted = DB::connection('tenant')->table('plant_samples')->where('id', $id)->delete();
        }
        $main_deleted = DB::connection('tenant')->table('plants')->where('id', $id)->delete();
        return response()->json([
            'status'  => 200,
            'success' => $main_deleted > 0,
        ]);
    }
}
