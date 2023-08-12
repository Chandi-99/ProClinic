<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Visitings;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class appointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {

        $doctors = Doctor::all();
        $specialities = Doctor::select('specialization')->distinct()->get();
        $isReadonly = false;
        $isVisible = false;
        $name = null;
        $special = null;
        $type = null;
        $days = '';
        $sessionsRegistered = ['Morning' => false, 'Afternoon' => false, 'Evening' => false, 'Night' => false];

        return view('patient.appointment', [
            'doctors' => $doctors, 'specialities' => $specialities, 'isReadonly' => $isReadonly, 'isVisible' => $isVisible,
            'selectedDoctorFName' => $name, 'selectedDoctorSpeciality' => $special, 'type' => $type, 'days' => $days, 'session' => $sessionsRegistered
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'doctor' => 'required',
            'speciality' => 'required',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/newappointment/' . $id)->withErrors($validator);
        } 
        else {
            $values = explode(' ', $request['doctor']);
            $selectedDoctor = Doctor::where('fname', $values[0])->where('lname', $values[1])->first()->get();

            if ($request['speciality'] != $selectedDoctor[0]->specialization) {
                return redirect('/newappointment/' . $id)->with('error', 'There is No Doctor Registered With that Specialization!');
            } else {
                try {

                    $visitings = Visitings::where('doctor_id', $selectedDoctor[0]->id)->where('type', $request['type'])->get();

                    if (empty($visitings)) {
                        Session::flash('alert_1', 'This Doctor did not registered for Appointment Type ' . $request['type']);
                        return view('/newappointment/' . $id);
                    } else {

                        $patientid = Patient::where('user_id', $id)->get();
                        $doctorid = $selectedDoctor[0]->id;
                        $url = route('appointment.check', ['id' => $id, 'Id' => $doctorid, 'type' => $request['type']]);
                        return redirect()->to($url);
                    }
                } catch (Exception $ex) {
                    return redirect('/newappointment/{id}')->with('error', 'This Doctor did not registered for Appointment Type ' . $request['type']);
                }
            }
        }
    }
}
