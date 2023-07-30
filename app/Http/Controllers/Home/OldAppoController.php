<?php

namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OldAppoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($patientID, $appoID){
        return view('patient.oldappointments');
    }

    public function update($patientID, $appoID){

    }
}
