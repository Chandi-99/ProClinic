<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrescriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){

    }

    public function download(){
        
    }
}
