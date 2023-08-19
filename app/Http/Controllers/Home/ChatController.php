<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Chat;

class ChatController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $userID = Auth::user()->id;
        $usertype = Auth::user()->usertype;
        if($usertype == 'patient'){
            $message = Chat::where('user_id', $userID)->orderBy('created_at', 'asc')->first();
            if(!empty($message)){
                $messages = Chat::where('user_id', $userID)->orderBy('created_at', 'asc')->get();
                return view('patient.patientchat', ['messages' => $messages]);
            }
            else{
                $messages = [];
                return view('patient.patientchat', compact('messages'));
            }
        }
        else{
            return redirect()->back()->with('invalid user type. You don\'t have authority to view this page!');
        }
    }

    public function send(Request $request){
        $userID = Auth::user()->id;
        $message = new Chat();
        $message->user_id = $userID;
        $message->message = $request['message'];
        $message->status = 'unread';
        $message->sender_id = 'patient';
        $message->save();
        return redirect()->back();
    }

    public function clearChat(){
        $userID = Auth::user()->id;
        $message = Chat::where('user_id', $userID)->orderBy('created_at', 'asc')->first();
        if(!empty($message)){
            $messages = Chat::where('user_id', $userID)->orderBy('created_at', 'asc')->get();
            foreach($messages as $message)
                $message->delete();
            return redirect('/chat')->with('success', 'Chat Cleared!');
        }
        else{
            return redirect('/chat')->with('success', 'Nothing to Clear!');
        }
    }
}
