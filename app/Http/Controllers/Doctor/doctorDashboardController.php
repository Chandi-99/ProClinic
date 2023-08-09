<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Bill;
use App\Models\Doctor;
use App\Models\Visitings;
use Illuminate\Support\Carbon;

class doctorDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $usertype = Auth::user()->usertype;

        if ($usertype == 'patient') {
            return redirect('/patient');
        } else if ($usertype == 'admin') {
            return redirect('/admin');
        } else if ($usertype == 'doctor') {

            $today = Carbon::now();
            $day = $today->format('l');
            $date = $today->format('Y-m-d');
            $month = $today->format('m');
            $doctor = Doctor::where('user_id', Auth::user()->id)->first();
            $docname = $doctor->fname . ' ' . $doctor->lname;
            $speciality = $doctor->specialization;

            $visitingCount = 0;
            $appoArray = [];
            $i = 0;
            $nextRoom = '';
            $startTime = '';

            $visitings = Visitings::where('doctor_id', $doctor->id)->where('day', $day)->first();
            if (empty($visitings)) {
                $visitingCount = 0;
                $nextRoom = 'N/A';
                $startTime = 'N/A';
            } else {
                $visitingCount = Visitings::where('doctor_id', $doctor->id)->where('day', $day)->count();
                $visitings = Visitings::where('doctor_id', $doctor->id)->where('day', $day)->get();

                foreach ($visitings as $visiting) {
                    $appo = Appointment::where('visiting_id', $visiting->id)->where('date', $date)->where('status', 'pending')->first();
                    if (empty($appo)) {
                        continue;
                    } else {
                        $appointment = Appointment::where('visiting_id', $visiting->id)->where('date', $date)->where('status', 'pending')->get();
                        foreach ($appointment as $appo) {
                            $appoArray[$i++] = $appo;
                            if ($appo->start_time == '08:00 AM') {
                                $nextRoom = $appo->Visiting->Room->room_name;
                                $startTime = '08:00 AM';
                            } elseif ($appo->start_time == '12:00 PM') {
                                $nextRoom = $appo->Visiting->Room->room_name;
                                $startTime = '12:00 PM';
                            } elseif ($appo->start_time == '04:00 PM') {
                                $nextRoom = $appo->Visiting->Room->room_name;
                                $startTime = '04:00 PM';
                            } elseif ($appo->start_time == '07:00 PM') {
                                $nextRoom = $appo->Visiting->Room->room_name;
                                $startTime = '07:00 PM';
                            }
                        }
                    }
                }
                if (count($appoArray) == 0) {
                    $appoArray = null;
                }
            }

            $total = 0;
            $visitings = Visitings::where('doctor_id', $doctor->id)->first();
            if (empty($visitings)) {
                $total = 0;
            } 
            else {
                $visitings = Visitings::where('doctor_id', $doctor->id)->get();
                foreach ($visitings as $visiting){
                    $appointments = Appointment::where('visiting_id', $visiting->id)->first();
                    if (empty($appointments)) {
                        $appointments = Appointment::where('visiting_id', $visiting->id)->get();
                        foreach($appointments as $appointment){
                            $appodate = Carbon::parse($appointment->date);
                            if($month == $appodate->format('m')){
                                $bill = Bill::where('appo_id', $appo->id)->get();
                                $total += $bill->doctor_charges;
                            }
                        }

                    } 
                }
            }

            return view('doctor.doctordashboard', [
                'appointments' => $appoArray, 'visitingCount' => $visitingCount,'total'=> $total,
                'nextRoom' => $nextRoom, 'appoCount' => $i, 'docname' => $docname, 'speciality' => $speciality, 'startTime' => $startTime
            ]);
        } else {
            return redirect('/staff');
        }
    }
}
