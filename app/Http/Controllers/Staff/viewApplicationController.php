<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Candidate;
class viewApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $applications = Candidate::all();
        return view('staff.viewapplications',['applications' => $applications, 'reload'=> 'no']);
    }

    public function search(Request $request){
        if($request['status'] == 'All'){
            $applications = Candidate::all();
            return view('staff.viewapplications',['applications' => $applications, 'reload'=> 'all']);
        }
        else if($request['status'] == 'Unread'){
            $applications = Candidate::where('status', 'unread')->first();
            if(!empty($applications)){
                $applications = Candidate::where('status', 'unread')->get();
                return view('staff.viewapplications',['applications' => $applications, 'reload'=> 'unread']);
            }
            else{
                return redirect()->back()->with('error', 'There are no Unreaded applications!');
            }
        }
        else if($request['status'] == 'Read'){
            $applications = Candidate::where('status', 'read')->first();
            if(!empty($applications)){
                $applications = Candidate::where('status', 'read')->get();
                return view('staff.viewapplications',['applications' => $applications, 'reload'=> 'read']);
            }
            else{
                return redirect()->back()->with('error', 'There are no New applications!');
            }
        }
    }

    public function allread(){
        $applications = Candidate::all();
        foreach($applications as $application){
            $application->update(['status' => 'read']);
        }
        return redirect('/viewApplications')->with('success', "Mark All applications as Read!");
    }

    
    public function allunread(){
        $applications = Candidate::all();
        foreach($applications as $application){
            $application->update(['status' => 'unread']);
        }
        return redirect('/viewApplications')->with('success', "Mark All Messages as Unread!");
    }
}
