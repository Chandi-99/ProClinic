@extends('layouts.app')
@section('content')
<section class="section-padding section-bg mt-0 pt-2">
    <div class="col-10 mt-2 pt-0" style="margin:0px auto;">
        <div class="custom-text-box mt-0 ">
            @if (Session::has('success'))
            <div class="alert alert-info text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                <p>{{ Session::get('success') }}</p>
            </div>
            @endif
            <h6 class="mb-3 text-center">Incoming Appointments:</h6>
            <table style="border:1px solid black;" class="table table-striped table-bordered">
                <thead>
                    <tr style="border:1px solid black;">
                        <td style="border:1px solid black; padding:10px;" class="text-center "><strong>Appointment ID</strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center "><strong>Appointment Number</strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center "><strong>Doctor Name </strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Date</strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Type</strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Start Time </strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Join Telemedicine</strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Ongoing Number</strong></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appo)
                    <tr>
                        <td style="border:1px solid black; padding:10px;" class="text-center">{{$appo->id}}</td>
                        <td style="border:1px solid black; padding:10px;" class="text-center">{{$appo->appo_number}}</td>
                        <td style="border:1px solid black; padding:10px;" class="text-center">{{$appo->visiting->Doctor->fname}} {{$appo->visiting->Doctor->lname}}</td>
                        <td style="border:1px solid black; padding:10px;" class="text-center">{{$appo->date}}</td>
                        <td style="border:1px solid black; padding:10px;" class="text-center">{{$appo->Visiting->type}}</td>
                        <td style="border:1px solid black; padding:10px;" class="text-center">{{$appo->start_time}}</td>
                        @if($appo->Visiting->type == 'TeleMedicine')
                        <td style="border:1px solid black; padding:10px;" class="text-center">
                            <a href="/incomingappointments/join/{{Auth::user()->id}}/{{$appo->id}}" class="btn btn-primary" style="font-size:15px;font-weight:bold;">Join</a>
                        </td>
                        @else
                        <td style="border:1px solid black; padding:10px;" class="text-center">N/A</td>
                        @endif
                        @if($today == $appo->date)
                        <td style="border:1px solid black; padding:10px;" class="text-center">
                            <a href="/incomingappointments/{{Auth::user()->id}}/{{$appo->id}}" class="btn btn-info" style="font-size:15px;font-weight:bold;">Check</a>
                        </td>
                        @else
                        <td style="border:1px solid black; padding:10px;" class="text-center">Unavailable</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="/newappointment/{{Auth::user()->id}}" class="btn btn-success">Go Back</a>
        </div>
    </div>
    </div>
</section>
@endsection