<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nurse;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Room;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class newStaffController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        try {
            if(Auth::check()){
                $usertype = Auth::user()->usertype;
                if ($usertype == 'patient') {
                    return redirect('/home');
                } else if ($usertype == 'admin') {
                    $nurses = Nurse::all();
                    $staffmembers = Staff::all();
                    $rooms = Room::withCount('visitings')->get();
                    return view('admin.staffroom', ['nurses' => $nurses, 'staffmembers' => $staffmembers, 'rooms' => $rooms]);
                } else if ($usertype == 'doctor') {
                    return redirect('/doctor');
                } else {
                    return redirect('/welcome');
                }
            }
            else{
                return redirect('/welcome');
            }
        } catch (Exception $ex) {
            return redirect()->back()->with($ex->getMessage());
        }
    }

    public function create(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'fname' => ['required', 'string', 'max:20'],
                'lname' => ['required', 'string', 'max:20'],
                'dob' => ['required', 'date', 'before:1995-01-01', 'after:1943-01-01'],
                'regNum' => ['required', 'string', 'max:15', 'unique:staff'],
                'gender' => ['required', 'string', 'max:10'],
                'position' => ['required', 'string', 'max:15'],
                'contact' => ['required', 'max:20', 'unique:nurses'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            if ($validator->fails()){
                return redirect()->back()->withErrors($validator);
            }
            else{     
                $user = User::create([
                    'name' => $request['fname'],
                    'email' => $request['email'],
                    'usertype' => "staff",
                    'password' => Hash::make($request['password']),
                ]);
                $user->save();
                $userid = DB::connection()->getPdo()->lastInsertId();
                $staff = Staff::create([
                    'fname' => $request['fname'],
                    'lname'=> $request['lname'],
                    'contact'=> $request['contact'],
                    'regNum'=> $request['regNum'],
                    'position'=> $request['position'],
                    'gender'=> $request['gender'],
                    'dob'=> $request['dob'],
                    'user_id' => $userid,
                 ]);
                $staff->save();  
                return redirect('/newStaff')->with('success', 'Nurse Account Creation Successful!');
            }
        }
        catch(Exception $ex){
            return redirect()->back()->withErrors($ex->getMessage());
        }

    }
}
