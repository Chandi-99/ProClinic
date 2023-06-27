<?php

namespace App\Http\Controllers;

use App\Models\Nurse;
use App\Models\Holiday;
use App\Models\Nurse_Room;
use App\Models\Room;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\isEmpty;

class assignNurseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $usertype = Auth::user()->usertype;
        
        if($usertype == 'patient'){
            return view('home');
        }
        else if($usertype == 'admin'){
            return view('admindashboard');
        }
        else if($usertype == 'doctor'){
            return view('doctordashboard');
        }
        else{ 

            Session::flash('alert_2', '');
            $today = date('Y-m-d');
            $nurses = Nurse::orderByDesc('created_at')->get();
            $rooms = Room::orderByDesc('created_at')->get();
            $data = Nurse_Room::where('date', '=', $today)->get();

            return view('assignNurse', [
                'nurses' => $nurses, 'rooms' => $rooms, 'data' => $data,
            ]);
        }
    }

    public function store(Request $request){
        $holiday = Holiday::all();
        $validator = Validator::make($request->all(), [
            'nurse' => ['required', 'string', 'max:30'],
            'room' => ['required', 'string', 'max:20'],
            'session' => ['required', 'string', 'max:20'],
            'date' => ['required', 'date', 'after:yesterday'],
        ]);

        foreach ($holiday as $holiDay) {
            if($request['date'] == $holiDay){
                Session::flash('alert_2', $request['date'].' is a holiday.');
                
                $today = date('Y-m-d');
                $nurses = Nurse::orderByDesc('created_at')->get();
                $rooms = Room::orderByDesc('created_at')->get();
                $data = Nurse_Room::where('date', '=', $today)->get();
            
                return view('assignNurse', [
                    'nurses' => $nurses, 'rooms' => $rooms, 'data' => $data,
                ]);
            }
        }

        $nurse = $request['nurse'];
        $values = explode(' ', $nurse);
        $fname = $values[0];
        $lname = $values[1];

        $nurseSelected = Nurse::where('fname', '=', $fname)
                            ->Where('lname', '=', $lname)
                            ->get();
        
        $room = $request['room'];
        $roomSelected = Room::where('room_name', '=', $room)->get();

        foreach($nurseSelected as $nurse){
            foreach($roomSelected as $room){
                $status = Nurse_Room::where('date', '=', $request['date'])
            ->Where('room_id', '=', $room->id)
            ->where('session', '=', $request['session'])
            ->get();
            }
        }

        //echo $status;
        if(count($status) > 0){

            Session::flash('alert_2', 'Someone is already assigned for that room.');      
            $today = date('Y-m-d');
            $nurses = Nurse::orderByDesc('created_at')->get();
            $rooms = Room::orderByDesc('created_at')->get();
            $data = Nurse_Room::where('date', '=', $today)->get();
            
            return view('assignNurse', [
                'nurses' => $nurses, 'rooms' => $rooms, 'data' => $data,
            ]);
        }else{

            if ($validator->fails()) {
                Session::flash('alert_2', 'Nurse Assignment to a Room Unsuccessful. Invalid date choosed!');
                $today = date('Y-m-d');
                $nurses = Nurse::orderByDesc('created_at')->get();
                $rooms = Room::orderByDesc('created_at')->get();
                $data = Nurse_Room::where('date', '=', $today)->get();
                
                return view('assignNurse', [
                    'nurses' => $nurses, 'rooms' => $rooms, 'data' => $data,
                ]);
    
            }
            else{     
            
                foreach($nurseSelected as $nurse){
                    foreach($roomSelected as $room){
                        $nurseRoom = Nurse_Room::create([
                            'nurse_id' => $nurse->id,
                            'room_id' => $room->id,
                            'session'=> $request['session'],
                            'date'=> $request['date'],
                         ]);
            
                        $nurseRoom->save(); 
        
                        Session::flash('alert_2', 'Nurse Assign to the Room Successfully!');
                        $today = date('Y-m-d');
                        $nurses = Nurse::orderByDesc('created_at')->get();
                        $rooms = Room::orderByDesc('created_at')->get();
                        $data = Nurse_Room::where('date', '=', $today)->get();
                        
                        return view('assignNurse', [
                            'nurses' => $nurses, 'rooms' => $rooms, 'data' => $data,
                        ]);
                    }
                }

    
            }

        }
    }
}
