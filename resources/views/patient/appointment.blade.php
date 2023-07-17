
@extends('layouts.app')

@section('content')
<section class="section-padding section-bg mt-0 pt-2">
    <div class="container ">
        <div class="custom-text-box  align-items-center mt-0 pt-2" style="padding-left: 50px;">
            <h6 class="text-center" style="font-size:larger;">Create Doctor Appointment</h6>
            <form method="POST" action="/newappointment/{{Auth::user()->id}}">
                @csrf
                <div class="col-lg-6 col-12" >
                    @if (session('alert_1'))
                            <div class="alert alert-danger">
                                {{ session('alert_1') }}
                            </div>
                    @endif
                    <strong> Doctor: </strong>
                    <select name="doctor" class="form-control form-control-lg @error('doctor') is-invalid @enderror" {{ $isReadonly ? 'disabled' : '' }}>
                    @foreach($doctors as $doctor)
                        @if($selectedDoctorFName == $doctor->fname )
                            <option value="{{$doctor->id}}" selected>{{ $doctor->fname }} {{$doctor->lname}}</option>
                        @else
                            <option value="{{$doctor->id}}">{{ $doctor->fname }} {{$doctor->lname}}</option>
                        @endif
                    @endforeach
                    </select>
                    
                    @error('doctor')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                </br>

                <div class="col-lg-6 col-12 ml-10">
                    <strong> Speciality: </strong>
                    <select name="speciality" class="form-control form-control-lg @error('speciality') is-invalid @enderror"  {{ $isReadonly ? 'disabled' : '' }}>
                    @foreach($specialities as $speciality)
                        @if($selectedDoctorSpeciality == $speciality)
                            <option selected>{{$speciality->specialization}}</option>
                        @else
                            <option>{{$speciality->specialization}}</option>
                        @endif
                        
                    @endforeach
                    </select>
                    
                    @error('speciality')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                </br>

                <div class="col-lg-6 col-12 ">
                    
                    <strong> Appointment Type: </strong>
                    <select name="type" class="form-control form-control-lg @error('type') is-invalid @enderror" {{ $isReadonly ? 'disabled' : '' }}>
                    @if($type == 'Physical' || $type == '')
                        <option selected>Physical</option>
                        <option>Virtual</option>
                        @elseif($type == 'Virtual')
                            <option>Physical</option>
                            <option selected>Virtual</option>
                        @endif
                    </select>
                    
                    @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                </br>
                <button type="submit" name="form1" class="btn btn-primary pt-1 pb-1 mt-0" {{ $isReadonly ? 'disabled' : '' }}>Submit</button>
            </form>

            @if($isVisible)
            <div id="id_1" class="mt-3">
                <div class="row">
                    <p class="alert alert-info">Doctor Only Available in Following Days: <span style="color:red;font-weight:bold;">{{$days}}</span></p>
                </div>
                <form method="POST" action="/newappointment/validate/{{Auth::user()->id}}">
                    @csrf
                    <div class="col-lg-6 col-12 ">
                        @if (session('alert_2'))
                            <div class="alert alert-info">
                                {{ session('alert_2') }}
                            </div>
                        @endif
                        @if (session('alert_3'))
                            <div class="alert alert-danger">
                                {{ session('alert_3') }}
                            </div>
                        @endif
                        <label style="font-weight:bold; font-size:large;">Appointment Date:</label>
                        <input type="date" name="date" class="form-control form-control-lg @error('date') is-invalid @enderror" style="width:50%" required/>
                        <button type="submit" name="form2" class="btn btn-dark pt-1 pb-1 mb-2 mt-2" style="display:inline-flex;">Check Available Sessions</button>
                        </form>
                            
                        @error('date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <form method="POST" action="/newappointment/{{Auth::user()->id}}">
                        @csrf
                        <strong style="font-weight:bold; font-size:large;">Session:</strong>
                        <input type="text" name="session" class="form-control form-control-lg @error('session') is-invalid @enderror mb-1" style="width:50%;" required/>
                        @error('session')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <button type="submit" name="form3" class="custom-btn pt-2 pb-2 mt-2">Make Appointment</button>
                        </form>
                    </div>
                    </br>                 

            </div> 
            @endif

        </div>     
    </div>
</section>
    
@endsection
