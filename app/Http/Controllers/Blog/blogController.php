<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Models\post;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\Subscribe;
use App\Models\comment;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class blogController extends Controller
{
    public function index(){

        if(Auth::user() == null ){
            Session('alert_1', '');
            Session('alert_2', '');
            $posts = Post::latest()->take(3)->get();
            $latest = Post::latest()->take(1)->get();
            $id = $latest[0]->user_id;
            $author = User::where('id', $id)->first()->get();
            return view('blog.blog', [
                'posts' => $posts, 'latest' => $latest, 'authors' => $author, 
            ]); 
        }
        else if(Auth::user()->usertype == 'doctor'){
            Session('alert_1', '');
            Session('alert_2', '');
            $posts = Post::latest()->take(3)->get();
            $latest = Post::latest()->take(1)->get();
            $id = $latest[0]->user_id;
            $author = User::where('id', $id)->first()->get();
            return view('blog.doctorBlog', [
                'posts' => $posts, 'latest' => $latest, 'authors' => $author, 
            ]); 

        }
        else if(Auth::user()->usertype == 'patient'){
            Session('alert_1', '');
            Session('alert_2', '');
            $posts = Post::latest()->take(3)->get();
            $latest = Post::latest()->take(1)->get();
            $id = $latest[0]->user_id;
            $author = User::where('id', $id)->first()->get();
            return view('blog.doctorBlog', [
                'posts' => $posts, 'latest' => $latest, 'authors' => $author, 
            ]); 
        }

    }

    public function update(Request $request){
        if ($request->has('form1')){
            if($request['comment'] == null){
                Session::flash('alert_2', 'No comment entered!');
            }
            else if(User::find(Auth::user()) == null){
                Session::flash('alert_2', 'Please log in to make comments!');
            }
            else{
                
                $validator = Validator::make($request->all(), [
                    'comment' => 'required',
                ]);

                if($validator->fails()){
                    Session::flash('alert_2', 'No Comment Entered!');
                }
                else{

                    $latest = Post::latest()->take(1)->get();
                    $id = $latest[0]->user_id;
                    $user = User::find(Auth::user());
                    $temp = new comment();
                    $temp['comment'] = $request['comment'];
                    $temp['user_id'] = $user[0]->id;
                    $temp['post_id'] = $latest[0]->id;

                    $temp->save();
                    Session('alert_2','');   
                }
            }

            $posts = Post::latest()->take(3)->get();
            $latest = Post::latest()->take(1)->get();
            $id = $latest[0]->user_id;
            $author = User::where('id', $id)->first()->get();
            return view('blog.blog', [
                'posts' => $posts, 'latest' => $latest, 'authors' => $author, 
            ]);
            
        }
        else if($request->has('form2')){
            $postSearched = post::where('title', $request['search']);
            if($postSearched != null){
                $postSearched= post::where('title', $request['search'])->get();
                $temp =  $postSearched[0]->id;
                return redirect('./blog/'.$temp);
            }
            else{
                Session::flash('alert_3', 'No Blog Post Found!');
                $posts = Post::latest()->take(3)->get();
                $latest = Post::latest()->take(1)->get();
                $id = $latest[0]->user_id;
                $author = User::where('id', $id)->first()->get();
                return view('blog.blog', [
                    'posts' => $posts, 'latest' => $latest, 'authors' => $author, 
                ]);
            }

        }
        else if($request->has('form3')){

            $validator = Validator::make($request->all(), [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:subscribers'],
            ]);

            if($validator->fails()){
                Session::flash('alert_1', 'Already Subscribed or Invalid Email Entered!');
                $posts = Post::latest()->take(3)->get();
                $latest = Post::latest()->take(1)->get();
                $id = $latest[0]->user_id;
                $author = User::where('id', $id)->first()->get();
                return view('blog.blog', [
                    'posts' => $posts, 'latest' => $latest, 'authors' => $author, 
                ]);
                return view('blog.doctorBlog');
            }
            else{
                $email = $request->all()['email'];
                $subscriber = Subscriber::create([
                 'email' => $email
                 ]); 
     
                 if ($subscriber) {
                     Mail::to($email)->send(new Subscribe($email));
                     Session::flash('alert_1', 'Subscription Success! Check Inbox');
                     
                     if(Auth::user()->usertype == 'doctor'){
                        Session('alert_1', '');
                        $posts = Post::latest()->take(3)->get();
                        $latest = Post::latest()->take(1)->get();
                        $id = $latest[0]->user_id;
                        $author = User::where('id', 1)->first()->get();
            
                        return view('blog.doctorBlog', [
                            'posts' => $posts, 'latest' => $latest, 'authors' => $author,
                        ]); 
                    }
                    else{
                        $posts = Post::latest()->take(3)->get();
                        $latest = Post::latest()->take(1)->get();
                        $id = $latest[0]->user_id;
                        $author = User::where('id', $id)->first()->get();
                        return view('blog.blog', [
                            'posts' => $posts, 'latest' => $latest, 'authors' => $author, 
                        ]);
                        return view('blog.blog');
                    }
                    $posts = Post::latest()->take(3)->get();
                    $latest = Post::latest()->take(1)->get();
                    $id = $latest[0]->user_id;
                    $author = User::where('id', $id)->first()->get();
                    return view('blog.blog', [
                        'posts' => $posts, 'latest' => $latest, 'authors' => $author, 
                    ]);
                     return view('blog.doctorBlog');
                 }
            }

        }

    }
}
