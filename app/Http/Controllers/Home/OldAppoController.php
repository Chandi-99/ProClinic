<?php

namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class OldAppoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($patientID){
        $appointments = Appointment::where('patient_id', $patientID)
                                    //->where('status',"End")
                                    ->get();
        return view('patient.oldappointments',['appointments'=> $appointments]);
    }

    public function update($patientID, $appoID){

    }
}
