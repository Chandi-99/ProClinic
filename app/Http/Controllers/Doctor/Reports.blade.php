@extends('layouts.doctorlayout')
@section('content')
<section class="section-padding section-bg mt-0 pt-3">
    <div class="container ">
        <div class="row custom-text-box col-6 pt-2 mt-1" style="margin:0 auto;">
            <h5 class="text-center">{{$patient->fname}} {{$patient->lname}}'s Reports</h5>
            <label style="display:inline;font-size:18px;"><span style="font-weight:bold;">Patient Name: </span>{{$patient->fname}} {{$patient->lname}}</label>
            <label style="display:inline;font: size 18px;"><span style="font-weight:bold;">Date of Birth: </span>{{$patient->dob}} </label></br>
            <label style="display:inline;font-size:18px;"><span style="font-weight:bold;">Gender: </span>{{$patient->gender}} </label>
            <label style="display:inline;font-size:18px;"><span style="font-weight:bold;">Address: </span>{{$patient->address}} </label>
            <label style="display:inline;font-size:18px;"><span style="font-weight:bold;">Blood Group: </span>B+</label>
        </div>

        <div class="row custom-text-box col-12 mb-5">
            @if ($reports)
            <h5 class="text-center" style="background-color:antiquewhite">Saved Reports Images</h5>
</br>
            <div class="row">
                @foreach ($reports as $report)
                <div class="col-sm-6 col-md-4 mb-3 align-items-center">
                    <label style="font-size:20px;font-weight:bold;" >{{$report->report_name}}</label></br>
                    <label style="font-size:15px;font-weight:bold;" class="text-primary">[{{$report->visibility}}]</label>
                    <a href="/user/reports/{{$report->id}}" type="submit" class="btn btn-danger pt-1 pb-1 mb-2">Delete</a>
                    <img src="{{ url('public/Reports/'.$report->image_path) }}" class="fluid img-thumbnail imgzoom" />
                </div>
                @endforeach
            </div>
            @else
            <p>No any Report saved yet.</p>
            @endif
            </br>

        </div>
        <div class="row custom-text-box col-12">
            @if ($pdfreports)
            <h5 class="text-center" style="background-color:antiquewhite">Saved PDF Reports</h5>
</br>
            <div class="row ">
                @foreach ($pdfreports as $pdfreport)
                <div class="col-sm-6 col-md-4 mb-3 align-items-center">
                    <a href="/public/PDFReports/{{$pdfreport->path}}" class="mb-0">
                        <p style="font-size:20px;font-weight:bold;color:black;" class="mb-0">{{$pdfreport->pdfreport_name}}</p>
                    </a>
                    <label style="font-size:15px;font-weight:bold;" class="text-primary">[{{$pdfreport->visibility}}]</label>
                    <a href="/user/pdfreports/{{ $pdfreport->id }}" class="btn btn-danger pt-1 pb-1 mb-2" style="font-size:15px;font-weight:bold;">Delete</a>
                    </br>
                    <iframe src="/public/PDFReports/{{$pdfreport->path}}" class="fluid img-thumbnail"></iframe>
                </div>
                @endforeach
            </div>
            @else
            <p>No any Report saved yet.</p>
            @endif
        </div>
    </div>
</section>
@endsection