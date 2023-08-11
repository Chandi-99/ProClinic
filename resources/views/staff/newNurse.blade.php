@extends('layouts.stafflayout')
@section('content')
<section class="section-padding section-bg mb-0 pt-1">
    <div class="container pt-3">
        <div class="row justify-content-center mb-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="text-align:center;"><b>{{ __('Registration for Nurses') }}</b></div>

                    <div class="card-body">
                        <form method="POST" action="{{route('newNurse.store')}}">
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
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('regNum') is-invalid @enderror" name="email" value="{{ old('regNum') }}" required autocomplete="nic">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Invalid Email Address.</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="contact" class="col-md-4 col-form-label text-md-end">{{ __('Contact Number') }}</label>

                                <div class="col-md-6">
                                    <input id="contact" type="number" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact') }}" required autocomplete="contact" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10">
                                    @error('contact')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <a href="/rooms" class="custom-btn pt-2 pb-2" style="margin-right: 10px;;">
                                        {{ __('Back') }}
                                    </a>
                                    <button type="submit" class="custom-btn pt-2 pb-2">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row custom-text-box">
            <h5 class="text-center">All Registered Nurses</h5>
            <table id="rooms" class="table table-striped table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>Nurse ID</th>
                        <th>Nurse Name</th>
                        <th>Gender</th>
                        <th>Registered Number</th>
                        <th>Position</th>
                        <th>Email</th>
                        <th>Contact</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nurses as $nurse)
                    <tr class="text-center">
                        <td>{{ $nurse->id }}</td>
                        <td>{{ $nurse->fname }} {{ $nurse->lname }}</td>
                        <td>{{ $nurse->gender }}</td>
                        <td>{{ $nurse->regNum }}</td>
                        <td>{{ $nurse->position }}</td>
                        <td>{{ $nurse->email }}</td>
                        <td>{{ $nurse->contact }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection