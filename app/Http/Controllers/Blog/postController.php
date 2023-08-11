<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\NewPostAlert;
use App\Models\subscriber;
use App\Models\post;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class postController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('blog.newblog');
    }

    public function create(Request $request){

         // Validate the form input
         $validator = Validator::make($request->all(), [
            'image' => 'required|file|mimes:jpeg,jpg,png|max:4096',
            'body' => 'required',
            'title' => 'required| unique:posts',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        else{
            $user = User::find(Auth::user()->id);

            if($request['image']) {

                $data= new post();
                if($request->file('image')){
                    $file= $request->file('image');
                    $filename= date('YmdHi').$file->getClientOriginalName();
                    $file-> move(public_path('public/BlogImages'), $filename);
                    $data['image']= $filename;
                    $data['title'] = $request['title'];
                    $data['body'] = $request['body'];
                    $data['user_id'] = $user->id;
                }

                $today = Carbon::now();
                $date = $today->format('Y-m-d');
                $time = $today->format('h:i A');
                $data->save();
                $emails = Subscriber::all();
                foreach($emails as $email){
                    Mail::to($email)->send(new NewPostAlert(
                        $email,
                        $request['title'],
                        $date,
                        $time
                    ));
                }
                return redirect('/doctorblog')->with('success', 'Post Uploaded!');
    
            }

        }
    
    }
}
