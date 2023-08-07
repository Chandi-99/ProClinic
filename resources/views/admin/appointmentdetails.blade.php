@extends('layouts.adminlayout')
@section('content')
<div class="container">
<div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align:center;"><b>{{ __('Search Appointment') }}</b></div>
                <div class="card-body">
                    <form method="POST" action="{{route('appointmentdetails.search')}}">
                        @csrf
                        <div class="row mb-3">
                            <label for="appo_id" class="col-md-4 col-form-label text-md-end">{{ __('Appointment ID') }}</label>
                            <div class="col-md-6">
                                <input id="appo_id" type="number" class="form-control @error('appo_id') is-invalid @enderror" name="appo_id" autocomplete="appo_id" autofocus>
                                @error('appo_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Invalid Appointment ID</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="doctor_id" class="col-md-4 col-form-label text-md-end">{{ __('Doctor Name') }}</label>
                            <div class="col-md-6">
                                <select id="doctor_id" type="text" class="form-control @error('doctor_name') is-invalid @enderror" name="doctor_id"  autocomplete="doctor_id" autofocus>
                                @foreach($doctors as $doctor)
                                <option value="{{$doctor->id}}">{{$doctor->fname}} {{$doctor->lname}}</option>
                                @endforeach
                                </select>
                                @error('doctor_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Invalid Doctor Name</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="patient_id" class="col-md-4 col-form-label text-md-end">{{ __('Doctor Name') }}</label>
                            <div class="col-md-6">
                                <select id="patient_id" type="text" class="form-control @error('doctor_name') is-invalid @enderror" name="patient_id"  autocomplete="patient_id" autofocus>
                                @foreach($patients as $patient)
                                <option value="{{$patient->patient_id}}">{{$patient->fname}} {{$patient->lname}}</option>
                                @endforeach
                                <select>
                                @error('patient_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Invalid patient Name</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="appointmentdate" class="col-md-4 col-form-label text-md-end">{{ __('Appointment Date') }}</label>
                            <div class="col-md-6">
                                <input id="appointmentdate" type="date" class="form-control @error('appointmentdate') is-invalid @enderror" name="appointmentdate" autocomplete="appointmentdate" autofocus>
                                @error('appointmentdate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Invalid Date</strong>
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
                    <th class="text-center">Appointment ID</th>
                    <th class="text-center">Appointment Number</th>
                    <th class="text-center">Room Name</th>
                    <th class="text-center">Date</th>
                    <th class="text-center">Doctor Name</th>
                    <th class="text-center">Patient Name</th>
                    <th class="text-center">Type</th>
                    <th class="text-center">Start Time</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                <tr>
                    <td class="text-center">Appo_{{ $appointment->id }}</td>
                    <td class="text-center">{{ $appointment->appo_number }}</td>
                    <td class="text-center">{{ $appointment->Visiting->Room->room_name }}</td>
                    <td class="text-center">{{ $appointment->date }}</td>
                    <td class="text-center">{{ $appointment->Visiting->Doctor->fname }} {{ $appointment->Visiting->Doctor->lname }}</td>
                    <td class="text-center">{{ $appointment->Patient()->fname }} {{ $appointment->Patient()->lname }}</td>
                    <td class="text-center">{{ $appointment->Visiting->type }}</td>
                    <td class="text-center">{{ $appointment->start_time }}</td>
                    <td class="text-center">{{ $appointment->status}}</td>
                </tr>
                @endforeach
                @foreach($search_appointments as $appointment)
                <tr>
                    <td class="text-center">Appo_{{ $appointment[0]->id }}</td>
                    <td class="text-center">{{ $appointment[0]->appo_number }}</td>
                    <td class="text-center">{{ $appointment[0]->Visiting->Room->room_name }}</td>
                    <td class="text-center">{{ $appointment[0]->date }}</td>
                    <td class="text-center">{{ $appointment[0]->Visiting->Doctor->fname }} {{ $appointment[0]->Visiting->Doctor->lname }}</td>
                    <td class="text-center">{{ $appointment[0]->Patient()->fname }} {{ $appointment[0]->Patient()->lname }}</td>
                    <td class="text-center">{{ $appointment[0]->Visiting->type }}</td>
                    <td class="text-center">{{ $appointment[0]->start_time }}</td>
                    <td class="text-center">{{ $appointment[0]->status}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </br>

</div>
@endsection