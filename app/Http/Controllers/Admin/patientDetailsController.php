<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class patientDetailsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            if(Auth::check()){
                $usertype = Auth::user()->usertype;
                if ($usertype == 'patient') {
                    return redirect('/home');
                } else if ($usertype == 'admin') {
                    $patients = Patient::all();
                    return view('admin.patientsdetails', ['patients' => $patients]);
                } else if ($usertype == 'doctor') {
                    return redirect('/doctor');
                } else {
                    return redirect('/staff');
                }
            }
            else{
                return redirect('/welcome');
            }    
        } catch (Exception $ex) {
            Session::flash('error', 'Exception Occured!');
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    public function search(Request $request){
        $validator = Validator::make($request->all(), [
            'fname' => ['required', 'string', 'max:20'],
            'lname' => ['required', 'string', 'max:20'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } 
        else {
            $patients = Patient::where('fname', $request['fname'])->where('lname', $request['lname'])->first();
            if (!empty($patients)) {
                $patients = Patient::where('fname', $request['fname'])->where('lname', $request['lname'])->get();
                Session::flash('success', 'Patient Found!');
                return view('admin.patientsdetails', [
                    'patients' => $patients,
                ]);
                
            } 
            else {
                return redirect()->back()->with('error', 'No Patient Found!');
            }
        }
    }
}
