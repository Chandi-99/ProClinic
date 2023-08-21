<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Visitings;
use App\Models\Holiday;
use App\Models\Doctor;
use App\Models\Bill;
use App\Models\Patient;
use App\Models\User;
use App\Models\Prescription;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\PatientAppointment;
use App\Mail\DoctorAppointment;

class appointmentNextController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(int $user_id, int $doctor_id, string $type){
        $alldays = Visitings::where('doctor_id', $doctor_id)->where('type', $type)->select('day')->distinct()->orderBy('day', 'asc')->get();
        $days = '';
        $date = null;
        $isReadOnly = true;
        foreach ($alldays as $day) {
            $days = $days . $day->day . ' ';
        }
        $sessionsRegistered = ['Morning' => false, 'Afternoon' => false, 'Evening' => false, 'Night' => false];
        $sessions = Visitings::where('doctor_id', $doctor_id)->select('session')->distinct()->get();

        foreach ($sessions as $session) {
            if ($session->session == 'Morning') {
                $sessionsRegistered['Morning'] = true;
            } else if ($session->session == 'Afternoon') {
                $sessionsRegistered['Afternoon'] = true;
            } else if ($session->session == 'Evening') {
                $sessionsRegistered['Evening'] = true;
            } else if ($session->session == 'Night') {
                $sessionsRegistered['Night'] = true;
            }
        }
        Session::flash('alert_3', '');
        $userpatient = User::where('id', $user_id)->get();
        $patient = Patient::where('user_id', $userpatient[0]->id)->get();
        $patient_id = $patient[0]->id;
        $doctor = Doctor::where('id', $doctor_id)->get();
        return view('patient.appointmentNext', ['days' => $days, 'sessions' => $sessionsRegistered, 'isReadOnly' => $isReadOnly, 'patientid' => $patient_id, 'doctorid' => $doctor_id, 'patient' => $patient, 'doctor' => $doctor, 'date' => $date, 'type' => $type]);
    }

    public function check(int $user_id, int $doctor_id, string $type, Request $request){

        if ($request->has('form1')) {
            Session::flash('alert_3', '');
            $patient = Patient::where('user_id', $user_id)->get();
            $patient_id = $patient[0]->patient_id;
            $doctor = Doctor::where('id', $doctor_id)->get();
            $alldays = Visitings::where('doctor_id', $doctor_id)->where('type', $type)->select('day')->distinct()->orderBy('day', 'asc')->get();
            $days = '';
            $date = null;
            $isReadOnly = true;
            $selecteddate = Carbon::parse($request['date']);
            $sessionsRegistered = ['Morning' => false, 'Afternoon' => false, 'Evening' => false, 'Night' => false];
            $sessions = Visitings::where('doctor_id', $doctor_id)->where('type', $type)->where('day', $selecteddate->format('l'))->select('session')->distinct()->get();
            foreach ($sessions as $session) {
                if ($session->session == 'Morning') {
                    $sessionsRegistered['Morning'] = 'morning_true';
                    continue;
                } else if ($session->session == 'Afternoon') {
                    $sessionsRegistered['Afternoon'] = 'afternoon_true';
                    continue;
                } else if ($session->session == 'Evening') {
                    $sessionsRegistered['Evening'] = 'evening_true';
                    continue;
                } else if ($session->session == 'Night') {
                    $sessionsRegistered['Night'] = 'night_true';
                    continue;
                }
            }

            foreach ($alldays as $day) {
                $days = $days . $day->day . ' ';
            }

            $validator = Validator::make($request->all(), [
                'date' => ['required', 'date', 'after_or_equal:today', 'before_or_equal:' . date('Y-m-d', strtotime('+30 days'))],
            ]);

            if ($validator->fails()) {
                Session::flash('alert_3', $validator->errors());
                return view('patient.appointmentNext', ['days' => $days, 'sessions' => $sessionsRegistered, 'isReadOnly' => $isReadOnly, 'patientid' => $patient_id, 'doctorid' => $doctor_id, 'patient' => $patient, 'doctor' => $doctor, 'date' => $date, 'type' => $type]);
            } else {
                try {
                    $holidays = Holiday::all();
                    foreach ($holidays as $holiday) {
                        if ($holiday == $request['date']) {
                            Session::flash('alert_3', 'Sorry! We are closed on ' . $holiday->date);
                            return view('patient.appointmentNext', ['days' => $days, 'sessions' => $sessionsRegistered, 'isReadOnly' => $isReadOnly, 'patientid' => $patient_id, 'doctorid' => $doctor_id, 'patient' => $patient, 'doctor' => $doctor, 'date' => $date, 'type' => $type]);
                        }
                    }
                    $dayoftheSelectedDate = Carbon::parse($request['date']);
                    $dayOfWeek = $dayoftheSelectedDate->format('l');

                    $alldays = Visitings::where('doctor_id', $doctor_id)->select('day')->distinct()->orderBy('day', 'asc')->get();
                    foreach ($alldays as $day) {
                        if ($day->day == $dayOfWeek) {
                            $isReadOnly = false;
                            $sessionsRegistered = ['Morning' => false, 'Afternoon' => false, 'Evening' => false, 'Night' => false];
                            $sessions = Visitings::where('doctor_id', $doctor_id)->where('day', $dayOfWeek)->where('type', $type)->select('session')->distinct()->get();

                            foreach ($sessions as $session) {
                                if ($session->session == 'Morning') {
                                    $sessionsRegistered['Morning'] = 'morning_true';
                                } else if ($session->session == 'Afternoon') {
                                    $sessionsRegistered['Afternoon'] = 'afternoon_true';
                                } else if ($session->session == 'Evening') {
                                    $sessionsRegistered['Evening'] = 'evening_true';
                                } else if ($session->session == 'Night') {
                                    $sessionsRegistered['Night'] = 'night_true';
                                }
                            }
                            $date = $request['date'];
                            return view('patient.appointmentNext', ['days' => $days, 'sessions' => $sessionsRegistered, 'isReadOnly' => $isReadOnly, 'patientid' => $patient_id, 'doctorid' => $doctor_id, 'patient' => $patient, 'doctor' => $doctor, 'date' => $date, 'type' => $type]);
                        }
                    }

                    Session::flash('alert_3', 'Doctor is Unavailable on that date');
                    return view('patient.appointmentNext', ['days' => $days, 'sessions' => $sessionsRegistered, 'isReadOnly' => $isReadOnly, 'patientid' => $patient_id, 'doctorid' => $doctor_id, 'patient' => $patient, 'doctor' => $doctor, 'date' => $date, 'type' => $type]);
                } catch (Exception $ex) {
                    Session::flash('alert_3', $ex);
                    return view('patient.appointmentNext', ['days' => $days, 'sessions' => $sessionsRegistered, 'isReadOnly' => $isReadOnly, 'patientid' => $patient_id, 'doctorid' => $doctor_id, 'patient' => $patient, 'doctor' => $doctor, 'date' => $date, 'type' => $type]);
                }
            }
        } else if ($request->has('form2')) {

            Session::flash('alert_3', '');
            $patient = Patient::where('user_id', $user_id)->get();
            $patient_id = $patient[0]->patient_id;
            $doctor = Doctor::where('id', $doctor_id)->get();
            $alldays = Visitings::where('doctor_id', $doctor_id)->where('type', $type)->select('day')->distinct()->orderBy('day', 'asc')->get();
            $days = '';
            $date = null;
            $isReadOnly = true;
            $sessionsRegistered = ['Morning' => false, 'Afternoon' => false, 'Evening' => false, 'Night' => false];
            $sessions = Visitings::where('doctor_id', $doctor_id)->where('type', $type)->select('session')->distinct()->get();

            foreach ($sessions as $session) {
                if ($session->session == 'Morning') {
                    $sessionsRegistered['Morning'] = 'morning_true';
                } else if ($session->session == 'Afternoon') {
                    $sessionsRegistered['Afternoon'] = 'afternoon_true';
                } else if ($session->session == 'Evening') {
                    $sessionsRegistered['Evening'] = 'evening_true';
                } else if ($session->session == 'Night') {
                    $sessionsRegistered['Night'] = 'night_true';
                }
            }

            foreach ($alldays as $day) {
                $days = $days . $day->day . ' ';
            }
            $validator = Validator::make($request->all(), [
                'session' => ['required'],
            ]);
            if ($validator->fails()) {
                Session::flash('alert_3', $validator->errors());
                return view('patient.appointmentNext', ['days' => $days, 'sessions' => $sessionsRegistered, 'isReadOnly' => $isReadOnly, 'patientid' => $patient_id, 'doctorid' => $doctor_id, 'patient' => $patient, 'doctor' => $doctor, 'date' => $date, 'type' => $type]);
            } else {
                try {
                    $date = Carbon::parse($request['hiddendate']);
                    $day = $date->format('l');
                    $session = $request['session'];
                    if ($session == "morning_true") {
                        $session = 'Morning';
                    } else if ($session == "afternoon_true") {
                        $session = 'Afternoon';
                    } else if ($session == "evening_true") {
                        $session = 'Evening';
                    } else if ($session == "night_true") {
                        $session = 'Night';
                    }

                    $visiting_id = Visitings::where('session', $session)->where('type', $type)->where('doctor_id', $doctor_id)->where('day', $day)->select('id')->get();
                    $max_appo = Visitings::where('id', $visiting_id[0]->id)->select('max_per_session')->get();
                    $appoCount = Appointment::where('visiting_id', $visiting_id[0]->id)->where('date', $date)->count();

                    if ($max_appo[0]->max_per_session <= $appoCount) {
                        Session::flash('alert_3', 'Maximum Number of Appointments Reached for that Session!');
                        return view('patient.appointmentNext', ['days' => $days, 'sessions' => $sessionsRegistered, 'isReadOnly' => $isReadOnly, 'patientid' => $patient_id, 'doctorid' => $doctor_id, 'patient' => $patient, 'doctor' => $doctor, 'date' => $date, 'type' => $type]);
                    } else {
                        if ($type == 'Physical') {
                            $amounttopay = Doctor::where('id', $doctor_id)->select('normal_rate')->get();
                        } else if ($type == 'TeleMedicine'){
                            $amounttopay = Doctor::where('id', $doctor_id)->select('echanneling_rate')->get();
                        }
                            

                        if ($session == 'Morning') {
                            $startTime = '08:00 AM';
                        } elseif ($session == 'Afternoon') {
                            $startTime = '12:00 PM';
                        } elseif ($session == 'Evening') {
                            $startTime = '03:00 PM';
                        } elseif ($session == 'Night') {
                            $startTime = '06:00 PM';
                        }

                        $date = $date->format('Y-m-d');
                        try {

                            $appointment = new Appointment();
                            $appointment->visiting_id = $visiting_id[0]->id;
                            $appointment->patient_id = $patient_id;
                            $appointment->appo_number = $appoCount + 1;
                            $appointment->prescription_id = null;
                            $appointment->bill_id = null;
                            $appointment->status = 'pending';
                            $appointment->date = $date;
                            $appointment->start_time = $startTime;

                            $appointment->save();
                        } catch (Exception $ex) {
                            return redirect()->back()->withErrors($ex->getMessage());
                        }

                        $appo_id = $appointment->id;
                        $bill = new Bill();
                        $bill->appo_id = $appo_id;
                        $bill->medicine_charges = null;
                        if($type == 'TeleMedicine'){
                            $bill->doctor_charges = $amounttopay[0]->echanneling_rate;
                        }
                        else{
                            $bill->doctor_charges = $amounttopay[0]->normal_rate;
                        }
                        
                        $bill->other_charges = null;
                        $bill->discount = null;
                        $bill->total = null;
                        $bill->save();
                    

                        $prescription = new Prescription();
                        $prescription->appo_id = $appo_id;
                        $prescription->description = 'Initial Description';
                        $prescription->save();
                        $appointment->bill_id = $bill->id;
                        $appointment->prescription_id = $prescription->id;
                        $appointment->save();

                        $email = User::where('id', $user_id)->select('email')->get();
                        $patientFName = Patient::where('patient_id', $patient_id)->select('fname')->get();
                        $patientLName = Patient::where('patient_id', $patient_id)->select('lname')->get();
                        $patientName = $patientFName[0]->fname . ' ' . $patientLName[0]->lname;

                        $doctor = Doctor::where('id', $doctor_id)->get();
                        $emaildoctor = User::where('id', $doctor[0]->user_id)->select('email')->get();
                        $doctorFName = Doctor::where('id', $doctor_id)->select('fname')->get();
                        $doctorLName = Doctor::where('id', $doctor_id)->select('lname')->get();
                        $doctorName = $doctorFName[0]->fname . ' ' . $doctorLName[0]->lname;
                        $AppointmentNumber = $appoCount + 1;

                        $doctorFees = $amounttopay[0]->normal_rate;

                        Mail::to($email)->send(new PatientAppointment(
                            $appo_id,
                            $email[0]->email,
                            $patientName,
                            $type,
                            $doctorName,
                            $date,
                            $session,
                            $startTime,
                            $AppointmentNumber,
                            $doctorFees,
                            $bill->id,
                            $prescription->id
                        ));

                        Mail::to($emaildoctor)->send(new DoctorAppointment(
                            $appo_id,
                            $emaildoctor[0]->email,
                            $patientName,
                            $type,
                            $doctorName,
                            $date,
                            $session,
                            $startTime,
                            $AppointmentNumber,
                            $doctorFees,
                            $bill->id,
                            $prescription->id
                        ));

                        Session::flash('success', 'Appointment Created successfully!');
                        return redirect('/newappointment/' . $patient_id);
                    }
                } catch (Exception $ex) {
                    Session::flash('alert_3', $ex);
                }
            }
        }
    }
}
