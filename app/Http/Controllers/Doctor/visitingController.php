<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Visitings;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class visitingController extends Controller
{
    public function index(){
        $user = User::find(Auth::user()->id);
        $doctorid = $user->Doctor->id;
        $visitings = Visitings::where('doctor_id', $doctorid);
        if(empty($visitings)){
            return view('doctor.visiting', [
                'visitings' => $visitings,
            ]);
        }
        else{
            $visitings = Visitings::where('doctor_id', $doctorid)->get();
            return view('doctor.visiting', [
                'visitings' => $visitings,
            ]);
        }
        return view('doctor.visiting');
    }

    public function update(Request $request){

        $user = User::find(Auth::user()->id);
        $doctorid = $user->Doctor->id;

        $temp = Visitings::all();
        foreach($temp as $unique){
            if($unique->day == $request['day'] && $unique->session == $request['session'] && $unique->doctor_id == $doctorid ){
                Session::flash('alert_2', 'Session Already Registered!');
                return redirect('/doctor/visitings');
            }
        }
        $validator = Validator::make($request->all(), [
            'day' => 'required',
            'session' => 'required',
            'type' => 'required',
            'max_per_session' => 'required',  
        ]);
        if($validator->fails()){
            Session::flash('alert_2', $validator->errors());
            return redirect('/doctor/visitings');
        }
        else{
            
            $visitings = Visitings::where('day', $request['day'])
                                    ->where('session', $request['session'])
                                    ->get();
            $unavailableRooms = [];
            foreach ($visitings as $visiting) {
                $id = $visiting->room_id;
                if (!in_array($id, $unavailableRooms)) {
                    $unavailableRooms[] = $id;
                }
            }

            $availableRooms = 0;
            $allrooms = Room::all();
            foreach($allrooms as $room){
                if (!in_array($room->id, $unavailableRooms)) {
                    $availableRooms = $room->id;
                    break;
                }
            }
            if($availableRooms == 0){
                Session::flash('alert_2', 'No Rooms Available for that Time Slot');
                return redirect('/doctor/visitings');
            }
            else{

                $roomselected = Room::where('id', $availableRooms)->latest()->get();
                $data= new Visitings();
                $data->day = $request['day'];
                $data->session = $request['session'];
                $data->type = $request['type'];
                $data->doctor_id = $doctorid;
                $data->max_per_session = $request['max_per_session'];
                $data->room_id = $roomselected[0]->id;

                $data->save();
                Session::flash('alert_1', 'Visiting Added Successfully! Allocated Room is '.$roomselected[0]->room_name);
                return redirect('/doctor/visitings');
            }

        }
    }
}
