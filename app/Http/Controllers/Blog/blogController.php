<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Subscribe;
use App\Models\Subscriber;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\post;
use App\Models\User;
use Nette\Utils\Image;

class blogController extends Controller
{
    public function index(){

        Session('alert_1', '');
        $posts = Post::latest()->take(3)->get();
        $latest = Post::latest()->take(1)->get();
        $id = $latest[0]->user_id;
        $author = User::where('id', 1)->first()->get();

        return view('doctorBlog', [
            'posts' => $posts, 'latest' => $latest, 'authors' => $author,
        ]); 
    }

    public function update(Request $request){


    }
}
