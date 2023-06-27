<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Room;

class roomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $rooms = Room::all();

        return view('room', [
            'rooms' => $rooms,
        ]);
    }

    public function create(Request $request)
    {
        $room = new Room;
        $room->room_name = $request->input('name');
        $room->room_desc = $request->input('description');
        $room->save();

        $rooms = Room::all();

        return view('room', [
            'rooms' => $rooms,
        ]);
    }

    public function showNurse(){
        return view('newNurse');
    }

    public function assignNurse(){
        return view('assignNurse');
    }
}