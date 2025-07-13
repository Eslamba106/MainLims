<?php
namespace App\Http\Controllers\part_three;

use App\Models\COASettings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class COATemplateController extends Controller
{
    public function template_designer()
    {
        $temp = COASettings::select('id', 'name', 'value')->get();
        $data = [
            'temp' => $temp,
        ];
        return view('part_three.template_designer.template', $data);
    }
    public function add_template_designer()
    {
        // $temp = null;
        // if(!is_null($id)){
        //     $temp = COASettings::select('id' , 'name' , 'value')->find($id);
        // }
        // $data = [
        //     'temp'      => $temp,
        // ];
        // dd($temp);
        return view('part_three.template_designer.add-template');
    }
    public function edit_template_designer($id)
    {
        // $temp = null;
        if(!is_null($id)){
            $temp = COASettings::find($id);
        }
        $data = [
            'temp'      => $temp,
        ];
        // dd($temp);
        return view('part_three.template_designer.edit-template' , $data);
    }

    public function coa_settings(Request $request)
    {
 
        $data = array_merge([
             'header_information'             => 0,
            'sample_information'             => 0,
            'test_results'                   => 0,
            'footer_information'             => 0,
            'authorization'                  => 0,

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
              'header_information'   ,
            'sample_information'   ,
            'test_results'         ,
            'footer_information'   ,
            'authorization'        ,
            
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

        return to_route('admin.template_designer')->with('success', __('general.updated_successfully'));
    }
    public function coa_settings_update(Request $request , $id)
    {
        $temp = COASettings::findOrFail($id);
        // dd($request->all());
        $data = array_merge([
            'header_information'             => 0,
            'sample_information'             => 0,
            'test_results'                   => 0,
            'footer_information'             => 0,
            'authorization'                  => 0,
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
            'header_information'   ,
            'sample_information'   ,
            'test_results'         ,
            'footer_information'   ,
            'authorization'        ,

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
        // dd($data);
        $temp->update($data);

        return to_route('admin.template_designer')->with('success', __('general.updated_successfully'));
    }
    public function update_default_status(Request $request)
    {
        
        COASettings::where('id', $request->temp_id)->update([
            'value' => $request->default ?? 0,
        ]);

        Toastr::success(translate('status_Changed'));
        return back();
    }

}
