<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Models\post;
use App\Http\Controllers\Controller;
use App\Models\User;

class blogController extends Controller
{
    public function index(){

        Session('alert_1', '');
        $posts = Post::latest()->take(3)->get();
        $latest = Post::latest()->take(1)->get();
        $author = User::where('id', 1)->first()->get();

        return view('blog.blog', [
            'posts' => $posts, 'latest' => $latest, 'authors' => $author,
        ]); 
    }

    public function update(Request $request){


    }
}
