<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\Subscribe;
use App\Models\Subscriber;
use App\Models\post;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class doctorBlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        if(Auth::user()->usertype == 'doctor'){
            Session('alert_1', '');
            $posts = Post::latest()->take(3)->get();
            $latest = Post::latest()->take(1)->get();
            $id = $latest[0]->user_id;
            $author = User::where('id', 1)->first()->get();

            return view('doctorBlog', [
                'posts' => $posts, 'latest' => $latest, 'authors' => $author,
            ]); 
        }
        else{
            return view('blog');
        }
       
    }

    public function update(Request $request){

        if ($request->has('form1')){
            
            return view('newblog');
        }
        else if($request->has('form2')){

        }
        else if($request->has('form3')){

        }
        else if($request->has('form4')){

            $validator = Validator::make($request->all(), [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:subscribers'],
            ]);

            if($validator->fails()){
                Session::flash('alert_1', 'Already Subscribed or Invalid Email Entered!');
                return view('doctorBlog');
            }
            else{
                $email = $request->all()['email'];
                $subscriber = Subscriber::create([
                 'email' => $email
                 ]); 
     
                 if ($subscriber) {
                     Mail::to($email)->send(new Subscribe($email));
                     Session::flash('alert_1', 'Subscription Success! Check Inbox');
                     return view('doctorBlog');
                 }
            }

        }
    }
}
