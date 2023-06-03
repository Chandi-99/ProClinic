<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Report;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

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
        $user = User::find(Auth::user()->id);
        $patient = $user->Patient;
        

        $reports = Report::where('patient_id',$patient->patient_id)->get();
        echo $reports;
        return view('Reports', compact('reports', 'patient'));
    }

    public function updateReports(Request $request)
    {

        // Validate the form input
        $request->validate([
            'report' => 'required|max:2048',
            'report_name' => 'required',
            'visibility' => 'required',
        ]);

        $user = User::find(Auth::user()->id);    
        $patientid = $user->Patient->patient_id;

        if($request['report']) {

            $path = $request->file('report')->storeAs('reports', $request->file('report')->getClientOriginalName());
            $temp = $request->file('report')->getClientOriginalName();
            $sql = DB::update('update reports set `reports`.`image_path` ='.'"'.$temp.'"'.' where `reports`.`patient_id`='.'"'.$patientid.'";');

            // Insert record
            $insertData_arr = array(
                'report_name' => $request['report_name'],
                'date' => date("Y-m-d"),
                'visibility' => $request['visibility'],
                'patient_id'=> $patientid,
                'image_path' => $request->file('report')->getClientOriginalName()              
            );

            Report::create($insertData_arr);

            $user = User::find(Auth::user()->id);
            $patient = $user->Patient;
            echo $patient;
    
            $reports = Report::where('patient_id',$patient->patient_id)->get();
            echo $reports;
            return view('Reports', compact('reports'));

        }


        return redirect()->back()->with('success', 'Report inserted successfully!');
    }
}
