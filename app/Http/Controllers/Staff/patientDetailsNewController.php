<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class patientDetailsNewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {

            Session::flash('alert_2', '');
            $usertype = Auth::user()->usertype;

            if ($usertype == 'patient') {
                return view('patient.home');
            } else if ($usertype == 'staff') {
                $patients = Patient::all();
                return view('staff.patientsdetails', ['patients' => $patients]);
            } else if ($usertype == 'doctor') {
                return view('doctor.doctordashboard');
            } else {
                return view('admin.admindashboard');
            }
        } catch (Exception $ex) {
            Session::flash('error', 'Exception Occured!');
            $patients = Patient::all();
            return view('staff.patientsdetails', ['patients' => $patients]);
        }
    }

    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname' => ['required', 'string', 'max:20'],
            'lname' => ['required', 'string', 'max:20'],
        ]);

        if ($validator->fails()) {

            $patients = Patient::all();
            Session::flash('error', 'Invalid First name or Last name');

            return view('staff.patientsdetails', [
                'patients' => $patients,
            ]);
        } else {
            $patients = Patient::where('fname', $request['fname'])->where('lname', $request['lname'])->first();
            if (!empty($patients)) {
                $patients = Patient::where('fname', $request['fname'])->where('lname', $request['lname'])->get();
                Session::flash('success', 'Patient Found!');
                return view('staff.patientsdetails', [
                    'patients' => $patients,
                ]);
                
            } else {
                return redirect()->back()->with('error', 'There is No patient registered for that name');
            }
        }
    }
}
