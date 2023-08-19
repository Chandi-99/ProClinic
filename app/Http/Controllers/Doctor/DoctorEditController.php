<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class DoctorEditController extends Controller
{
    public function index($userId){
        if(Auth::check()){
            $usertype = Auth::user()->usertype;
            if($usertype == 'patient'){
                return redirect('/home');
            }
            else if($usertype == 'doctor'){
                return redirect('/doctor');
            }
            else if($usertype == 'admin'){
                return redirect('/admin');
            }
            else if($usertype == 'staff'){
                try{
                    $username = User::where('id', $userId)->select('name')->get();
                    $doctor = Doctor::where('user_id', $userId)->first()->get();
                    return view('doctor.doctoredit',['doctor'=> $doctor, 'username'=>$username]);
                }
                catch(Exception $ex){
                    return redirect('/editDoctor/'.$userId)->withErrors($ex->getMessage());
                }        
            }
        }
        else{
            return redirect('/welcome');
        }
    }

    public function update(Request $request, $userId){
        $validator = Validator::make($request->all(), [
            'fname' => ['required', 'string', 'max:20'],
            'lname' => ['required', 'string', 'max:20'],
            'specialization' => ['required', 'string', 'max:15'],
            'echanneling_rate' => ['string','max:4'],
            'normal_rate' => ['required', 'string','max:4'],
            'contact' => ['required', 'max:10', 'min:10'],
        ]);
        if ($validator->fails()) {
            return redirect('/editDoctor/'.$userId)->withErrors($validator);
        }
        else{
            if($request['echanneling'] == 'No'){
                $erate = 0;
            }
            else{
                $erate = $request['echanneling_rate'];
            }

            $doctor = Doctor::where('user_id', $userId)->first();
            $doctor->fname = $request['fname'];
            $doctor->lname = $request['lname'];
            $doctor->contact = $request['contact'];
            $doctor->echanneling_rate = $erate;
            $doctor->normal_rate = $request['normal_rate'];
            $doctor->specialization = $request['specialization'];
            $doctor->save();
            return redirect('/editDoctor/'.$userId)->with('success', 'Account Information Updated Successfully!');

        }
    }
}
