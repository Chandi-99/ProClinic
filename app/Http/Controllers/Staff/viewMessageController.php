<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Contact;
use App\Models\Message;

class viewMessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $messages = Contact::all();
        $texts = Chat::all();
        return view('staff.viewmessages',['messages' => $messages,'texts' => $texts, 'reload'=> 'no']);
    }

    public function search(Request $request){
        if($request['status'] == 'All'){
            $messages = Contact::all();
            $texts = Chat::all();
            return view('staff.viewmessages',['messages' => $messages, 'texts' => $texts, 'reload'=> 'all']);
        }
        else if($request['status'] == 'Unread'){
            $messages = Contact::where('status', 'unread')->first();
            $texts = Chat::where('status', 'unread')->first();
            if(!empty($messages)){
                $messages = Contact::where('status', 'unread')->get();
                if(!empty($texts)){
                    $texts = Chat::where('status', 'unread')->get();
                    return view('staff.viewmessages',['messages' => $messages, 'texts' => $texts,'reload'=> 'unread']);
                }
                else{
                    $messages = [];
                    return view('staff.viewmessages',['messages' => $messages, 'texts' => $texts,'reload'=> 'unread']);
                }
            }
            else{
                if(!empty($texts)){
                    $texts = Chat::where('status', 'unread')->get();
                    return view('staff.viewmessages',['messages' => $messages, 'texts' => $texts,'reload'=> 'unread']);
                }
                else{

                    return view('staff.viewmessages',['messages' => $messages, 'texts' => $texts,'reload'=> 'unread']);
                }
            }
        }
        else if($request['status'] == 'Read'){
            $messages = Contact::where('status', 'read')->first();
            $texts = Chat::where('status', 'read')->first();
            if(!empty($messages)){
                $messages = Contact::where('status', 'read')->get();
                if(!empty($texts)){
                    $texts = Chat::where('status', 'read')->get();
                    return view('staff.viewmessages',['messages' => $messages, 'texts' => $texts,'reload'=> 'unread']);
                }
                else{
                    return view('staff.viewmessages',['messages' => $messages, 'texts' => $texts,'reload'=> 'unread']);
                }

            }
            else{
                if(!empty($texts)){
                    $texts = Chat::where('status', 'read')->get();
                    return view('staff.viewmessages',['messages' => $messages, 'texts' => $texts,'reload'=> 'unread']);
                }
                else{
                    return view('staff.viewmessages',['messages' => $messages, 'texts' => $texts,'reload'=> 'unread']);
                }
            }
        }
    }

    public function allread(){
        $messages = Contact::all();
        $texts = Chat::all();
        foreach($messages as $message){
            $message->update(['status' => 'read']);
        }

        foreach($texts as $text){
            $text->status = 'read';
            $text->save();
        }

        return redirect('/viewMessages')->with('success', "Mark All Messages as Read!");
    }

    public function allunread(){
        $messages = Contact::all();
        $texts  =Chat::all();
        foreach($messages as $message){
            $message->update(['status' => 'unread']);
        }

        foreach($texts as $text){
            $text->status = 'unread';
            $text->save();
        }
        return redirect('/viewMessages')->with('success', "Mark All Messages as Unread!");
    }


}
