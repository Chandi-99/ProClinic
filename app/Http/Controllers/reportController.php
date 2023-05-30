<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Report;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class reportController extends Controller
{
    public function index()
    {
        //$user = auth()->user()->Patient();
       // $reports = Auth::user()->Patient()->Reports()->orderBy('created_at', 'desc')->get();
        $images = auth()->user()->Patient->Reports;
        return view('Reports', compact('images'));
    }

    public function updateReports(Request $request)
    {
        // Validate the form input
        $request->validate([
            'report' => 'required|max:2048', // Assuming you want to restrict file types to images (JPEG, PNG, etc.) and a maximum file size of 2MB
            'report_name' => 'required|unique',
            'visibility' => 'required',
        ]);

        // Process the uploaded image
        $image = $request->file('report');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);

        // Save the image file name to the user's profile (you'll need to adjust this based on your user model and database structure)
        $report = Report::create([
            'report_name' => $request['report_name'],
            'date' => $request['date'],
            'visibility' => $request['visibility'],
            'image_path' => $image,
        ]);

        $report->save();

        return redirect()->back()->with('success', 'Profile image updated successfully!');

        //$section->touch();
    }
}
