<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use mikehaertl\pdftk\Pdf;
use App\Models\Report;
use App\Models\ReportPDF;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

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
        $pdfreports = ReportPDF::where('patient_id',$patient->patient_id)->latest()->get();
        return view('patient.Reports', compact('reports', 'patient', 'pdfreports'));
    }

    public function updateReports(Request $request)
    {

        if($request->has('form3')){
            $validator = Validator::make($request->all(), [
                'report' => 'required|file|mimes:jpeg,jpg,png,pdf|max:2048',
                'report_name' => 'required|unique:reports',
                'visibility' => 'required',
            ]);
    
            if($validator->fails()){
                Session::flash('alert_2', 'Report Name Already Taken or Invalid File Type!');
                return redirect('/user/reports');
            }
            else{
    
                $file= $request->file('report');
                $user = User::find(Auth::user()->id);    
                $patientid = $user->Patient->patient_id;
                $Filevalidator =  Validator::make($request->all(), [
                    'report' => 'mimes:pdf',
                    ]);
    
                if(!$Filevalidator->fails()){
                    
                    $filename= date('YmdHi').$file->getClientOriginalName();
                    $file-> move(public_path('public/PDFReports'), $filename);
                    $fp = "public/PDFReports/".$filename;
                    $password = Str::substr($user->Patient->nic, -3);
                    $userPassword = "123456a";
                    $pdf = new Pdf($fp);
    
                    $result = $pdf->allow('AllFeatures')
                                ->setPassword($password)
                                ->setUserPassword($userPassword)
                                ->passwordEncryption(128)
                                ->saveAs($fp);
                      
                    if ($result === false) {
                        echo $pdf->getError();
                    }
                  
                    // Insert record
                    $insertData_arr = array(
                        'pdfreport_name' => $request['report_name'],
                        'date' => date("Y-m-d"),
                        'visibility' => $request['visibility'],
                        'patient_id'=> $patientid,
                        'path' => $filename,          
                    );
    
                    echo $result;
                    ReportPDF::create($insertData_arr);
                    return response()->download("public/PDFReports/".$filename);
                    //return redirect('/user/reports');
                }
                else{
    
                    $filename= date('YmdHi').$file->getClientOriginalName();
                    $file-> move(public_path('public/Reports'), $filename);
    
                    // Insert record
                    $insertData_arr = array(
                        'report_name' => $request['report_name'],
                        'date' => date("Y-m-d"),
                        'visibility' => $request['visibility'],
                        'patient_id'=> $patientid,
                        'image_path' => $filename,          
                    );
           
                    Report::create($insertData_arr);
                    return redirect('/user/reports');
                }
        }
        

        }
       
    }

} 
