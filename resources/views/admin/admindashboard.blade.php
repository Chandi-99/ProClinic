@extends('layouts.adminlayout')
@section('content')
<div class="container-fluid">
  <h1 style="text-align:center; color:black;font-size:30px; padding-bottom:5px;">Admin Dashboard</h1>
  <div class="row">
    <div class="col-md-3 mb-3" style="text-align:center;">
      <div class="card bg-primary text-white h-100">
        <div class="card-body py-5 pb-0">Total Number of Patients Registered</div>
        <h1 style="padding:10px;">{{$patientcount}}</h1>
        <div class="card-footer d-flex">
          <a href="{{route('patientdetails')}}" style="color:white;">View Details</a>
          <span class="ms-auto">
            <i class="bi bi-chevron-right"></i>
          </span>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card bg-warning text-white h-100" style="text-align:center;">
        <div class="card-body py-5 pb-0">Total Number of Doctors Registered</div>
        <h1 style="padding:10px;">{{$doctorcount}}</h1>
        <div class="card-footer d-flex">
          <a href="{{route('doctordetails')}}" style="color:white;">View Details</a>
          <span class="ms-auto">
            <i class="bi bi-chevron-right"></i>
          </span>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card bg-success text-white h-100" style="text-align:center;">
        <div class="card-body py-5 pb-0">Total Number of Appointments Today</div>
        <h1 style="padding:10px;">{{$appointmentcount}}</h1>
        <div class="card-footer d-flex">
          <a href="{{ route('appointmentdetails') }}" style="color:white;">View Details</a>
          <span class="ms-auto">
            <i class="bi bi-chevron-right"></i>
          </span>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card bg-danger text-white h-100" style="text-align:center;">
        <div class="card-body py-5 pb-0">Total Earning for this month</div>
        <h1 style="padding:10px;">Rs. {{$total}}.00</h1>
        <div class="card-footer d-flex">
          <a href="#" style="color:white;">View Details</a>
          <span class="ms-auto">
            <i class="bi bi-chevron-right"></i>
          </span>
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
      </tbody>
    </table>
  </div>
</div>
@endsection