<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class doctorDashboardController extends Controller
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
            if ($request->ajax()) {
                // Get the data from the database.
                $data = User::all();
        
                // Return the data in JSON format.
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function (User $user) {
                        return view('datatable.action', compact('user'));
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('doctordashboard');
        }
        else{ 
            if ($request->ajax()) {
                // Get the data from the database.
                $data = User::all();
        
                // Return the data in JSON format.
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function (User $user) {
                        return view('datatable.action', compact('user'));
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('staffdashboard');
        }
    }
}
