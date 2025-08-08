<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index()
    {
         
    }
    public function store(Request $request)
    { 
        $request->validate([
                "result_id" => "required",
                "client_id" => "required",
        ]);
        $certificate = new Certificate();
        $certificate->result_id = $request->result_id;
        $certificate->authorized_id = auth()->user()->id;
        

        return redirect()->route('certificate.list')->with('success', translate('added_successfully'));

    }
    
}
