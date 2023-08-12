@extends('layouts.doctorlayout')
@section('content')

<section class="section-padding section-bg mb-0 pt-1">
    <div class="container pt-0 mt-0">
        <h5 class="text-center pt-0 mt-0" style="color:black; font-weight:700; font-size:30px; -webkit-text-stroke: 1px white;"> Diagnosis Form</h5>
        <div class="row justify-content-center mb-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="text-align:center;"><b>{{ __('Appointment Details') }}</b></div>
                    <div class="card-body">
                        <form method="POST" action="{{route('appointmentdetails.search')}}">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Date') }}</label>
                                <div class="col-md-6">
                                    <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{$appointment->date}}" autocomplete="date" disabled>
                                    @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Invalid Date</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Appointment No ') }}</label>
                                <div class="col-md-6">
                                    <input type="appo_number" class="form-control @error('appo_number') is-invalid @enderror" name="appo_number" value="{{$appointment->appo_number}}" disabled>
                                    @error('appo_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Invalid Appointment Number</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Session ') }}</label>
                                <div class="col-md-6">
                                    <input type="session" class="form-control @error('session') is-invalid @enderror" name="session" value="{{$visiting->session}}" autocomplete="session" disabled>
                                    @error('session')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Invalid Session</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Patient Name') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('patient') is-invalid @enderror" name="patient" autocomplete="patient" value="{{$patient->fname}} {{$patient->lname}}" disabled>
                                    @error('patient')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Invalid Date</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0 mt-2 pt-2">
                                <div class="col-md-12 offset-md-3">
                                    <a href="/admin" class="custom-btn pt-1 pb-1" style="margin-right:10px;">
                                        {{ __('Absent') }}
                                    </a>
                                    <a href="/viewreports/{{$patient->patient_id}}" class="custom-btn pt-1 pb-1" style="margin-right:10px;" target="_blank">
                                        {{ __('View Reports') }}
                                    </a>
                                    <a href="#" class="custom-btn pt-1 pb-1">
                                        {{ __('Finish Appointment') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="custom-text-box">
            <h6 class="text-center pb-3">Patient's Details</h6>
            <div class="message-container">
                <div class="message-box" style="margin-bottom:20px;">
                    <h5 style="display: inline-block;">Recent Visits</h5><span><img src="/images/top.png " style="width:40px; height:40px;" /></span>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th width="20%">Date</th>
                                <th width="40%">Chief Complain</th>
                                <th>Doctor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @if(isset($latests))
                                @foreach($latests as $latest)
                                <td width="20%">{{$latest->date->format('m-d')}}</td>
                                <td width="40%">{{$latest->Diagnosis->chief_complain}}</td>
                                <td>{{$latest->Visiting->Doctor->fname}} {{$latest->Visiting->Doctor->lname}}</td>
                                @endforeach
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="message-box" style="margin-bottom:20px;">
                    <h5 style="display: inline-block;">Recent Medications</h5><span><img src="/images/top.png " style="width:40px; height:40px; display: inline-block;" /></span>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th width="20%">Date</th>
                                <th width="40%">Medicine</th>
                                <th>Dose</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @if(isset($latests))
                                @foreach($latests as $latest)
                                <td>{{$latest->date->format('m-d')}}</td>
                                <td>{{$latest->Prescription->Prescription_Medicine->Medicine->medi_name}}</td>
                                <td>{{$latest->Prescription->Prescription_Medicine->dose}}</td>
                                @endforeach
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="message-box" style="margin-bottom:20px;padding-left:50px;">
                    <h5>Vital Signs</h5><span><img src="/images/top.png " style="width:70px; height:70px; float:right;" /></span>
                    </br>
                    @if(isset($latests))
                    <p><b>Last Exam: </b>{{$latest->date}}</p>
                    <p class="mt-0 mb-0" ><span style="color:black;">Weight: </span></p>
                    <p class="mt-0 mb-0"><span style="color:black;">Height: </span></p>
                    <p class="mt-0 mb-0"><span style="color:black;">BMI: </span></p>
                    <p class="mt-0 mb-0"><span style="color:black;">Blood Pressure</span></p>
                    @endif   
                </div>

                <div class="message-box" style="margin-bottom:20px;padding-left:50px;">
                    <h5>Allergies</h5><span><img src="/images/top.png " style="width:70px; height:70px; float:right;" /></span>
                    </br>
                    @if(isset($allergies))
                    @foreach($allergies as $allergie)
                    <p class="mt-0 mb-0" ><span style="color:black;">{{$allergie->allergie}}</span></p>
                    @endforeach
                    @endif   
                </div>
            </div>
        </div>

        <div class="custom-text-box">
            <h6 class="mb-3 text-center">Medicines For the Patient:</h6>
            <table style="border:1px solid black;" class="table table-striped table-bordered">
                <thead>
                    <tr style="border:1px solid black;">
                        <td style="border:1px solid black; padding:10px;" class="text-center "><strong>Medicine Name</strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center "><strong>Weight (mg) </strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Dose</strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Before or After Eat</strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Quantity</strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Action</strong></td>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($medicines))
                    @foreach($medicines as $medi)
                    <tr>
                        <td style="border:1px solid black; padding:10px;" class="text-center">{{$medi->Medicine->medi_name}}</td>
                        <td style="border:1px solid black; padding:10px;" class="text-center">{{$medi->Medicine->mg}}</td>
                        <td style="border:1px solid black; padding:10px;" class="text-center">{{$medi->dose}}</td>
                        <td style="border:1px solid black; padding:10px;" class="text-center">{{$medi->Medicine->after_Eat}}</td>
                        <td style="border:1px solid black; padding:10px;" class="text-center">{{$medi->quantity}}</td>
                        <td style="border:1px solid black; padding:10px;" class="text-center">
                            <a href="/medicine/delete/{{ $medi->id }}" class="btn btn-danger" style="font-size:15px;font-weight:bold;">Remove</a>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
</section>


<script>
    //     setInterval(function() {
    //     $('#chatLog').load('/partial-view');
    //     location.reload();
    // }, 15000);
</script>
@endsection