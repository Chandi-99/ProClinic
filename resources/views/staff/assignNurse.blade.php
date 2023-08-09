@extends('layouts.stafflayout')
@section('content')
<section class="section-padding section-bg mb-0 pt-1">
    <div class="container pt-3">
        <div class="row justify-content-center mb-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="text-align:center;"><b>{{ __('Assign a Nurse to a Room') }}</b></div>

                    <div class="card-body">
                        <form method="POST" action="{{route('assignNurse.store')}}">
                            @csrf
                            <div class="row mb-3">
                                <label for="nurse" class="col-md-4 col-form-label text-md-end">{{ __('Select a Nurse') }}</label>

                                <div class="col-md-6">
                                    <select id="nurse" type="text" class="form-control @error('nurse') is-invalid @enderror" name="nurse" value="{{ old('nurse') }}" required autocomplete="nurse">
                                        @foreach ($nurses as $nurse)
                                        <option value="{{$nurse->id}}">{{ $nurse->fname}} {{$nurse->lname}}</option>
                                        @endforeach
                                    </select>
                                    @error('nurse')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Nurse was Unidentified</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="room" class="col-md-4 col-form-label text-md-end">{{ __('Select a Room') }}</label>

                                <div class="col-md-6">
                                    <select id="room" type="text" class="form-control @error('room') is-invalid @enderror" name="room" value="{{ old('room') }}" required autocomplete="room">
                                        @foreach ($rooms as $room)
                                        <option value="{{$room->id}}">{{ $room->room_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('nurse')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Room was Unidentified</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="date" class="col-md-4 col-form-label text-md-end">{{ __('Date') }}</label>
                                <div class="col-md-6">
                                    <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required>
                                    @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Invalid Date Inserted</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="session" class="col-md-4 col-form-label text-md-end">{{ __('Session') }}</label>

                                <div class="col-md-6">
                                    <select id="session" type="text" class="form-control @error('session') is-invalid @enderror" name="session" value="{{ old('session') }}" required autocomplete="session">
                                        <option>Morning</option>
                                        <option>Afternoon</option>
                                        <option>Evening</option>
                                        <option>Night</option>
                                    </select>
                                    @error('session')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Session was Unidentified</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <a  href="/rooms" class="custom-btn pt-1 pb-1" style="margin-right:10px;">
                                        {{ __('Back') }}
                                    </a>
                                    <button type="submit" class="custom-btn pt-1 pb-1">
                                        {{ __('Assign') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="custom-text-box">
            <h5 style="text-align:center;">Today's Appointments & Assigned Nurses </h5>
            <table id="rooms" class="table table-striped table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>Room ID</th>
                        <th>Room Name</th>
                        <th>Session</th>
                        <th>Doctor Name</th>
                        <th>Nurse Name</th>
                        <th>Start Time</th>
                        <th>End time</th>
                        <th>Number of Appointments</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $Data)
                    <tr class="text-center">
                        <td>{{ $Data->room->id }}</td>
                        <td>{{ $Data->room->room_name }}</td>
                        <td>{{ $Data->session }}</td>
                        <td>{{ _('test doctor') }}</td>
                        <td>{{ $Data->nurse->fname }} {{ $Data->nurse->lname }}</td>

                        @if($Data->session == 'Morning')
                        <td>{{ _('8:00 AM') }}</td>
                        <td>{{ _('12:00 PM') }}</td>

                        @elseif($Data->session == 'Evening')
                        <td>{{ _('01:00 PM') }}</td>
                        <td>{{ _('5:00 PM') }}</td>

                        @else
                        <td>{{ _('07:00 PM') }}</td>
                        <td>{{ _('09:00 PM') }}</td>

                        @endif
                        <td>{{ _('10') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection