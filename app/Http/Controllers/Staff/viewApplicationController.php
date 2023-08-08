<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class viewApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('staff.viewapplications');
    }
    public function search(){
        return view('staff.viewapplications');
    }
}
