@extends('layouts.adminlayout')
@section('content')
<div class="container">
    <div class="row mt-2">
        <h5 style="text-align:center;">All Rooms</h5>
        <table id="rooms" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Room ID</th>
                    <th>Room Name</th>
                    <th>Room Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $room)
                <tr>
                    <td>{{ $room->id }}</td>
                    <td>{{ $room->room_name }}</td>
                    <td>{{ $room->room_desc }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <div class="row mt-3">
        <h5 style="text-align:center;">Working Staff</h5>
        <table id="rooms" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Staff ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Registration Number</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Position</th>
                    <th>Contact</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($staffmembers as $member)
                <tr>
                    <td>St_{{ $member->id }}</td>
                    <td>{{ $member->fname }}</td>
                    <td>{{ $member->lname }}</td>
                    <td>{{ $member->regNum }}</td>
                    <td>{{ $member->dob }}</td>
                    <td>{{ $member->gender }}</td>
                    <td>{{ $member->position }}</td>
                    <td>0{{ $member->contact }}</td>
                </tr>
                @endforeach
                @foreach ($nurses as $nurse)
                <tr>
                    <td>Nu_{{ $nurse->id }}</td>
                    <td>{{ $nurse->fname }}</td>
                    <td>{{ $nurse->lname }}</td>
                    <td>{{ $nurse->regNum }}</td>
                    <td>{{ $nurse->dob }}</td>
                    <td>{{ $nurse->gender }}</td>
                    <td>{{ $nurse->position }}</td>
                    <td>0{{ $nurse->contact }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</br>
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align:center;"><b>{{ __('Registration for Staff Members') }}</b></div>

                <div class="card-body">
                    <form method="POST" action="{{route('newstaff')}}">
                        @csrf
                        <div class="text-center">
                            @if(session('alert_2'))
                            <div class="alert alert-success">
                                {{ session('alert_2') }}
                            </div>
                            @endif
                        </div>

                        <div class="row mb-3">
                            <label for="fname" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>
                            <div class="col-md-6">
                                <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ old('fname') }}" required autocomplete="fname" autofocus>
                                @error('fname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Invalid First Name</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="lname" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>
                            <div class="col-md-6">
                                <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{ old('lname') }}" required autocomplete="lname" autofocus>
                                @error('lname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Invalid Last Name</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="gender" class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <select id="gender" type="text" class="form-control @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender') }}" required autocomplete="gender">
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Gender was Unidentified</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="dob" class="col-md-4 col-form-label text-md-end">{{ __('Date of Birth') }}</label>

                            <div class="col-md-6">
                                <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}" required>
                                @error('dob')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Invalid Date of Birth Inserted</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="position" class="col-md-4 col-form-label text-md-end">{{ __(' Position') }}</label>

                            <div class="col-md-6">
                                <input id="position" type="text" class="form-control @error('regNum') is-invalid @enderror" name="position" value="{{ old('position') }}" required autocomplete="position">
                                @error('position')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Invalid Position</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="nic" class="col-md-4 col-form-label text-md-end">{{ __('Registered Number') }}</label>

                            <div class="col-md-6">
                                <input id="regNum" type="text" class="form-control @error('regNum') is-invalid @enderror" name="regNum" value="{{ old('regNum') }}" required autocomplete="nic">
                                @error('regNum')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Invalid Registered Number</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="contact" class="col-md-4 col-form-label text-md-end">{{ __('Contact Number') }}</label>

                            <div class="col-md-6">
                                <input id="contact" type="number" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact') }}" required autocomplete="contact">
                                @error('contact')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="reset" class="custom-btn pt-1 pb-1">
                                    {{ __('Reset') }}
                                </button>
                                <button type="submit" class="custom-btn pt-1 pb-1">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection