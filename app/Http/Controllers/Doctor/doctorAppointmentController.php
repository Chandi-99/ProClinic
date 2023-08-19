<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Visitings;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class doctorAppointmentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        if(Auth::check()){
            try {
                $usertype = Auth::user()->usertype;
                if ($usertype == 'patient') {
                    return view('patient.home');
                } 
                else if ($usertype == 'doctor') {
                    $appointments = Appointment::all();
                    $doctors = Doctor::all();
                    $patients = Patient::all();
                    $search_appointments = [];
                    return view('doctor.appointmentdetails', ['appointments' => $appointments, 'doctors' =>$doctors,
                     'patients' => $patients, 'search_appointments'=>$search_appointments, 'status' => 'pending' ]);
    
                } 
                else if ($usertype == 'admin') {
                    return view('admin.doctordashboard');
                } 
                else {
                    return view('staff.staffdashboard');
                }
            } catch (Exception $ex) {
                Session::flash('error', 'Exception Occured!');
                return redirect()->back();
            }
        }
        else{
            return redirect('/welcome');
        }
        
    }

    public function search(Request $request){
        $validator = Validator::make($request->all(), [
            'appo_id' => ['string', 'max:20'],
            'status' => ['string', 'max:20'],
            'patient_id' => ['string', 'max:20'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } 
        else {

            $appoidfilter = $statusfilter = $patientidfilter = $appodatefilter = '';
            if ($request['appo_id'] != null) {
                $appoidfilter = 'yes';
            }
            if ($request['status'] != null) {
                $statusfilter = 'yes';
                $doctor = Doctor::where('user_id', Auth::user()->id)->first();
                if (!empty($doctor)) {
                    $doctor = Doctor::where('id', $request['doctor_id'])->get();
                    $visitings = Visitings::where('doctor_id', $request['doctor_id'])->first();
                    if (!empty($visitings)) {
                        $visitings = Visitings::where('doctor_id', $request['doctor_id'])->get();
                    } else {
                        dd($visitings);
                        return redirect()->back()->with('error', 'Selected Doctor has not registrered in any Visitings!')->withInput();
                    }
                } else {
                    return redirect()->back()->with('error', 'Invalid Doctor!')->withInput();
                }
            }
            if ($request['patient_id'] != null) {
                $patientidfilter = 'yes';
                $patient = Patient::where('patient_id', $request['patient_id'])->first();
                if (!empty($patient)) {
                    $patient = Patient::where('patient_id', $request['patient_id'])->get();
                } else {
                    return redirect()->back()->with('error', 'Invalid Patient!')->withInput();
                }
            }
            if ($request['appointmentdate'] != null) {
                $appodatefilter = 'yes';
            }

            $i = 0;
            $appointmentArray = [];

            if ($appoidfilter == 'yes' &&  $statusfilter == "yes" && $patientidfilter == "yes" && $appodatefilter == "yes") {
                foreach ($visitings as $visiting) {
                    $appointment = Appointment::where('id', $request['appo_id'])->where('patient_id', $request['patient_id'])->where('visiting_id', $visiting->id)->where('date', $request['appointmentdate'])->first();
                    if (!empty($appointment)) {
                        $appointment = Appointment::where('id', $request['appo_id'])->where('patient_id', $request['patient_id'])->where('visiting_id', $visiting->id)->where('date', $request['appointmentdate'])->get();
                        $appointmentArray[$i++] = $appointment;
                    } else {
                        continue;
                    }
                }
                if ($i == 0) {
                    return redirect()->back()->with('error', 'No Appointments Found!')->withInput();
                }
            } else if ($appoidfilter == 'yes' &&  $statusfilter == "yes" && $patientidfilter == "yes") {
                foreach ($visitings as $visiting) {
                    $appointment = Appointment::where('id', $request['appo_id'])->where('patient_id', $request['patient_id'])->where('visiting_id', $visiting->id)->first();
                    if (!empty($appointment)) {
                        $appointment = Appointment::where('id', $request['appo_id'])->where('patient_id', $request['patient_id'])->where('visiting_id', $visiting->id)->get();
                        $appointmentArray[$i++] = $appointment;
                    } else {
                        continue;
                    }
                }
                if ($i == 0) {
                    return redirect()->back()->with('error', 'No Appointments Found!')->withInput();
                }
            } else if ($appoidfilter == 'yes' &&  $statusfilter == "yes" && $appodatefilter == "yes") {
                foreach ($visitings as $visiting) {
                    $appointment = Appointment::where('id', $request['appo_id'])->where('visiting_id', $visiting->id)->where('date', $request['appointmentdate'])->first();
                    if (!empty($appointment)) {
                        $appointment = Appointment::where('id', $request['appo_id'])->where('visiting_id', $visiting->id)->where('date', $request['appointmentdate'])->get();
                        $appointmentArray[$i++] = $appointment;
                    } else {
                        continue;
                    }
                }
                if ($i == 0) {
                    return redirect()->back()->with('error', 'No Appointments Found!')->withInput();
                }
            } else if ($appoidfilter == 'yes' &&  $appodatefilter == "yes" && $patientidfilter == "yes") {

                $appointment = Appointment::where('id', $request['appo_id'])->first();
                if (!empty($appointment)) {
                    $appointment = Appointment::where('id', $request['appo_id'])->where('patient_id', $request['patient_id'])->where('date', $request['appointmentdate'])->get();
                    $appointmentArray[$i++] = $appointment;
                } else {
                    return redirect()->back()->with('error', 'No Appointments Found!')->withInput();
                }
            } else if ($patientidfilter == 'yes' &&  $statusfilter == "yes" && $appodatefilter == "yes") {
                foreach ($visitings as $visiting) {
                    $appointment = Appointment::where('patient_id', $request['patient_id'])->where('visiting_id', $visiting->id)->where('date', $request['appointmentdate'])->first();
                    if (!empty($appointment)) {
                        $appointment = Appointment::where('patient_id', $request['patient_id'])->where('visiting_id', $visiting->id)->where('date', $request['appointmentdate'])->get();
                        $appointmentArray[$i++] = $appointment;
                    } else {
                        continue;
                    }
                }
                if ($i == 0) {
                    return redirect()->back()->with('error', 'No Appointments Found!')->withInput();
                }
            }
            else if ($appoidfilter == 'yes' &&  $statusfilter == "yes" ) {
                foreach ($visitings as $visiting) {
                    $appointment = Appointment::where('id', $request['appo_id'])->where('visiting_id', $visiting->id)->first();
                    if (!empty($appointment)) {
                        $appointment = Appointment::where('id', $request['appo_id'])->where('visiting_id', $visiting->id)->get();
                        $appointmentArray[$i++] = $appointment;
                    } else {
                        continue;
                    }
                }
                if ($i == 0) {
                    return redirect()->back()->with('error', 'No Appointments Found!')->withInput();
                }
            }
            else if ($appoidfilter == 'yes' && $patientidfilter == "yes") {
                    $appointment = Appointment::where('id', $request['appo_id'])->where('patient_id', $request['patient_id'])->first();
                    if (!empty($appointment)) {
                        $appointment = Appointment::where('id', $request['appo_id'])->where('patient_id', $request['patient_id'])->get();
                        $appointmentArray[$i++] = $appointment;
                    } else {
                        return redirect()->back()->with('error', 'No Appointments Found!')->withInput();
                    }
            }
            else if ($appodatefilter == 'yes' && $patientidfilter == "yes") {
                $appointment = Appointment::where('patient_id', $request['patient_id'])->where('date', $request['appointmentdate'])->first();
                if (!empty($appointment)) {
                    $appointment = Appointment::where('patient_id', $request['patient_id'])->where('date', $request['appointmentdate'])->get();
                    $appointmentArray[$i++] = $appointment;
                } else {
                    return redirect()->back()->with('error', 'No Appointments Found!')->withInput();
                }
            }else if ($appodatefilter == 'yes' && $appoidfilter == "yes") {
                $appointment = Appointment::where('id', $request['id'])->where('date', $request['appointmentdate'])->first();
                if (!empty($appointment)) {
                    $appointment = Appointment::where('id', $request['id'])->where('date', $request['appointmentdate'])->get();
                    $appointmentArray[$i++] = $appointment;
                } else {
                    return redirect()->back()->with('error', 'No Appointments Found!')->withInput();
                }
            }else if ($appodatefilter == 'yes' &&  $statusfilter == "yes" ) {
                foreach ($visitings as $visiting) {
                    $appointment = Appointment::where('date', $request['appointmentdate'])->where('visiting_id', $visiting->id)->first();
                    if (!empty($appointment)) {
                        $appointment = Appointment::where('date', $request['appointmentdate'])->where('visiting_id', $visiting->id)->get();
                        $appointmentArray[$i++] = $appointment;
                    } else {
                        continue;
                    }
                }
                if ($i == 0) {
                    return redirect()->back()->with('error', 'No Appointments Found!')->withInput();
                }
            }
            else if ($patientidfilter == 'yes' &&  $statusfilter == "yes" ) {
                foreach ($visitings as $visiting) {
                    $appointment = Appointment::where('patient_id', $request['patient_id'])->where('visiting_id', $visiting->id)->first();
                    if (!empty($appointment)) {
                        $appointment = Appointment::where('patient_id', $request['patient_id'])->where('visiting_id', $visiting->id)->get();
                        $appointmentArray[$i++] = $appointment;
                    } else {
                        continue;
                    }
                }
                if ($i == 0) {
                    return redirect()->back()->with('error', 'No Appointments Found!')->withInput();
                }
            }
            else if ($statusfilter == 'yes') {
                foreach ($visitings as $visiting) {
                    $appointment = Appointment::where('doctor_id', $request['doctor_id'])->first();
                    if (!empty($appointment)) {
                        $appointment = Appointment::where('doctor_id', $request['doctor_id'])->get();
                        $appointmentArray[$i++] = $appointment;
                    } else {
                        continue;
                    }
                }
                if ($i == 0) {
                    return redirect()->back()->with('error', 'No Appointments Found!')->withInput();
                }
            }
            else if ($appodatefilter == 'yes') {
                $appointment = Appointment::where('date', $request['appointmentdate'])->first();
                if (!empty($appointment)) {
                    $appointment = Appointment::where('date', $request['appointmentdate'])->get();
                    $appointmentArray[$i++] = $appointment;
                } else {
                    return redirect()->back()->with('error', 'No Appointments Found!')->withInput();
                }
            }
            else if ($patientidfilter == "yes") {
                $appointment = Appointment::where('patient_id', $request['patient_id'])->first();
                if (!empty($appointment)) {
                    $appointment = Appointment::where('patient_id', $request['patient_id'])->get();
                    $appointmentArray[$i++] = $appointment;
                } else {
                    return redirect()->back()->with('error', 'No Appointments Found!')->withInput();
                }
            }
            else if ($appoidfilter == "yes") {
                $appointment = Appointment::where('id', $request['appo_id'])->first();
                if (!empty($appointment)) {
                    $appointment = Appointment::where('id', $request['appo_id'])->get();
                    $appointmentArray[$i++] = $appointment;
                } else {
                    return redirect()->back()->with('error', 'No Appointments Found!')->withInput();
                }
            }

            $doctors = Doctor::all();
            $patients = Patient::all();
            $appointments = [];
            Session::flash('success', 'Appointments Found!');
            return view('admin.appointmentdetails', ['appointments' => $appointments, 'doctors' => $doctors, 'patients' => $patients, 'search_appointments'=> $appointmentArray ]);
        }
    }
}
