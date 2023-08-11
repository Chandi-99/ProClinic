@extends('layouts.stafflayout')
@section('content')
<div class="container">
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header" style="text-align:center;"><b>{{ __('Registration for Doctors') }}</b></div>

                <div class="card-body">
                    <form method="POST" action="{{route('doctor.create')}}">
                        @csrf
                        <div class="text-center">
                        @if(session('alert_2'))
                            <div class="alert alert-success">
                                {{ session('alert_2') }}
                            </div>
                        @endif
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('User Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
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
                                    <option >Male</option>
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
                            <label for="specialization" class="col-md-4 col-form-label text-md-end">{{ __('Specialization') }}</label>

                            <div class="col-md-6">
                                <select id="gender" type="text" class="form-control @error('specialization') is-invalid @enderror" name="specialization" value="{{ old('specialization') }}" required autocomplete="specialization">
                                    <option value="General">General</option>
                                    <option value="Pediatrics">Pediatrics</option>
                                    <option value="Internal Medicine">Internal Medicine</option>
                                    <option value="Surgery">Surgery</option>
                                    <option value="Obstetrics and Gynecology">Obstetrics and Gynecology</option>
                                    <option value="Psychiatry">Psychiatry</option>
                                    <option value="Cardiology">Cardiology</option>
                                    <option value="Oncology">Oncology</option>
                                    <option value="Neurology">Neurology</option>
                                </select>
                                @error('specialization')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Invalid Specialization</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="row mb-3">
                            <label for="echanneling" class="col-md-4 col-form-label text-md-end">{{ __('E-channeling') }} </label>

                            <div class="col-md-6">
                                <select id="echanneling" type="text" class="form-control @error('echanneling') is-invalid @enderror" name="echanneling" value="{{ old('echanneling') }}" required autocomplete="echanneling">
                                    <option >Yes</option>
                                    <option selected>No</option>
                                </select>
                                @error('echanneling')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Echanneling status was Unidentified</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3" id="echanneling_rate" hidden>
                            <label for="nic" class="col-md-4 col-form-label text-md-end">{{ __('E-Channeling Rate') }} (Rs.)</label>

                            <div class="col-md-6" >
                                
                            <input type="number" id="echanneling_rate" name="echanneling_rate" class="form-control @error('echanneling_rate') is-invalid @enderror"  value="{{ old('echanneling_rate') }}" required autocomplete="echanneling_rate" >

                            <script>
                                document.querySelector('select[name="echanneling"]').addEventListener('change', function() {
                                if (this.value === 'Yes') {
                                    document.getElementById('echanneling_rate').hidden = false;
                                } else if(this.value === 'No') {
                                    document.getElementById('echanneling_rate').hidden = true;
                                }
                            });
                            </script>
                            @error('echanneling_rate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Invalid echanneling_rate</strong>
                                    </span>
                            @enderror
                            </div>
                        </div>


                        <div class="row mb-3" id="normal_rate">
                            <label for="nic" class="col-md-4 col-form-label text-md-end">{{ __('Normal Channeling Rate') }} (Rs.)</label>

                            <div class="col-md-6" >
                                
                            <input type="number" id="normal_rate" name="normal_rate" class="form-control @error('normal_rate') is-invalid @enderror"  value="{{ old('normal_rate') }}" required autocomplete="normal_rate" >

                            @error('normal_rate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Invalid normal_rate</strong>
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
                                <a href="/staff" class="custom-btn pt-1 pb-1" style="margin-right:10px;">
                                    Back
                                </a>
                                <button type="submit" class="custom-btn pt-1 pb-1" >
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
