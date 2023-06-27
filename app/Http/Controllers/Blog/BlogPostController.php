<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    public function index(int $id){
        $latest = post::where('id', $id)->get();
        //dd($latest);
         //echo $latest;
        return view('showpost', [
            'latest' => $latest, 
        ]);
    }

    public function update(){
        //
    }
}
