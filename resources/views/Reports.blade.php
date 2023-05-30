@extends('layouts.app')
@section('content')

<main>

    <div class="container">
    <h5 class="text-center">Patient Reports</h5>
    <p  style="display:inline; font-weight:bold;font-size:20px;">Patient Name: </p><p style="display:inline;">{{Auth::user()->patient->fname}} {{Auth::user()->patient->lname}}</p></br>
    <p  style="display:inline;font-weight:bold;font-size:20px;">Date of Birth: </p><p style="display:inline;">{{Auth::user()->patient->dob}} </p></br>
    <p  style="display:inline;font-weight:bold;font-size:20px;">Gender: </p><p style="display:inline;">{{Auth::user()->patient->gender}} </p>
    @if ($images->count() > 0)
        <h2>Saved Reports:</h2>
        <div>
            @foreach ($images as $image)
                <img src="{{ asset('images/' . $image->filename) }}" alt="User Image" style="width: 200px; height: auto;">
            @endforeach
        </div>
    @else
        <p>No any Report saved yet.</p>
    @endif

    <form method="POST" action="{{ route('user.reports.update') }}" enctype="multipart/form-data">
        @csrf
       
            <h6 for="image">Upload New Report:</h6>
            <div class="col-lg-6 col-12 ">
            <label>Report Name: </label><input type="text" name="report_name" class="form-control form-control-lg" placeholder="Name for Your Report" />
            </div>
            </br>
            <div class="col-lg-6 col-12 ">
            <label>Visibility: </label><select id="visibility" type="text" class="form-control form-control-lg" name="visibility"  required >
                <option>Private</option>
                <option>Allow for Doctors</option>
            </select>
            </div>
            </br>
            <div class="col-lg-6 col-12 ">
            <label>Upload Report: </label><input type="file" name="report" id="report" class="form-control form-control-lg">
            </div>
            </br>

            <button type="submit"  class="custom-btn">Upload Report</button>
    </form>
    </div>
</main>

@endsection