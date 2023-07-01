@extends('layouts.app')
@section('content')
@php
use Illuminate\Support\Facades\Storage;
@endphp

<main>

    <div class="container">
    <h6 class="text-center">{{Auth::user()->patient->fname}} Reports</h6>
    <p  style="display:inline; font-weight:bold;font-size:18px;">Patient Name: </p><p style="display:inline;">{{Auth::user()->patient->fname}} {{Auth::user()->patient->lname}}</p></br>
    <p  style="display:inline;font-weight:bold;font: size 18px;">Date of Birth: </p><p style="display:inline;">{{Auth::user()->patient->dob}} </p></br>
    <p  style="display:inline;font-weight:bold;font-size:18px;">Gender: </p><p style="display:inline;">{{Auth::user()->patient->gender}} </p>
    </br></br>
    <div class="row">
    @if ($reports)
        <h7 style="display:inline;font-weight:bold;font-size:17px;">Saved Reports Images:</h7>
        <div>
            @foreach ($reports as $report)
                <p>{{$report->report_name}}</p>
                <img src="{{ url('public/Reports/'.$report->image_path) }}" alt="User Report" style="width: 200px; height: auto;" />               
            @endforeach
        </div>
    @else
        <p>No any Report saved yet.</p>
    @endif
    </div>

    </br>
    <div class="row">
    @if ($pdfreports)
        <h7 style="display:inline;font-weight:bold;font-size:17px;">Saved Reports PDFs:</h7>
        <div>
            @foreach ($pdfreports as $pdfreport)
                <a href="http:8000/{{$pdfreport->path}}"> {{$pdfreport->pdfreport_name}}</a>      
            @endforeach
        </div>
    @else
        <p>No any Report saved yet.</p>
    @endif
    </div>

    @if (session('alert_2'))
        <div class="alert alert-danger">
            {{ session('alert_2') }}
        </div>
    @endif
    <form method="POST" action="{{ route('user.reports.update') }}" enctype="multipart/form-data">
        @csrf
        <h6 class="text-center">Upload New Report:</h6>
        <div class="col-lg-6 col-12 ">
            <label>Report Name: </label><input type="text" name="report_name" class="form-control form-control-lg" value="ECG Report" style="font-size:medium;" required/>
            </div>
            </br>
            <div class="col-lg-6 col-12 ">
            <label>Visibility: </label><select id="visibility" type="text" class="form-control form-control-lg" name="visibility" style="font-size:medium;" required >
                <option>Private</option>
                <option>Allow for Doctors</option>
            </select>
            </div>
            </br>
            <div class="col-lg-6 col-12 ">
            <label>Upload Report: </label><input type="file" name="report" id="report" class="form-control form-control-lg" style="font-size:medium;" required>
            </div>
            </br>

            <button type="submit"  class="custom-btn">Upload Report</button>
    </form>
    </div>
</main>

@endsection