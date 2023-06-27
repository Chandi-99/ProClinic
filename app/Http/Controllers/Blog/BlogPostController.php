<?php

namespace App\Http\Controllers\Blog;

use App\Models\post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogPostController extends Controller
{
    public function index(int $id){
        $latest = post::where('id', $id)->get();
        //dd($latest);
         //echo $latest;
        return view('blog.showpost', [
            'latest' => $latest, 
        ]);
    }

    public function update(){
        //
    }
}
