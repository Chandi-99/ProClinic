@extends('layouts.adminlayout')
@section('content')
<div class="container">
<div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align:center;"><b>{{ __('Search Doctor') }}</b></div>
                <div class="card-body">
                    <form method="POST" action="{{route('doctordetails.search')}}">
                        @csrf
                        <div class="row mb-3">
                            <label for="fname" class="col-md-4 col-form-label text-md-end">{{ __('Doctor First Name') }}</label>
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
                            <label for="fname" class="col-md-4 col-form-label text-md-end">{{ __('Doctor Last Name') }}</label>
                            <div class="col-md-6">
                                <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" required autocomplete="fname" autofocus>
                                @error('fname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Invalid First Name</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a type="reset" href="/admin" class="custom-btn pt-1 pb-1">
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
    <div class="row mt-3">
        <h5 style="text-align:center;">Registered Doctors</h5>
        <table id="rooms" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Doctor ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Date of Birth</th>
                    <th>Registration Number</th>
                    <th>Specialization</th>
                    <th>Normal Rate</th>
                    <th>E-channeling Rate</th>
                    <th>Registered Day</th>
                    <th>Contact</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($doctors as $doctor)
                <tr>
                    <td>Doc_{{ $doctor->id }}</td>
                    <td>{{ $doctor->fname }}</td>
                    <td>{{ $doctor->lname }}</td>
                    <td>{{ $doctor->gender }}</td>
                    <td>{{ $doctor->dob }}</td>
                    <td>{{ $doctor->regNum }}</td>
                    <td>{{ $doctor->specialization }}</td>
                    <td>{{ $doctor->normal_rate }}</td>
                    @if($doctor->echanneling_rate  == 0)
                    <td>__('Not Registered') </td>
                    @else
                    <td>{{ $doctor->echanneling_rate }}</td>
                    @endif
                    <td>{{ $doctor->created_at->format('Y-m-d') }}</td>
                    <td>0{{ $doctor->contact }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </br>

</div>
@endsection