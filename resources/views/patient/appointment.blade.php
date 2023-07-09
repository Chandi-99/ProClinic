
@extends('layouts.app')

@section('content')
<section class="section-padding section-bg ">
    <div class="container">
        <div class="custom-text-box">
            <h5>Create Doctor Appointment</h5>
            <form method="POST" action="/newappointment/{{Auth::user()->id}}">
                @csrf
                <div class="col-lg-6 col-12 ">
                    @if (session('alert_1'))
                            <div class="alert alert-danger">
                                {{ session('alert_1') }}
                            </div>
                    @endif
                    <label> Doctor: </label>
                    <select name="doctor" class="form-control form-control-lg @error('doctor') is-invalid @enderror"  required>
                    @foreach($doctors as $doctor)
                        <option>{{ $doctor->fname }} {{$doctor->lname}}</option>
                    @endforeach
                    </select>
                    
                    @error('doctor')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                </br>

                <div class="col-lg-6 col-12 ">
                    <label> Speciality: </label>
                    <select name="speciality" class="form-control form-control-lg @error('speciality') is-invalid @enderror"  required>
                    @foreach($specialities as $speciality)
                        <option>{{$speciality->specialization}}</option>
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
                    <label> Appointment Type: </label>
                    <select name="type" class="form-control form-control-lg @error('type') is-invalid @enderror"  required>
                        <option selected>Physical</option>
                        <option>Virtual</option>
                    </select>
                    
                    @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                </br>
                <button type="submit" name="form1" class="custom-btn pt-2 pb-2">Submit</button>
            </form>

            <div id="id_1" class="mt-3" style="visibility:hidden;">
                <form method="POST" action="/newappointment/{{Auth::user()->id}}">
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
                        <label for="appointment_date">Appointment Date:</label>
                        <input type="date" name="date" class="form-control form-control-lg @error('date') is-invalid @enderror"  required/>
                            
                        @error('date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                        <label>Session:</label>
                        <input type="text" name="session" class="form-control form-control-lg @error('session') is-invalid @enderror"  required/>
                            
                        @error('session')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </br>                 
                    <button type="submit" name="form2" class="custom-btn pt-2 pb-2">Create Appointment</button>
                </form>
            </div>  
        </div>     
    </div>
</section>
    
@endsection
