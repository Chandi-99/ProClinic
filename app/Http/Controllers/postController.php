<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\post;
use App\Models\Report;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class postController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        Session::flash('alert_1', '');
        return view('newblog');
    }

    public function create(Request $request){

         // Validate the form input
         $validator = Validator::make($request->all(), [
            'image' => 'required|file|mimes:jpeg,jpg,png|max:2048',
            'body' => 'required',
            'title' => 'required| unique:posts',
        ]);

        if($validator->fails()){
            Session::flash('alert_1', 'Post Creation Unsuccessful!');
            return view('newblog');
        }
        else{
            $user = User::find(Auth::user()->id);

            if($request['image']) {
    
                $path = $request->file('image')->storeAs('blogimages', $request->file('image')->getClientOriginalName());
                $temp = $request->file('image')->getClientOriginalName();
               $sql = DB::update('update posts set `posts`.`image` ='.'"'.$temp.'"'.' where `posts`.`user_id`='.'"'.$user->id.'";');
    
                // Insert record
                $insertData_arr = array(
                    'title' => $request['title'],
                    'body' => $request['body'],
                    'user_id'=> $user->id,
                    'image' => $request->file('image')->getClientOriginalName()             
                );
    
                post::create($insertData_arr);
    
                Session::flash('alert_1', 'Post Creation Successful!');
                
                return view('newblog');
    
            }

        }
    
    }
}
