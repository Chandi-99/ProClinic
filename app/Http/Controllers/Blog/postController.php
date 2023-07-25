<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\post;
use App\Models\User;
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
        Session::flash('alert_2', '');
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
            Session::flash('alert_1', 'Post Creation Unsuccessful!');
            return view('blog.newblog');
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
                $data->save();
                return redirect('/doctorblog');
    
            }

        }
    
    }
}
