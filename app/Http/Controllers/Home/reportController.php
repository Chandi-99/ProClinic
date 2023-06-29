<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Support\Facades\Validator;
use mikehaertl\pdftk\Pdf;
use App\Models\Report;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class reportController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        Session::flash('alert_2', '');
        $user = User::find(Auth::user()->id);
        $patient = $user->Patient;
        
        $reports = Report::where('patient_id',$patient->patient_id)->latest()->get();
        foreach($reports as $repo){
            $file_extension = $repo->getClientOriginalExtension();
        }
        
        return view('patient.Reports', compact('reports', 'patient'));
    }

    public function updateReports(Request $request)
    {
        // Validate the form input
        $validator = Validator::make($request->all(), [
            'report' => 'required|file|mimes:jpeg,jpg,png,pdf|max:2048',
            'report_name' => 'required|unique:reports',
            'visibility' => 'required',
        ]);

        if($validator->fails()){
            Session::flash('alert_2', 'Report Name Already Taken or Invalid File Type!');
            return redirect()->back();
        }
        else{

            $file= $request->file('report');
            $user = User::find(Auth::user()->id);    
            $patientid = $user->Patient->patient_id;
            echo $file->getClientOriginalExtension();
            if($file->getClientOriginalExtension() == "pdf"){

            }
            else{

            }

            $password = Str::substr($user->Patient->nic, -3);
            
            $filename= date('YmdHi').$file->getClientOriginalName();
           // $file-> move(public_path('public/Reports'), $filename);
            
            $pdf = new Pdf("public/Reports/".$filename);
            $result = $pdf->allow('AllFeatures')
                        ->setPassword($password)
                        //->setUserPassword($userPassword)
                        ->passwordEncryption(128)
                        ->saveAs("public/Reports/".$filename);
            // Insert record
            $insertData_arr = array(
                'report_name' => $request['report_name'],
                'date' => date("Y-m-d"),
                'visibility' => $request['visibility'],
                'patient_id'=> $patientid,
                'image_path' => $filename,          
            );

            Report::create($insertData_arr);

            $user = User::find(Auth::user()->id);
            $patient = $user->Patient;
            echo $patient;
    
            $reports = Report::where('patient_id',$patient->patient_id)->get();
            echo $reports;
            return view('patient.Reports', compact('reports'));

        }
    }
}   
