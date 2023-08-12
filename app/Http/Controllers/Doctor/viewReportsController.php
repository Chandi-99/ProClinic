<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Support\Facades\Validator;
use mikehaertl\pdftk\Pdf;
use App\Models\Report;
use App\Models\ReportPDF;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class viewReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $patient = Patient::where('patient_id',$id)->first();
        $reports = Report::where('patient_id',$patient->patient_id)->where('visibility', 'Allow for Doctors')->latest()->count();
        if($reports > 0){
            $reports = Report::where('patient_id',$patient->patient_id)->where('visibility', 'Allow for Doctors')->latest()->get();
        }
        else{
            $reports = null;
        }

        $pdfreports = ReportPDF::where('patient_id',$patient->patient_id)->where('visibility', 'Allow for Doctors')->latest()->count();
        if($pdfreports > 0){
            $pdfreports = ReportPDF::where('patient_id',$patient->patient_id)->where('visibility', 'Allow for Doctors')->latest()->get();
        }
        else{
            $pdfreports = null;
        }
        return view('doctor.Reports', compact('reports', 'patient', 'pdfreports','patient'));
    }
}
