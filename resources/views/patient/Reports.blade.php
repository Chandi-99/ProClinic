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


    <form method="POST" action="{{ route('user.reports.update') }}" enctype="multipart/form-data">
    @csrf
    @if ($reports)
        <h7 style="display:inline;font-weight:bold;font-size:17px;" class="text-danger">Saved Reports Images:</h7>
        <div class="row">
            @foreach ($reports as $report)
            <div class="col-sm-6 col-md-4 mb-3 align-items-center">
                <p style="font-size:15px;font-weight:bold;" class="text-primary">{{$report->report_name}}</p>
                <a href="/user/reports/{{$report->id}}"type="submit" class="btn btn-danger">Delete</a>
                <img  src="{{ url('public/Reports/'.$report->image_path) }}" class="fluid img-thumbnail imgzoom" />     
            </div>
            @endforeach
        </div>
    @else
        <p>No any Report saved yet.</p>
    @endif
    </br>
    @if ($pdfreports)
        <h7 style="display:inline;font-weight:bold;font-size:17px;" class="text-danger">Saved Reports PDFs:</h7>
        <div class="row ">
            @foreach ($pdfreports as $pdfreport)
            <div class="col-sm-6 col-md-4 mb-3 align-items-center">
                <p style="font-size:15px;font-weight:bold;" class="text-primary">{{$pdfreport->pdfreport_name}}</p>
                <a href="/user/pdfreports/{{ $pdfreport->id }}" class="btn btn-danger" style="font-size:15px;font-weight:bold;">Delete</a>
                </br>
                <iframe src="/public/PDFReports/{{$pdfreport->path}}" class="fluid img-thumbnail" ></iframe>      
            </div>
            @endforeach
        </div>
    @else
        <p>No any Report saved yet.</p>
    @endif
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
            <a href="/home" class="btn btn-outline-primary btn-sm m-2">Go back</a>
            <button type="submit" name="form3" class="custom-btn">Upload Report</button>     
    </form>
    </div>
</main>

@endsection