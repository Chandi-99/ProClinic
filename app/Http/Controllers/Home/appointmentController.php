<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Visitings;
use App\Http\Controllers\Controller;

class appointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id){

        $doctors = Doctor::all();
        $specialities = Doctor::select('specialization')->distinct()->get();
        return view('patient.appointment', ['doctors' => $doctors, 'specialities'=> $specialities]);
    }

    public function update($id){

        $doctors = Doctor::all();
        return view('patient.appointment', ['doctors' => $doctors]);
    }
}
