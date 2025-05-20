<?php

namespace App\Http\Controllers\part;

use App\Models\part\Unit;
use Illuminate\Http\Request;
use App\Models\part\ResultType;
use App\Http\Controllers\Controller;

class GeneralController extends Controller
{
    public function unit_index(Request $request)
    {
        $units = Unit::select('id', 'name' )->orderBy("created_at", "desc")->paginate(10);
        $data = [
            'main' => $units,
            'route' => 'unit',
        ];
        return view('part.index' , $data);
    }

    public function unit_create()
    {
        $data = [
            'route' => 'unit',
        ];
        return view('part.create' , $data);
    }

    public function unit_store(Request $request)
    { 
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $unit = Unit::create([
            'name' => $request->name,
        ]);
        return redirect()->route('admin.unit')->with('success', __('general.added_successfully'));
    }
    public function unit_edit($id)
    {
        $unit = Unit::findOrFail($id); 
        $data = [
            'main' => $unit,
            'route' => 'unit',
        ];
        return view('part.edit', $data);
    }
    public function unit_update(Request $request, $id)
    {
        $unit = Unit::findOrFail($id);
       
        $request->validate([
            'name' => 'required|string|max:255|unique:units,name,'.$id.',id',
        ]);
        $unit->update([
            'name' => $request->name,
        ]);
        return redirect()->route('admin.unit')->with('success', __('general.updated_successfully'));
    }
    public function unit_destroy($id)
    {
        $unit = Unit::findOrFail($id);
        $unit->delete();
        return redirect()->route('admin.unit')->with('success', __('general.deleted_successfully'));
    }
    public function result_type_index(Request $request)
    {
        $result_types = ResultType::select('id', 'name' )->orderBy("created_at", "desc")->paginate(10);
        $data = [
            'main' => $result_types,
            'route' => 'result_type',
        ];
        return view('part.index' , $data);
    }

    public function result_type_create()
    {
        $data = [
            'route' => 'result_type',
        ];
        return view('part.create' , $data);
    }

    public function result_type_store(Request $request)
    { 
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $result_type = ResultType::create([
            'name' => $request->name,
        ]);
        return redirect()->route('admin.result_type')->with('success', __('general.added_successfully'));
    }
    public function result_type_edit($id)
    {
        $result_type = ResultType::findOrFail($id); 
        $data = [
            'main' => $result_type,
            'route' => 'result_type',
        ];
        return view('part.edit', $data);
    }
    public function result_type_update(Request $request, $id)
    {
        $result_type = ResultType::findOrFail($id);
       
        $request->validate([
            'name' => 'required|string|max:255|unique:result_types,name,'.$id.',id',
        ]);
        $result_type->update([
            'name' => $request->name,
        ]);
        return redirect()->route('admin.result_type')->with('success', __('general.updated_successfully'));
    }
    public function result_type_destroy($id)
    {
        $result_type = ResultType::findOrFail($id);
        $result_type->delete();
        return redirect()->route('admin.result_type')->with('success', __('general.deleted_successfully'));
    }
}
