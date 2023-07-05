@extends('layouts.doctorlayout')
@section('content')

<section class="section-padding section-bg ">
    <div class="container ">
        <div class="col-12 ">
            <div class="custom-text-box ">
                <h6 class="mb-3">Visitings Registered by You:</h6>
                <table style="border:1px solid black;">     
                    <tr style="border:1px solid black;">
                        <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Visiting ID</strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Day</strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Session</strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Room</strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Start Time</strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center"><strong>End Time</strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Max Patients Per Session</strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Edit/Delete</strong></td>
                    </tr>
                    @foreach($visitings as $visit)
                    <tr>
                        <td style="border:1px solid black; padding:10px;" class="text-center">{{$visit->id}}</td>
                        <td style="border:1px solid black; padding:10px;" class="text-center">{{$visit->day}}</td>
                        <td style="border:1px solid black; padding:10px;" class="text-center">{{$visit->session}}</td>
                        <td style="border:1px solid black; padding:10px;" class="text-center">{{$visit->Room->room_name}}</td>
                        @if($visit->session == "Morning")
                            <td style="border:1px solid black; padding:10px;" class="text-center">8:00 A.M.</td>
                            <td style="border:1px solid black; padding:10px;" class="text-center">11:00 A.M.</td>
                        
                        @elseif($visit->session == "Afternoon")
                            <td style="border:1px solid black; padding:10px;" class="text-center">12:00 P.M.</td>
                            <td style="border:1px solid black; padding:10px;" class="text-center">03:00 P.M.</td>
                        
                        @elseif($visit->session == "Evening")
                            <td style="border:1px solid black; padding:10px;" class="text-center">03:00 P.M.</td>
                            <td style="border:1px solid black; padding:10px;" class="text-center">06:00 P.M.</td>
                        
                        @elseif($visit->session == "Night")
                            <td style="border:1px solid black; padding:10px;" class="text-center">06:00 P.M.</td>
                            <td style="border:1px solid black; padding:10px;" class="text-center">09:00 P.M.</td>
                        
                        @endif
                        <td style="border:1px solid black; padding:10px;" class="text-center">{{$visit->max_per_session}}</td> 
                        <td style="border:1px solid black; padding:10px;" class="text-center">
                            <a href="/doctor/visitings/edit/{{$visit->id}}" class="btn btn-primary " style="font-size:15px;font-weight:bold;">Edit</a>
                            <a href="/doctor/visitings/delete/{{$visit->id}}" class="btn btn-danger" style="font-size:15px;font-weight:bold;">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="custom-text-box" style="margin:0 auto;">
        @if (session('alert_1'))
            <div class="alert alert-primary">
                {{ session('alert_1') }}
            </div>
        @endif
        @if (session('alert_2'))
            <div class="alert alert-danger">
                {{ session('alert_2') }}
            </div>
        @endif
        <form method="POST" action="{{ route('doctor.visiting.update') }}" enctype="multipart/form-data">
            @csrf
            <h5 for="image" >Create New Visiting:</h5>
            </br>
            <div class="col-lg-6 col-12 ">
            <label> Day of the Week: </label>
            <select name="day" class="form-control form-control-lg @error('day') is-invalid @enderror" value="" required>
                <option selected>Monday</option>
                <option>Tuesday</option>
                <option>Wednesday</option>
                <option>Thursday</option>
                <option>Friday</option>
                <option>Saturday</option>
                <option>Sunday</option>
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
            <select name="session" class="form-control form-control-lg @error('session') is-invalid @enderror" value="" required>
                <option selected>Morning</option>
                <option>Afternoon</option>
                <option>Evening</option>
                <option>Night</option>
            </select>
            
            @error('session')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            </br>
            <div class="col-lg-6 col-12 ">
            <label>Type : </label><select name="type" class="form-control form-control-lg @error('type') is-invalid @enderror" value="" required>
                <option>Physical</option>
                <option>TeleMedicine</option>
            </select>
            
            @error('type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            </br>

            <div class="col-lg-6 col-12 ">
            <label>Max Patients For a Session : </label><select name="max_per_session" class="form-control form-control-lg @error('max_per_session') is-invalid @enderror" value="" >
                @for($integer = 1; $integer <= 15; $integer ++)
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
            <button type="submit"  class="custom-btn mb-4">Add New Visiting</button>
            </br>       
        </form>

        </div>
    </div>
</section>
@endsection