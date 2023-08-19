@extends('layouts.stafflayout')
@section('content')
<section class="section-padding section-bg mb-0 pt-1">
    <div class="container pt-3">
        <div class="row justify-content-center mb-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="text-align:center;"><b>{{ __('Search Patient') }}</b></div>

                    <div class="card-body">
                        <form method="POST" action="{{route('patientDetails.search')}}">
                            @csrf
                            <div class="row mb-3">
                                <label for="fname" class="col-md-4 col-form-label text-md-end">{{ __('Patient First Name') }}</label>
                                <div class="col-md-6">
                                    <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" required autocomplete="fname" autofocus>
                                    @error('fname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Invalid First Name</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="fname" class="col-md-4 col-form-label text-md-end">{{ __('Patient Last Name') }}</label>
                                <div class="col-md-6">
                                    <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" required autocomplete="fname" autofocus>
                                    @error('fname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Invalid Last Name</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <a href="/staff" class="custom-btn pt-1 pb-1" style="margin-right:10px;">
                                        {{ __('Back') }}
                                    </a>
                                    <button type="submit" class="custom-btn pt-1 pb-1">
                                        {{ __('Search') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3 custom-text-box">
            <h5 style="text-align:center;">Registered Patients</h5>
            <table id="rooms" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Patient ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Gender</th>
                        <th>Date of Birth</th>
                        <th>Address</th>
                        <th>Registered Day</th>
                        <th>Contact</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($patients as $patient)
                    <tr>
                        <td>St_{{ $patient->patient_id }}</td>
                        <td>{{ $patient->fname }}</td>
                        <td>{{ $patient->lname }}</td>
                        <td>{{ $patient->gender }}</td>
                        <td>{{ $patient->dob }}</td>
                        <td>{{ $patient->address }}</td>
                        <td>{{ $patient->created_at->format('Y-m-d') }}</td>
                        <td>0{{ $patient->contact }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </br>
    </div>
</section>
@endsection