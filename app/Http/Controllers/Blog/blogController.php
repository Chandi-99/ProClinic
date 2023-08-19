<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Models\post;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\Subscribe;
use App\Models\comment;
use App\Models\Subscriber;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class blogController extends Controller
{
    public function index(){

        if(Auth::user() == null ){
            $posts = Post::latest()->take(3)->get();
            $latest = Post::latest()->take(1)->get();
            return view('blog.blog', [
                'posts' => $posts, 'latest' => $latest, 
            ]); 
        }
        else if(Auth::user()->usertype == 'doctor'){
            $posts = Post::latest()->take(3)->get();
            $latest = Post::latest()->take(1)->get();
            return view('blog.doctorBlog', [
                'posts' => $posts, 'latest' => $latest, 
            ]); 

        }
        else if(Auth::user()->usertype == 'patient'){
            $posts = Post::latest()->take(3)->get();
            $latest = Post::latest()->take(1)->get();
            return view('blog.blog', [
                'posts' => $posts, 'latest' => $latest,
            ]); 
        }

    }

    public function update(Request $request){
        if ($request->has('form1')){
            if(User::find(Auth::user()) == null){
                return redirect()->back()->with('error', 'Please logging to make Comments!');
            }
            else{
                
                $validator = Validator::make($request->all(), [
                    'comment' => 'required',
                ]);

                if($validator->fails()){
                    return redirect()->back()->withErrors($validator);
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
        else if($request->has('form2')){
            try{
                $postSearched= post::where('title', $request['search'])->get();
                $temp =  $postSearched[0]->id;
                return redirect('./blog/'.$temp);
            }
            catch(Exception $ex){
                return redirect()->back()->with('error', 'No Post Found!');
            }         

        }
        else if($request->has('form3')){
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:subscribers'],
            ]);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator);
            }
            else{
                $email = $request->all()['email'];
                $subscriber = Subscriber::create([
                 'email' => $email
                 ]); 
     
                 if ($subscriber) {
                    try{
                        Mail::to($email)->send(new Subscribe($email));
                    }
                    catch(Exception $ex){
                        return redirect()->back()->with('error', 'Already Subscribed or Invalid Email!');
                    }
                }

            }
        }

    }
}
