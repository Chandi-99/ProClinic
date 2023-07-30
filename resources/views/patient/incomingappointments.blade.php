@extends('layouts.app')
@section('content')
<section class="section-padding section-bg mt-0 pt-2">
    <div class="col-12 mt-0 pt-0">
        <div class="custom-text-box mt-0 ">
            <h6 class="mb-3">Old Appointments:</h6>
            <table style="border:1px solid black;" class="table table-striped table-bordered">
                <tr style="border:1px solid black;">
                    <td style="border:1px solid black; padding:10px;" class="text-center "><strong>Appointment ID</strong></td>
                    <td style="border:1px solid black; padding:10px;" class="text-center "><strong>Appointment Number</strong></td>
                    <td style="border:1px solid black; padding:10px;" class="text-center "><strong>Doctor Name </strong></td>
                    <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Date</strong></td>
                    <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Type</strong></td>
                    <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Start Time </strong></td>
                    <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Prescription</strong></td>
                    <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Generate Medical Certificate</strong></td>
                </tr>
                @foreach($appointments as $appo)
                <tr>
                    <td style="border:1px solid black; padding:10px;" class="text-center">{{$appo->id}}</td>
                    <td style="border:1px solid black; padding:10px;" class="text-center">{{$appo->appo_number}}</td>
                    <td style="border:1px solid black; padding:10px;" class="text-center">{{$appo->visiting_id}}</td>
                    <td style="border:1px solid black; padding:10px;" class="text-center">{{$appo->date}}</td>
                    <td style="border:1px solid black; padding:10px;" class="text-center">{{$appo->visiting_id}}</td>
                    <td style="border:1px solid black; padding:10px;" class="text-center">{{$appo->start_time}}</td>
                    <td style="border:1px solid black; padding:10px;" class="text-center">
                        <a href="/prescription/{{Auth::user()->id}}" class="btn btn-primary" style="font-size:15px;font-weight:bold;">Prescription</a>
                    </td>
                    <td style="border:1px solid black; padding:10px;" class="text-center">
                        <a href="/medical-certificate/{{Auth::user()->id}}" class="btn btn-info " style="font-size:15px;font-weight:bold;">Generate Medical Certificate</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    </div>
</section>
@endsection