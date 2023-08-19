<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class doctorDetailsController extends Controller
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
                    $doctors = Doctor::all();
                    return view('admin.doctordetails', ['doctors' => $doctors]);
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
            Session::flash('error', $ex->getMessage());
            $doctors = Doctor::all();
            return view('admin.doctordetails', ['doctors' => $doctors]);
        }
    }

    public function search(Request $request){
        $validator = Validator::make($request->all(), [
            'fname' => ['required', 'string', 'max:20'],
            'lname' => ['required', 'string', 'max:20'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);

        } else {
            $doctors = Doctor::where('fname', $request['fname'])->where('lname', $request['lname'])->first();
            if (!empty($doctors)) {
                $doctors = Doctor::where('fname', $request['fname'])->where('lname', $request['lname'])->get();
                return view('admin.doctordetails', [
                    'doctors' => $doctors
                ]);
            } else {
                return redirect()->back()->with('error', 'There is No Doctor registered for that name');
            }
        }
    }
}
