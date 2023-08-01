<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use app\Models\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Visitings;

class doctorDashboardController extends Controller
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
        else if($usertype == 'doctor'){

            $doctor = Doctor::where('user_id', Auth::user()->id)->first()->get();
            $docname = $doctor[0]->fname.' '.$doctor[0]->lname;
            $speciality = $doctor[0]->specialization;
            $visitings = Visitings::where('doctor_id', $doctor[0]->id)->first()->get();
            $appoArray = [];
            $i=0;
            foreach($visitings as $visiting){
                $appo = Appointment::where('visiting_id', $visiting->id)->where('status', 'pending')->get();
                $appoArray[$i++] = $appo;
            }
            //dd($appoArray[0][0]->id);
            $i =0;
            foreach($appoArray as $array){
                $i++;
            }
            return view('doctor.doctordashboard', ['appointments' => $appoArray, 'length' => $i, 'docname' => $docname, 'speciality' => $speciality]);
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
