@extends('layouts.app')
@section('content')
<section class="section-padding section-bg mt-0 pt-2">
    <div class="col-12 mt-0 pt-0">
        <div class="custom-text-box mt-2 " style="margin:10px 100px;padding:20px 20px;">
            <h5 class="mb-3 text-center">Finished Appointments</h5>
            <table style="border:1px solid black;" class="table table-striped table-bordered">
                <thead>
                    <tr style="border:1px solid black;">
                        <td style="border:1px solid black; padding:10px;" class="text-center "><strong>Appointment ID</strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center "><strong>Appointment Number</strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center "><strong>Doctor Name </strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Date</strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Type</strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Start Time </strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Prescription</strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Generate Medical Certificate</strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Bill</strong></td>
                    </tr>
                    <thead>
                    <tbody>
                        @foreach($appointments as $appo)
                        <tr>
                            <td style="border:1px solid black; padding:10px;" class="text-center">{{$appo->id}}</td>
                            <td style="border:1px solid black; padding:10px;" class="text-center">{{$appo->appo_number}}</td>
                            <td style="border:1px solid black; padding:10px;" class="text-center">{{$appo->visiting->Doctor->fname}} {{$appo->visiting->Doctor->lname}}</td>
                            <td style="border:1px solid black; padding:10px;" class="text-center">{{$appo->date}}</td>
                            <td style="border:1px solid black; padding:10px;" class="text-center">{{$appo->Visiting->type}}</td>
                            <td style="border:1px solid black; padding:10px;" class="text-center">{{$appo->start_time}}</td>
                            <td style="border:1px solid black; padding:10px;" class="text-center">
                                <a href="/prescription/{{$appo->patient_id}}/{{$appo->id}}" class="btn btn-primary" style="font-size:15px;font-weight:bold;">Prescription</a>
                            </td>
                            <td style="border:1px solid black; padding:10px;" class="text-center">
                                <a href="/medical_certificate/{{$appo->patient_id}}/{{$appo->id}}" class="btn btn-success" style="font-size:15px;font-weight:bold;">Generate Medical Certificate</a>
                            </td>
                            <td style="border:1px solid black; padding:10px;" class="text-center">
                                <a href="/bill/{{$appo->patient_id}}/{{$appo->id}}" class="btn btn-danger" style="font-size:15px;font-weight:bold;">Bill</a>
                            </td>
                        </tr>
                        @endforeach
                <tbody>
            </table>
            <a href="/newappointment/{{Auth::user()->id}}" class="btn custom-btn pt-1 pb-1">Go Back</a>
        </div>
    </div>
    </div>
</section>
@endsection