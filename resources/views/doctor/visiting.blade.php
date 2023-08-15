@extends('layouts.doctorlayout')
@section('content')

<section class="section-padding section-bg pt-4 mt-0">
    <div class="container">
        <div class="custom-text-box ">
            <h6 class="mb-3 text-center">Visitings Registered By You:</h6>
            <table style="border:1px solid black;" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Visiting ID</strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Day</strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Session</strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Type</strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Room</strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Start Time</strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center"><strong>End Time</strong></td>
                        <td style="border:1px solid black; padding:10px;width:10%;" class="text-center"><strong>Max Patients Per Session</strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Edit/Delete</strong></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($visitings as $visit)
                    <tr class="table table-striped table-bordered">
                        <td style="border:1px solid black; padding:10px;" class="text-center">{{$visit->id}}</td>
                        <td style="border:1px solid black; padding:10px;" class="text-center">{{$visit->day}}</td>
                        <td style="border:1px solid black; padding:10px;" class="text-center">{{$visit->session}}</td>
                        <td style="border:1px solid black; padding:10px;" class="text-center">{{$visit->type}}</td>
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
                </tbody>
            </table>
        </div>

        <div class="col-md-8" style="margin:0 auto;">
            <div class="card pt-3 mb-3">
                <div class="card-body" style="padding-left: 60px;">
                    <form method="POST" action="{{route('doctor.visiting.update')}}">
                        @csrf
                        <h5 class="text-center">Create New Visiting:</h5>
                        </br>
                        <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-end" style="display:inline;font-size:larger;">{{ __('Day of the Week:  ') }}</label>
                            <select name="day" class="form-control form-control-lg @error('day') is-invalid @enderror" style="width:30%;margin-left:30px;" value="" required>
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
                        <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-end" style="display:inline;font-size:larger;">{{ __('Session:  ') }}</label>
                            <select name="session" class="form-control form-control-lg @error('session') is-invalid @enderror" style="width:30%;margin-left:30px;" value="" required>
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

                        <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-end" style="display:inline;font-size:larger;">{{ __('Type:  ') }}</label>
                            <select name="type" class="form-control form-control-lg @error('type') is-invalid @enderror" style="width:30%;margin-left:30px;" value="" required>
                                <option>Physical</option>
                                <option>TeleMedicine</option>
                            </select>
                            @error('type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-end" style="display:inline;font-size:larger;">{{ __('Max Patients For a Session:  ') }}</label>
                            <select name="max_per_session" style="width:30%;margin-left:30px;" class="form-control form-control-lg @error('max_per_session') is-invalid @enderror" value="">
                                @for($integer = 1; $integer <= 15; $integer ++) <option>{{$integer}}</option>
                                    @endfor
                            </select>
                            @error('max_per_session')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="row mb-0 mt-2 pt-4" style="margin-right:100px;">
                            <div class="col-md-6 offset-md-4">
                                <a href="/doctor" class="custom-btn pt-1 pb-1" style="margin-right:10px;">
                                    {{ __('Back') }}
                                </a>
                                <button type="submit" class="custom-btn pt-1 pb-1">
                                    {{ __('Add New Visiting') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection