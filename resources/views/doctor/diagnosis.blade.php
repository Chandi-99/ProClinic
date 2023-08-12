@extends('layouts.doctorlayout')
@section('content')

<section class="section-padding section-bg mb-0 pt-1">
    <div class="container pt-0 mt-0">
        <h5 class="text-center pt-0 mt-0" style="color:black; font-weight:700; font-size:30px; -webkit-text-stroke: 1px white;"> Diagnosis Form</h5>
        <div class="row justify-content-center mb-4 mb-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="text-align:center;"><b>{{ __('Appointment Details') }}</b></div>
                    <div class="card-body">
                        <form method="POST">
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
                                <div class="col-md-12 offset-md-4">
                                    <a href="/todaysession/{{$visiting->id}}/{{$appointment->id}}/absent" class="custom-btn pt-1 pb-1" style="margin-right:10px;">
                                        {{ __('Absent') }}
                                    </a>
                                    <a href="/viewreports/{{$patient->patient_id}}" class="custom-btn pt-1 pb-1" style="margin-right:10px;" target="_blank">
                                        {{ __('View Reports') }}
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
                    <h5 style="display: inline-block;">Recent Visits</h5><span><img src="/images/new21.jpg " style="width:40px; height:40px;margin-left:10%;margin-bottom:10px;" /></span>
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
                                <td width="20%">{{$latest->date}}</td>
                                <td width="40%">{{$latest->Diagnosis->chief_complain}}</td>
                                <td>{{$latest->Visiting->Doctor->fname}} {{$latest->Visiting->Doctor->lname}}</td>
                                @endforeach
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="message-box" style="margin-bottom:20px;">
                    <h5 style="display: inline-block;">Recent Medications</h5><span><img src="/images/new22.png " style="width:40px; height:40px; margin-bottom:10px;margin-left:10%; display: inline-block;" /></span>
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
                                <td>{{$latest->Prescription->Prescription_Medicine->medi_Name()}}</td>
                                <td>{{$latest->Prescription->Prescription_Medicine->dose}}</td>
                                @endforeach
                                @endif
                            </tr>
                        </tbody>
                    </table>
                    @if(isset($latests))
                    <a href="/oldmedications/{{$patient->patient_id}}" class="btn custom-btn pb-1 pt-1" target="_blank">See All</a>
                    @endif
                </div>

                <div class="message-box" style="margin-bottom:20px;padding-left:50px;">
                    <h5 style="display: inline-block;">Vital Signs</h5><span><img src="/images/new23.webp " style="width:40px; height:40px; margin-bottom:10px;margin-left:10%;display: inline-block;" /></span> </br>
                    @if(isset($latests))
                    <p><b>Last Exam: </b>{{$latest->date}}</p>
                    <p class="mt-0 mb-0"><span style="color:black;">Weight: </span></p>
                    <p class="mt-0 mb-0"><span style="color:black;">Height: </span></p>
                    <p class="mt-0 mb-0"><span style="color:black;">BMI: </span></p>
                    <p class="mt-0 mb-0"><span style="color:black;">Blood Pressure</span></p>
                    @endif
                </div>

                <div class="message-box" style="margin-bottom:20px;padding-left:50px;">
                    <h5 style="display: inline-block;">Allergies</h5><span><img src="/images/new24.png " style="width:40px; height:40px;margin-bottom:10px;margin-left:10%; display: inline-block;" /></span> </br>
                    @if(isset($allergies))
                    @foreach($allergies as $allergie)
                    <p class="mt-0 mb-0"><span style="color:black;">{{$allergie->allergie}}</span></p>
                    @endforeach
                    @endif
                    </br>
                    <a href="/newAllergy/{{$patient->patient_id}}" class="btn custom-btn pb-1 pt-1" target="_blank">New Allergy</a>
                </div>
            </div>
        </div>


        <div class="row justify-content-center mb-4" {{ $hidden ? '' : 'hidden' }}>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="text-align:center;"><b>{{ __('Examination Details') }}</b></div>
                    <div class="card-body">
                        <form method="POST" name="form1" action="/todaysession/{{$visiting->id}}/{{$appointment->id}}">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Chief Complain') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('chief_complain') is-invalid @enderror" name="chief_complain" autocomplete="chief_complain" required>
                                    @error('chief_complain')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Symptoms') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('symptoms') is-invalid @enderror" name="symptoms" autocomplete="symptoms" required>
                                    @error('symptoms')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Physical Examination') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('physical_examination') is-invalid @enderror" name="physical_examination" autocomplete="physical_examination">
                                    @error('physical_examination')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Recommended Tests') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('recommended_tests') is-invalid @enderror" name="recommended_tests" autocomplete="recommended_tests">
                                    @error('recommended_tests')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Identified Disease') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('identified_disease') is-invalid @enderror" name="identified_disease" autocomplete="identified_disease">
                                    @error('identified_disease')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Blood Pressure') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('blood_pressure') is-invalid @enderror" name="blood_pressure" autocomplete="blood_pressure">
                                    @error('blood_pressure')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Blood Sugar Level') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('blood_sugar_level') is-invalid @enderror" name="blood_sugar_level" autocomplete="blood_sugar_level">
                                    @error('blood_sugar_level')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('No of Days Should Rest') }}</label>
                                <div class="col-md-6">
                                    <select class="form-control @error('rest_no_days') is-invalid @enderror" name="rest_no_days" style="width:20%;" autocomplete="rest_no_days">
                                        @for($i = 1; $i < 15; $i++) <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                    </select>
                                    @error('rest_no_days')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div style="margin:0px auto;" class="item-align-center">
                                <center>
                                    <button type="submit" style="margin:0px auto;" class="custom-btn pt-1 pb-1">
                                        {{ __('Submit') }}
                                    </button>
                                </center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="row justify-content-center mb-4" >
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="text-align:center;"><b>{{ __('Medicine Assignment') }}</b></div>
                    <div class="card-body">
                        <form method="POST" name="form2" action="/todaysession/{{$prescription->id}}/{{$visiting->id}}/{{$appointment->id}}">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Select Medicine') }}</label>
                                <div class="col-md-6">
                                    <select class="form-control @error('medicine_id') is-invalid @enderror" name="medicine_id" autocomplete="medicine_id" required>
                                        @if(isset($medicines))
                                        @foreach($medicines as $medicine)
                                        <option value="{{$medicine->id}}">{{$medicine->medi_name}} ({{$medicine->mg}}mg)</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @error('medicine_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Quantity') }}</label>
                                <div class="col-md-6">
                                    <select class="form-control @error('quantity') is-invalid @enderror" name="quantity" style="width:20%;" autocomplete="quantity" required>
                                        @for($i = 1; $i < 101; $i++) <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                    </select>
                                    @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Dose') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('dose') is-invalid @enderror" name="dose" autocomplete="dose" required>
                                    @error('dose')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-0 mt-2 pt-2">
                                <center><button type="submit" class="custom-btn pt-1 pb-1" style="margin:10px auto;">
                                        {{ __('Add') }}
                                </center></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="custom-text-box" >
            <h5 class="mb-3 text-center">Medicines For the Patient:</h5>
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
                    @if(isset($mediassigned))
                    @foreach($mediassigned as $medi)
                    <tr>
                        <td style="border:1px solid black; padding:10px;" class="text-center">{{$medi->MedicineName()}}</td>
                        <td style="border:1px solid black; padding:10px;" class="text-center">{{$medi->MedicineMg()}}</td>
                        <td style="border:1px solid black; padding:10px;" class="text-center">{{$medi->dose}}</td>
                        <td style="border:1px solid black; padding:10px;" class="text-center">{{$medi->MedicineAfter()}}</td>
                        <td style="border:1px solid black; padding:10px;" class="text-center">{{$medi->quantity}}</td>
                        <td style="border:1px solid black; padding:10px;" class="text-center">
                            <a href="/todaysession/remove/{{$visiting->id}}/{{$prescription->id}}/{{$medi->medi_id}}" class="btn btn-danger" style="font-size:15px;font-weight:bold;">Remove</a>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            <div class="row mb-0 mt-2 pt-2">
                <div class="col-md-12">
                <center>
                    <a href="#" class="custom-btn pt-1 pb-1">
                        {{ __('Finish the Appointment') }}
                    </a>
                </center>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection