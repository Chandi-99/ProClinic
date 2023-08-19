<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Nurse;
use Illuminate\Support\Facades\Mail;
use App\Models\Holiday;
use App\Models\Nurse_Room;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Mail\NurseAssignment;

class assignNurseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::check()){
            $usertype = Auth::user()->usertype;
            if ($usertype == 'patient') {
                return redirect('/home');
            } else if ($usertype == 'admin') {
                return redirect('/admin');
            } else if ($usertype == 'doctor') {
                return redirect('/doctor');
            } else {
                $today = date('Y-m-d');
                $nurses = Nurse::orderByDesc('created_at')->get();
                $rooms = Room::orderBy('room_name', 'asc')->get();
                $data = Nurse_Room::where('date', $today)->get();
    
                return view('staff.assignNurse', [
                    'nurses' => $nurses, 'rooms' => $rooms, 'data' => $data,
                ]);
            }
        }
        else{
            return redirect('/welcome');
        }
       
    }

    public function store(Request $request)
    {
        $holiday = Holiday::all();
        $validator = Validator::make($request->all(), [
            'nurse' => ['required', 'string', 'max:30'],
            'room' => ['required', 'string', 'max:20'],
            'session' => ['required', 'string', 'max:20'],
            'date' => ['required', 'date', 'after:yesterday'],
        ]);

        foreach ($holiday as $holiDay) {
            if ($request['date'] == $holiDay) {
                return redirect()->back()->with('alert', $request['date'] . ' is a holiday.');
            }
        }

        $nurseSelected = Nurse::find($request['nurse']);
        $roomSelected = Room::find($request['room']);

        $status1 = Nurse_Room::where('date', $request['date'])
            ->Where('room_id', $roomSelected->id)
            ->where('session',  $request['session'])
            ->get();
        $status2 = Nurse_Room::where('date', $request['date'])
            ->where('session',  $request['session'])
            ->get();

        if (count($status1) > 0) {
            return redirect()->back()->with('error', 'Someone is already assigned for that room.');
        } 
        else if(count($status2) > 0){
            return redirect()->back()->with('error', 'Selected Nurse is already assigned for another room.');
        }
        else{

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors());
            } 
            else {

                $nurseRoom = Nurse_Room::create([
                    'nurse_id' => $nurseSelected->id,
                    'room_id' => $roomSelected->id,
                    'session' => $request['session'],
                    'date' => $request['date'],
                ]);

                $nurseRoom->save();
                $time = "";

                if ($request['session'] == 'Morning') {
                    $time = '07:30 AM';
                } else if ($request['session'] == 'Afternoon') {
                    $time = '11.30 PM';
                } else if ($request['session'] == 'Evening') {
                    $time = '02.30 PM';
                } else if ($request['session'] == 'Night') {
                    $time = '06.00 PM';
                }

                Mail::to($nurseSelected->email)->send(new NurseAssignment(
                    $nurseSelected->email,
                    $nurseSelected->fname,
                    $nurseSelected->lname,
                    $request['date'],
                    $time,
                    $roomSelected->room_name,
                    $request['session']
                ));

                return redirect()->back()->with('success', 'Nurse Assign to the Room Successfully!');
            }
        }
    }
}
