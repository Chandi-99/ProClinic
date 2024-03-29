<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Patient;


class oldMedicationController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index($patientId)
    {
        $patient = Patient::where('patient_id', $patientId)->first();
        $appointments = Appointment::where('patient_id', $patientId)->count();
        if($appointments > 0){
            $appointments = Appointment::where('patient_id', $patientId)->get();
            return view('doctor.oldmedications',['patient'=> $patient, 'latests' => $appointments]);
        }
        else{
            return redirect()->back()->with('error', 'No Old Appoitnments for that patient!');
        }
    }
}
