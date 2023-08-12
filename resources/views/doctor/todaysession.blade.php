@extends('layouts.doctorlayout')
@section('content')

<section class="section-padding section-bg mb-0 pt-5">
    <div class="container custom-text-box">
        @if (Session::has('error'))
        <div class="alert alert-success text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
            <p>{{ Session::get('error') }}</p>
        </div>
        @endif
        <h5 class="text-center">Today's Appointments</h5>
        <p style="color:black;"><strong>Doctor Name: </strong>{{$docname}}</p>
        <p style="color:black;"><strong>Specialization: </strong>{{$speciality}}</p>

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th style="border:1px solid black; padding:10px;" class="text-center thead-dark">Appointment ID</th>
                        <th style="border:1px solid black; padding:10px;" class="text-center thead-dark">Appointment Number</th>
                        <th style="border:1px solid black; padding:10px;" class="text-center thead-dark">Appointment Type</th>
                        <th style="border:1px solid black; padding:10px;" class="text-center thead-dark">Date</th>
                        <th style="border:1px solid black; padding:10px;" class="text-center thead-dark">Patient Name</th>
                        <th style="border:1px solid black; padding:10px;" class="text-center thead-dark">Room Name</th>
                        <th style="border:1px solid black; padding:10px;" class="text-center thead-dark">Patient Contact Number</th>
                        <th style="border:1px solid black; padding:10px;" class="text-center thead-dark">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < $length; $i++) <tr>
                        <td style="border:1px solid black; padding:10px;" class="text-center">{{$appointments[$i]->id}}</td>
                        <td style="border:1px solid black; padding:10px;" class="text-center">{{$appointments[$i]->appo_number}}</td>
                        <td style="border:1px solid black; padding:10px;" class="text-center">{{$appointments[$i]->visiting->type}}</td>
                        <td style="border:1px solid black; padding:10px;" class="text-center">{{$appointments[$i]->date}}</td>
                        <td style="border:1px solid black; padding:10px;" class="text-center">{{$appointments[$i]->Patient()->fname}} {{$appointments[$i]->Patient()->lname}} </td>
                        <td style="border:1px solid black; padding:10px;" class="text-center">{{$appointments[$i]->visiting->Room->room_name}}</td>
                        <td style="border:1px solid black; padding:10px;" class="text-center">0{{$appointments[$i]->Patient()->contact}}</td>
                        <td style="border:1px solid black; padding:10px;" class="text-center">{{$appointments[$i]->status}}</td>
                        </tr>
                    @endfor
                </tbody>
                
            </table>
        </div>
    </div>
    <div class="col-6 custom-text-box" style="margin:0px auto;">
        <h6 class="text-center">Select Session to Start</h6>
        <div class="card-body">
            <form method="POST" action="/todaysession/{{Auth::user()->id}}">
                @csrf
                </br>
                <div class="row mb-3 mt-2">
                    <label for="date" class="col-md-4 col-form-label text-md-end">{{ __('Date') }} </label>

                    <div class="col-md-6">
                        <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" style="width:50%;" value="{{ $today }}" required autocomplete="date" disabled>

                        @error('date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3 mt-2">
                    <label for="day" class="col-md-4 col-form-label text-md-end">{{ __('Day') }} </label>

                    <div class="col-md-6">
                        <input id="day" type="text" class="form-control @error('date') is-invalid @enderror" name="day" style="width:50%;" value="{{ $day}}" required autocomplete="date" disabled>

                        @error('day')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="session" class="col-md-4 col-form-label text-md-end">{{ __('Session') }} </label>

                    <div class="col-md-6">
                        <select id="session" type="text" class="form-control @error('session') is-invalid @enderror" name="session" style="width:50%;" value="{{ old('session') }}" value="{{$today}}" required autocomplete="session">
                            @foreach($visitings as $visiting)
                            <option value="{{$visiting->id}}">{{$visiting->session}}</option>
                            @endforeach
                        </select>
                        @error('session')
                        <span class="invalid-feedback" role="alert">
                            <strong>session was Unidentified</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3 mt-2">
                    <label for="day" class="col-md-4 col-form-label text-md-end">{{ __('Link [TeleMedicine Only]') }} </label>

                    <div class="col-md-6">
                        <input id="link" type="text" class="form-control @error('link') is-invalid @enderror" name="link" style="width:80%;" autocomplete="link">

                        @error('link')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-0 justify-content-center align-items-center" ><center>
                        <a class="btn custom-btn pt-1 pb-1" href="/doctor" style="margin-right: 10px;">Back</a>
                        <button type="submit" class="btn custom-btn pt-1 pb-1">
                            {{ __('Start') }}
                        </button>
</center>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection