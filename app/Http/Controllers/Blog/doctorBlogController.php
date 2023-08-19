<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\Subscribe;
use App\Models\Subscriber;
use App\Models\post;
use App\Models\User;
use App\Models\comment;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Exception;

class doctorBlogController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){

        if(Auth::user()->usertype == 'doctor'){
            $posts = Post::latest()->take(3)->get();
            $latest = Post::latest()->take(1)->get();
            return view('blog.doctorBlog', [
                'posts' => $posts, 'latest' => $latest, 
            ]); 
        }
        else{
            return view('blog.blog');
        }
    }

    public function update(Request $request){

        if ($request->has('form1')){
            return view('blog.newblog');
        }
        else if($request->has('form2')){
            if(User::find(Auth::user()) == null){
                return redirect()->back()->with('error', 'Please Log into Comment on Posts!');
            }
            else{
                $validator = Validator::make($request->all(), [
                    'comment' => 'required',
                ]);

                if($validator->fails()){
                    return redirect()->back()->with('error', 'No Comment Entered!');
                }
                else{
                    $latest = Post::latest()->take(1)->get();
                    $user = User::find(Auth::user());
                    $temp = new comment();
                    $temp['comment'] = $request['comment'];
                    $temp['user_id'] = $user[0]->id;
                    $temp['post_id'] = $latest[0]->id;
                    $temp->save();
                    return redirect()->back()->with('success', 'Comment Posted!'); 
                }
            
            }
        }
        else if($request->has('form3')){
            try{
                $postSearched= post::where('title', $request['search'])->get();
                $temp =  $postSearched[0]->id;
                return redirect('./blog/'.$temp);
            }
            catch(Exception $ex){
                return redirect()->back()->with('error', 'No Post Found!');
            }    

        }
        else if($request->has('form4')){
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:subscribers'],
            ]);

            if($validator->fails()){
                return redirect()->back()->with('error', 'Already Subscribed or Invalid Email!');
            }
            else{
                $email = $request['email'];
                $subscriber = Subscriber::create([
                 'email' => $email
                 ]); 
     
                if ($subscriber){
                    Mail::to($email)->send(new Subscribe($email));
                    return redirect()->back()->with('success', 'Subscription Success! Please Check your Inbox!');
                }
                else{
                    return redirect()->back()->with('error', 'Something Went Wrong!');
                }
            }

        }
    }
}
