<?php

namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Support\Carbon;

class OldAppoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($userId){
        $patient = Patient::where('user_id',$userId)->first();
        $appointments = Appointment::where('patient_id', $patient->patient_id)->where('status','finished')->get();
        $today = Carbon::today();
        return view('patient.oldappointments',['appointments'=> $appointments]);
    }

    public function update($patientID, $appoID){

    }
}
