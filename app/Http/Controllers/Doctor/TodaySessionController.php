<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\AppointmentLink;
use App\Models\Doctor;
use App\Models\Visitings;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;

class TodaySessionController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index($userId){
        $usertype = Auth::user()->usertype;

        if ($usertype == 'patient') {
            return view('patient.home');
        } else if ($usertype == 'admin') {
            return view('admin.admindashboard');
        } else if ($usertype == 'doctor') {

            $doctor = Doctor::where('user_id', $userId)->get();
            $docname = $doctor[0]->fname . ' ' . $doctor[0]->lname;
            $speciality = $doctor[0]->specialization;
            $today = Carbon::today();
            $day = $today->format('l');
            $today = $today->format('Y-m-d');

            $visitingcount = Visitings::where('doctor_id', $doctor[0]->id)
                ->where('day', $day)
                ->count();

            if ($visitingcount == 0) {
                Session::flash('error', 'No Sessions Today!');
                return redirect('/doctor');
            } else {
                $visitings = Visitings::where('doctor_id', $doctor[0]->id)->where('day', $day)->get();
            }

            $appoArray = [];
            $i = 0;
            $k = 0;
            $j = 0;
            foreach ($visitings as $visiting) {
                $j = Appointment::where('visiting_id', $visiting->id)->where('status', 'pending')
                    ->where('date', $today)
                    ->count();
                if ($j == 0) {
                    continue;
                } else {
                    $appo = Appointment::where('visiting_id', $visiting->id)->where('status', 'pending')
                        ->where('date', $today)
                        ->get();
                    foreach ($appo as $appointment) {
                        $appoArray[$i++] = $appointment;
                        $k++;
                    }
                }
            }
            if ($k == 0) {
                Session::flash('error', 'No Appointments Today!');
                return redirect('/doctor');
            }
            foreach ($appoArray as $array) {
                $i++;
            }
            return view('doctor.todaysession', ['appointments' => $appoArray, 'length' => $k, 'docname' => $docname, 'speciality' => $speciality, 'today' => $today, 'day' => $day, 'visitings' => $visitings]);
        } else {
            return redirect('/staff');
        }
    }

    public function start(Request $request, $userId){
        $validator = Validator::make($request->all(), [
            'session' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'Invalid Session!');
            return redirect()->back();
        }

        $visitingId =  $request['session'];
        $visiting = Visitings::where('id', $visitingId)->get();

        $currentTime = Carbon::now()->format('H:i');
        $stringTime = "08:00:00";
        $today = Carbon::today();
        $today = $today->format('Y-m-d');
        $link = $request['link'];

        if ($visiting[0]->session == 'Morning') {
            $stringTime = "08:00:00";
            $timestamp = strtotime($stringTime);
            $formattedTime = date('H:i', $timestamp);
            $carbonTime1 = Carbon::parse($currentTime);
            $carbonTime2 = Carbon::parse($formattedTime);
            $timeDifference = $carbonTime1->diff($carbonTime2);

            $hours = $timeDifference->h;
            if($hours > 4){//chnage this to 2
                Session::flash('error', "Session can only start within 2 hours before the start time or 2 hours after the start time!");
                return redirect()->back();
            }
            else{
                if($visiting[0]->type == 'TeleMedicine' && $link == null){
                    return redirect()->back()->with('error', 'Please Upload the Meeting Link!');
                }
                else if($visiting[0]->type == 'TeleMedicine' && $link != null){
                    
                    $temp = new AppointmentLink();
                    $temp->link = $link;
                    $temp->date = $today;
                    $temp->visiting_id = $visiting[0]->id;
                    $temp->save();
                }
                $appointments = Appointment::where('visiting_id', $visitingId)->where('date', $today)->where('status', 'pending')->orderBy('appo_number', 'asc')->first();
                return redirect('/todaysession/'.$visitingId.'/'.$appointments->id);
                
            }
        } else if ($visiting[0]->session == 'Afternoon') {
            $stringTime = "12:00:00";
            $timestamp = strtotime($stringTime);
            $formattedTime = date('H:i', $timestamp);
            $carbonTime1 = Carbon::parse($currentTime);
            $carbonTime2 = Carbon::parse($formattedTime);
            $timeDifference = $carbonTime1->diff($carbonTime2);

            $hours = $timeDifference->h;
            if($hours > 4){
                Session::flash('error', "Session can only start within 2 hours before the start time or 2 hours after the start time!");
                return redirect()->back();
            }
            else{
                if($visiting[0]->type == 'Telemedicine' && $request['link'] == ''){
                    return redirect()->back()->with('error', 'Please Upload the Meeting Link!');
                }
                else if($visiting[0]->type == 'Telemedicine' && $request['link'] != ''){
                    $link = $request['link'];
                    $temp = new AppointmentLink();
                    $temp->link = $link;
                    $temp->date = $today;
                    $temp->visiting_id = $visiting[0]->id;
                    $temp->save();
                }
                $appointments = Appointment::where('visiting_id', $visitingId)->where('date', $today)->where('status', 'pending')->orderBy('appo_number', 'asc')->first();
                return redirect('/todaysession/'.$visitingId.'/'.$appointments->id);

            }
        } else if ($visiting[0]->session == 'Evening') {
            $stringTime = "15:00:00";
            $timestamp = strtotime($stringTime);
            $formattedTime = date('H:i', $timestamp);
            $carbonTime1 = Carbon::parse($currentTime);
            $carbonTime2 = Carbon::parse($formattedTime);
            $timeDifference = $carbonTime1->diff($carbonTime2);

            $hours = $timeDifference->h;
            if($hours > 4){
                Session::flash('error', "Session can only start within 2 hours before the start time or 2 hours after the start time!");
                return redirect()->back();
            }
            else{
                if($visiting[0]->type == 'Telemedicine' && $request['link'] == ''){
                    return redirect()->back()->with('error', 'Please Upload the Meeting Link!');
                }
                else if($visiting[0]->type == 'Telemedicine' && $request['link'] != ''){
                    $link = $request['link'];
                    $temp = new AppointmentLink();
                    $temp->link = $link;
                    $temp->date = $today;
                    $temp->visiting_id = $visiting[0]->id;
                    $temp->save();
                }
                $appointments = Appointment::where('visiting_id', $visitingId)->where('date', $today)->where('status', 'pending')->orderBy('appo_number', 'asc')->first();
                return redirect('/todaysession/'.$visitingId.'/'.$appointments->id);
                
            }
        } else if ($visiting[0]->session == 'Night') {
            $stringTime = "18:00:00";
            $timestamp = strtotime($stringTime);
            $formattedTime = date('H:i', $timestamp);
            $carbonTime1 = Carbon::parse($currentTime);
            $carbonTime2 = Carbon::parse($formattedTime);
            $timeDifference = $carbonTime1->diff($carbonTime2);

            $hours = $timeDifference->h;
            if($hours > 4){
                Session::flash('error', "Session can only start within 2 hours before the start time or 2 hours after the start time!");
                return redirect()->back();
            }
            else{
                if($visiting[0]->type == 'Telemedicine' && $request['link'] == ''){
                    return redirect()->back()->with('error', 'Please Upload the Meeting Link!');
                }
                else if($visiting[0]->type == 'Telemedicine' && $request['link'] != ''){
                    $link = $request['link'];
                    $temp = new AppointmentLink();
                    $temp->link = $link;
                    $temp->date = $today;
                    $temp->visiting_id = $visiting[0]->id;
                    $temp->save();
                }
                $appointments = Appointment::where('visiting_id', $visitingId)->where('date', $today)->where('status', 'pending')->orderBy('appo_number', 'asc')->first();
                return redirect('/todaysession/'.$visitingId.'/'.$appointments->id);
                
            }
        }
    }
}
