<?php
namespace App\Http\Controllers\part_three;

use App\Http\Controllers\Controller;
use App\Models\COASettings;
use Illuminate\Http\Request;

class COATemplateController extends Controller
{
    public function template_designer( )
    {
        $temp = COASettings::select('id' , 'name' , 'value')->get();
        $data=[
            'temp'  =>$temp,
        ];
        return view('part_three.template_designer.template',$data);
    }
    public function add_template_designer($id = null)
    {
        if(!is_null($id)){
            
        }
        return view('part_three.template_designer.template');
    }

    public function coa_settings(Request $request)
    {
        $data = array_merge([
            'company_logo'                   => 0,
            'company_name'                   => 0,
            'laboratory_accreditation'       => 0,
            'coa_number'                     => 0,
            'lims_number'                    => 0,
            'report_date'                    => 0,

            'sample_plant'                   => 0,
            'sample_subplant'                => 0,
            'sample_point'                   => 0,
            'sample_description'             => 0,
            'batch_lot_number'               => 0,
            'date_received'                  => 0,
            'date_analyzed'                  => 0,
            'date_authorized'                => 0,

            'component_name'                 => 0,
            'specification'                  => 0,
            'test_method'                    => 0,
            'pass_fail_status'               => 0,
            'results'                        => 0,
            'analyst'                        => 0,
            'unit'                           => 0,

            'analyzed_by'                    => 0,
            'authorized_by'                  => 0,
            'digital_signature'              => 0,
            'comments'                       => 0,

            'disclaimer_text'                => 0,
            'laboratory_contact_information' => 0,
            'page_numbers'                   => 0,
        ], $request->only([
            'name',
            'company_logo',
            'company_name',
            'laboratory_accreditation',
            'coa_number',
            'lims_number',
            'report_date',

            'sample_plant',
            'sample_subplant',
            'sample_point',
            'sample_description',
            'batch_lot_number',
            'date_received',
            'date_analyzed',
            'date_authorized',

            'component_name',
            'specification',
            'test_method',
            'pass_fail_status',
            'results',
            'analyst',
            'unit',

            'analyzed_by',
            'authorized_by',
            'digital_signature',
            'comments',

            'disclaimer_text',
            'laboratory_contact_information',
            'page_numbers',
        ]));

        COASettings::create($data);

        return redirect()->back()->with('success', __('general.updated_successfully'));
    }
      public function update_default_status(Request $request)
    {
        dd($request->all());
        $language = COASettings::where('type', 'language')->first();
        $lang_array = [];
        foreach (json_decode($language['value'], true) as $key => $data) {
            if ($data['code'] == $request['code']) {
                $lang = [
                    'id' => $data['id'],
                    'name' => $data['name'],
                    'direction' => $data['direction'] ?? 'ltr',
                    'code' => $data['code'],
                    'status' => 1,
                    'default' => true,
                ];
                $lang_array[] = $lang;
            } else {
                $lang = [
                    'id' => $data['id'],
                    'name' => $data['name'],
                    'direction' => $data['direction'] ?? 'ltr',
                    'code' => $data['code'],
                    'status' => $data['status'],
                    'default' => false,
                ];
                $lang_array[] = $lang;
            }
        }
        COASettings::where('type', 'language')->update([
            'value' => $lang_array
        ]);

        // Toastr::success(translate('Default_Language_Changed'));
        return back();
    }

}
