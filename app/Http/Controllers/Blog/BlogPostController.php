<?php

namespace App\Http\Controllers\Blog;

use App\Models\post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\comment;

class BlogPostController extends Controller
{
    public function index(int $id){
        $latest = post::where('id', $id)->get();
        Session('alert_2', '');
        if(!empty(Auth::user()) && Auth::user()->usertype == 'doctor'){
            return view('blog.showpost1', [
                'latest' => $latest
            ]);
        }
        else{
            return view('blog.showpost2', [
                'latest' => $latest
            ]);
        }

    }

    public function update(int $id, Request $request){
        if($request['comment'] == null){
            return redirect()->back()->with('error', 'No comment entered!');
        }
        else if(User::find(Auth::user()) == null){
            return redirect()->back()->with('alert', 'Please log in to make comments!');
        }
        else{
            
            $validator = Validator::make($request->all(), [
                'comment' => 'required',
            ]);

            if($validator->fails()){
                return redirect()->back()->with('error', 'No Comment Entered!');
            }
            else{

                $latest = post::where('id', $id)->get();
                $user = User::find(Auth::user());
                $temp = new comment();
                $temp['comment'] = $request['comment'];
                $temp['user_id'] = $user[0]->id;
                $temp['post_id'] = $latest[0]->id;

                $temp->save();
                Session('alert_2','');   
            }
        
        }

        return redirect()->back()->with('success', 'Comment Posted Successfully!');
    }
}
