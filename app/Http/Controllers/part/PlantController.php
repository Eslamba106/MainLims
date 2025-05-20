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
            'name' => 'required|string|max:255',
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
        $request->validate([
            'name' => 'required|string|max:255|unique:plants,name,' . $id . ',id',
        ]);
        $plant = Plant::findOrFail($id);
        $plant->samplePlants()->each(function ($sample) {
            $sample->delete();
        });
        $plant->sub_plants()->each(function ($sub_plant) {
            $sub_plant->samplePlants()->each(function ($sample) {
                $sample->delete();
            });
            $sub_plant->delete();
        });


        $plant->update([
            'name' => $request->name,
        ]);
        if ($request->sample_name_master) {
            foreach ($request->sample_name_master as $key => $sample_name_master_item) {
                $plant->samplePlants()->create([
                    'name' => $sample_name_master_item,
                    'plant_id' => $plant->id,
                ]);
            }
        }
        if ($request->sub_plant_name) {


            foreach ($request->sub_plant_name as $index => $subName) {
                $subPlant = Plant::create([
                    'plant_id' => $plant->id,
                    'name' => $subName,
                ]);
                if (isset($request->sample_name[$index])) {
                    foreach ($request->sample_name[$index] as $sampleName) {
                        $subPlant->samplePlants()->create([
                            'plant_id' => $subPlant->id,
                            'name' => $sampleName,
                        ]);
                    }
                }
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
