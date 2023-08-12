<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use app\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Bill;
use App\Models\Diagnosis;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Prescription;
use App\Models\Visitings;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;

class DiagnosisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $userId, $visitingId)
    {
        $usertype = Auth::user()->usertype;

        if ($usertype == 'patient') {
            return redirect('/home');
        } else if ($usertype == 'admin') {
            return redirect('/admin');
        } else if ($usertype == 'doctor') {
            $doctor = Doctor::where('user_id', $userId)->first()->get();
            $docname = $doctor[0]->fname . ' ' . $doctor[0]->lname;
            $speciality = $doctor[0]->specialization;
            $today = Carbon::today();
            $day = $today->format('l');
            $today = $today->format('Y-m-d');

            $visiting = Visitings::where('id', $visitingId)->get();
            $appointments = Appointment::where('visiting_id', $visitingId)->where('date', $today)->where('status', 'pending')->orderBy('appo_number', 'asc')->first();
            if(empty($appointments)){
                return redirect('/todaysession/'.$userId)->with('alert', 'All the Appointments are Finished!');
            }
            else{
                $appointments = Appointment::where('visiting_id', $visitingId)->where('date', $today)->where('status', 'pending')->orderBy('appo_number', 'asc')->get();
                $patient = $appointments[0]->Patient();
                $bill = Bill::where('appo_id', $appointments[0]->id)->get();
                $prescription = Prescription::where('appo_id', $appointments[0]->id)->get();

                return view('doctor.diagnosis',['patient' => $patient, 'bill' => $bill[0], 'prescription' => $prescription[0], 'appointment' => $appointments[0], 'visiting' => $visiting[0]]);
            }

        } else {
            return redirect('/staff');
        }
    }

    public function update(){
        return view('doctor.diagnosis');
    }
}
