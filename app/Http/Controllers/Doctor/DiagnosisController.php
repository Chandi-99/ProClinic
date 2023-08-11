<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use app\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
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
            return view('patient.home');
        } else if ($usertype == 'admin') {
            return view('admin.admindashboard');
        } else if ($usertype == 'doctor') {

            $doctor = Doctor::where('user_id', $userId)->first()->get();
            $docname = $doctor[0]->fname . ' ' . $doctor[0]->lname;
            $speciality = $doctor[0]->specialization;
            $today = Carbon::today();
            $day = $today->format('l');
            $today = $today->format('Y-m-d');

            $visiting = Visitings::where('id', $visitingId)
                ->where('day', $day)
                ->count();

            return view('doctor.diagnosis');

        } else {
            return redirect('/staff');
        }
    }

    public function update(){
        return view('doctor.diagnosis');
    }
}
