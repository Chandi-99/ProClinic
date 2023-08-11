<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class staffChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($patientID)
    {
        $staffID = Auth::user()->id;
        $usertype = Auth::user()->usertype;
        if ($usertype == 'staff') {
            $message = Chat::where('user_id', $patientID)->orderBy('created_at', 'asc')->first();
            if (!empty($message)) {
                $messages = Chat::where('user_id', $patientID)->orderBy('created_at', 'asc')->get();
                return view('staff.staffchat', ['messages' => $messages, 'patientID' => $patientID]);
            } else {
                $messages = [];
                return view('staff.staffchat', ['messages' => $messages]);
            }
        } else {
            return redirect()->back()->with('invalid user type. You don\'t have authority to view this page!');
        }
    }

    public function send(Request $request, $patientID)
    {
        $message = new Chat();
        $message->user_id = $patientID;
        $message->message = $request['message'];
        $message->status = 'unread';
        $message->sender_id = 'staff';
        $message->save();
        return redirect()->back();
    }
}
