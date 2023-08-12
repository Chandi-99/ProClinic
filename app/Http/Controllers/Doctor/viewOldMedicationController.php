<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient;
use App\Models\Medicine;
use App\Models\Prescription;
use App\Models\Prescription_Medicine;

class viewOldMedicationController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index($patientId)
    {
        $usertype = Auth::user()->usertype;

        if ($usertype == 'patient') {
            return redirect('/home');
        } else if ($usertype == 'admin') {
            return redirect('/admin');
        } else if ($usertype == 'doctor') {
            $patient = Patient::where('patient_id', $patientId)->first();
            $appointmentCount = Appointment::where('status', 'finished')->where('patient_id', $patientId)->count();

            if($appointmentCount > 0){
                $result = [];
                $i = 0;
                $appointments = Appointment::where('status', 'finished')->where('patient_id', $patientId)->get();
                foreach($appointments as $appointment){
                    $prescription = Prescription::where('appo_id', $appointment->id)->first();
                    $allPresMedi = Prescription_Medicine::where('prescription_id', $prescription->id)->get();
                    foreach($allPresMedi as $presMedi){
                        $medicine = Medicine::find($presMedi->medi_id);
                        $result[$i++] = 'Given '.$medicine->medi_name.' on '.$appointment->date;
                    }
                }

                return view('doctor.oldmedications',['result' => $result]);
                
            }
            else{
                return redirect()->back()->with('error', 'No Finished Appointments for this Patient!');
            }
        } else {
            return redirect('/staff');
        }
    }


}
