<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;

class viewMessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $messages = Contact::all();
        return view('staff.viewmessages',['messages' => $messages, 'reload'=> 'no']);
    }

    public function search(Request $request){
        if($request['status'] == 'All'){
            $messages = Contact::all();
            return view('staff.viewmessages',['messages' => $messages, 'reload'=> 'all']);
        }
        else if($request['status'] == 'Unread'){
            $messages = Contact::where('status', 'unread')->first();
            if(!empty($messages)){
                $messages = Contact::where('status', 'unread')->get();
                return view('staff.viewmessages',['messages' => $messages, 'reload'=> 'unread']);
            }
            else{
                return redirect()->back()->with('error', 'There are no Unreaded Messages!');
            }
        }
        else if($request['status'] == 'Read'){
            $messages = Contact::where('status', 'read')->first();
            if(!empty($messages)){
                $messages = Contact::where('status', 'read')->get();
                return view('staff.viewmessages',['messages' => $messages, 'reload'=> 'read']);
            }
            else{
                return redirect()->back()->with('error', 'There are no New Messages!');
            }
        }
    }

    public function allread(){
        $messages = Contact::all();
        foreach($messages as $message){
            $message->update(['status' => 'read']);
        }

        return redirect('/viewMessages')->with('success', "Mark All Messages as Read!");
    }

    public function allunread(){
        $messages = Contact::all();
        foreach($messages as $message){
            $message->update(['status' => 'unread']);
        }

        return redirect('/viewMessages')->with('success', "Mark All Messages as Unread!");
    }


}
