@extends('layouts.doctorlayout')
@section('content')
<section class="section-padding section-bg ">
    <div class="container ">
    <div class="custom-text-box" style="margin:0 auto;">
        @foreach($visit as $visit)
        <form method="POST" action="/doctor/visitings/edit/{{$visit->id}}" enctype="multipart/form-data">
            @csrf
            <h5 for="image" >Edit Visiting:</h5>
            </br>
            <div class="col-lg-6 col-12 ">
            <label> Day of the Week: </label>
            <select name="day" class="form-control form-control-lg @error('day') is-invalid @enderror" value="{{$visit->day}}" readonly>
            @if($visit->day == "Monday")
                <option selected>Monday</option>
                <option>Tuesday</option>
                <option>Wednesday</option>
                <option>Thursday</option>
                <option>Friday</option>
                <option>Saturday</option>
                <option>Sunday</option>
            @elseif($visit->day == "Tuesday")
                <option>Monday</option>
                <option selected>Tuesday</option>
                <option>Wednesday</option>
                <option>Thursday</option>
                <option>Friday</option>
                <option>Saturday</option>
                <option>Sunday</option>
            @elseif($visit->day == "Wednesday")
                <option>Monday</option>
                <option>Tuesday</option>
                <option selected>Wednesday</option>
                <option>Thursday</option>
                <option>Friday</option>
                <option>Saturday</option>
                <option>Sunday</option>
            @elseif($visit->day == "Thursday")
                <option>Monday</option>
                <option>Tuesday</option>
                <option>Wednesday</option>
                <option selected>Thursday</option>
                <option>Friday</option>
                <option>Saturday</option>
                <option>Sunday</option>
            @elseif($visit->day == "Friday")
                <option>Monday</option>
                <option>Tuesday</option>
                <option>Wednesday</option>
                <option>Thursday</option>
                <option selected>Friday</option>
                <option>Saturday</option>
                <option>Sunday</option>
            @elseif($visit->day == "Saturday")
                <option>Monday</option>
                <option>Tuesday</option>
                <option>Wednesday</option>
                <option>Thursday</option>
                <option>Friday</option>
                <option selected>Saturday</option>
                <option>Sunday</option>
            @elseif($visit->day == "Sunday")
                <option>Monday</option>
                <option>Tuesday</option>
                <option>Wednesday</option>
                <option>Thursday</option>
                <option>Friday</option>
                <option>Saturday</option>
                <option selected>Sunday</option>
            @endif
            </select>
            
            @error('day')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            </br>
            <div class="col-lg-6 col-12 ">
            <label>Session </label>
            <select name="session" class="form-control form-control-lg @error('session') is-invalid @enderror" value="{{$visit->session}}" readonly>
            @if($visit->session == 'Morning')
                <option selected>Morning</option>
                <option>Afternoon</option>
                <option>Evening</option>
                <option>Night</option>
            @elseif($visit->session == 'Afternoon')
                <option>Morning</option>
                <option selected>Afternoon</option>
                <option>Evening</option>
                <option>Night</option> 
            @elseif($visit->session == 'Evening')
                <option>Morning</option>
                <option>Afternoon</option>
                <option selected>Evening</option>
                <option>Night</option>
            @elseif($visit->session == 'Night')
                <option>Morning</option>
                <option>Afternoon</option>
                <option>Evening</option>
                <option selected>Night</option> 
            @endif         
            </select>
            
            @error('session')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            </br>
            <div class="col-lg-6 col-12 ">
            <label>Type : </label><select name="type" class="form-control form-control-lg @error('type') is-invalid @enderror" value="{{$visit->type}}" required>
            @if($visit->session == 'Morning')    
                <option selected>Physical</option>
                <option>TeleMedicine</option>
            @else
                <option>Physical</option>
                <option selected>TeleMedicine</option>
            @endif
            </select>
            @error('type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            </br>

            <div class="col-lg-6 col-12 ">
            <label>Max Patients For a Session : </label><select name="max_per_session" class="form-control form-control-lg @error('max_per_session') is-invalid @enderror" value="{{$visit->max_per_session}}" >
                @for($integer = 1; $integer <= 15; $integer ++)
                    @if($visit->max_per_session == $integer)
                        <option selected>{{$integer}}</option>
                    @endif
                    <option>{{$integer}}</option>
                @endfor
            </select>
            
            @error('max_per_session')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            </br>

            <input type="reset"  style="background-color:skyblue;" class="custom-btn mb-4"/>
            <button type="submit"  class="custom-btn mb-4">Update Visiting</button>
            </br>       
        </form>
        @break
        @endforeach
        </div>

    </div>
</section>
@endsection