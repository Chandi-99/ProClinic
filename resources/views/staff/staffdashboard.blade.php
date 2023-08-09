@extends('layouts.stafflayout')
@section('content')
<section class="section-padding section-bg mb-0 pt-1">
    <div class="row mt-2 custom-text-box" style="margin-left:20px;margin-right:20px;">
        <div class="col-md-3 mb-3" style="text-align:center;">
            <div class="card bg-primary text-white h-100">
                <div class="card-body py-5 pb-0">Total Number of Sessions Today</div>
                <h1 style="padding:10px;">{{$sessioncount}}</h1>
                <div class="card-footer d-flex">
                    <a href="{{route('patient')}}" style="color:white;">View Details</a>
                    <span class="ms-auto">
                        <i class="bi bi-chevron-right"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-warning text-white h-100" style="text-align:center;">
                <div class="card-body py-5 pb-0">Total Number of Appointments Today</div>
                <h1 style="padding:10px;">{{$appointmentcount}}</h1>
                <div class="card-footer d-flex">
                    <a href="{{route('appointmentDetails')}}" style="color:white;">View Details</a>
                    <span class="ms-auto">
                        <i class="bi bi-chevron-right"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-success text-white h-100" style="text-align:center;">
                <div class="card-body py-5 pb-0">Total Number of New Messages</div>
                <h1 style="padding:10px;">{{$messagecount}}</h1>
                <div class="card-footer d-flex">
                    <a href="{{ route('viewmessages') }}" style="color:white;">View Details</a>
                    <span class="ms-auto">
                        <i class="bi bi-chevron-right"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-danger text-white h-100" style="text-align:center;">
                <div class="card-body py-5 pb-0">Total Number of New Applications</div>
                <h1 style="padding:10px;">{{$applicationcount}}</h1>
                <div class="card-footer d-flex">
                    <a href="{{ route('viewapplications') }}" style="color:white;">View Details</a>
                    <span class="ms-auto">
                        <i class="bi bi-chevron-right"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="row custom-text-box mt-2" style="margin:10px 10px;">
        <div class="row ">
            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 ">
                <div class="featured-block d-flex justify-content-center align-items-center ">
                    <a href="" class="d-block " style="text-decoration:none;">
                        <img src="/images/appo.png " class="featured-block-image img-fluid mt-2" alt=" " height="130px" width="130px">
                        <p class="featured-block-text " style="text-decoration:none;">Make an <strong>Appointment</strong></p>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 ">
                <div class="featured-block d-flex justify-content-center align-items-center ">
                    <a href="{{ route('patient') }}" class="d-block " style="text-decoration:none;">
                        <img src="/images/patient.png " class="featured-block-image img-fluid mt-2" alt=" " height="130px" width="130px">
                        <p class="featured-block-text " style="text-decoration:none;">New <strong>Patient</strong></p>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 ">
                <div class="featured-block d-flex justify-content-center align-items-center ">
                    <a href="{{route('medicine.index')}}" class="d-block " style="text-decoration:none;">
                        <img src="/images/medicine.avif " class="featured-block-image img-fluid mt-2" alt=" " height="130px" width="130px">
                        <p class="featured-block-text " style="text-decoration:none;">New <strong>Medicines</strong></p>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 ">
                <div class="featured-block d-flex justify-content-center align-items-center ">
                    <a href="{{route('doctor')}}" class="d-block " style="text-decoration:none;">
                        <img src="/images/doctor.jpg " class="featured-block-image img-fluid mt-2" alt=" " height="130px" width="130px">
                        <p class="featured-block-text " style="text-decoration:none;">New <strong>Doctor</strong></p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</br>
    <div class="row custom-text-box " style="margin:10px 10px;">
        <h3 class="text-center">Today Appointments</h3>
        <table class="table table-striped table-bordered">
            <thead>
                <tr style="background-color:#5bc1ac;">
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
</section>
@endsection