<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use app\Models\User;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Support\Facades\Auth;
class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $usertype = Auth::user()->usertype;
        
        if($usertype == 'patient'){
            return view('patient.home');
        }
        else if($usertype == 'admin'){
            return view('admin.admindashboard');
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
            return view('staff.staffdashboard');
        }
    }
}
