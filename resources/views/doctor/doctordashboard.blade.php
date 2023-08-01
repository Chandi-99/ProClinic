@extends('layouts.doctorlayout')
@section('content')

<section class="section-padding section-bg mb-0 pt-5">
    <div class="container custom-text-box">
        <p><strong>Doctor Name: </strong>{{$docname}}</p>
        <p><strong>Specialization: </strong>{{$speciality}}</p>
        <h3 class="text-center">Today's Appointments</h3>
        <table id="rooms" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th style="border:1px solid black; padding:10px;" class="text-center">Appointment ID</th>
                    <th style="border:1px solid black; padding:10px;" class="text-center">Appointment Number</th>
                    <th style="border:1px solid black; padding:10px;" class="text-center">Appointment Type</th>
                    <th style="border:1px solid black; padding:10px;" class="text-center">Date</th>
                    <th style="border:1px solid black; padding:10px;" class="text-center">Patient Name</th>
                    <th style="border:1px solid black; padding:10px;" class="text-center">Room Name</th>
                    <th style="border:1px solid black; padding:10px;" class="text-center">Patient Contact Number</th>
                    <th style="border:1px solid black; padding:10px;" class="text-center">Status</th>
                </tr>
                @for ($i = 0; $i <= $length; $i++) <tr>
                    <td style="border:1px solid black; padding:10px;" class="text-center">{{$appointments[0][$i]->id}}</td>
                    <td style="border:1px solid black; padding:10px;" class="text-center">{{$appointments[0][$i]->appo_number}}</td>
                    <td style="border:1px solid black; padding:10px;" class="text-center">{{$appointments[0][$i]->visiting->type}}</td>
                    <td style="border:1px solid black; padding:10px;" class="text-center">{{$appointments[0][$i]->date}}</td>
                    <td style="border:1px solid black; padding:10px;" class="text-center">{{$appointments[0][$i]->Patient()->fname}} {{$appointments[0][$i]->Patient()->lname}} </td>
                    <td style="border:1px solid black; padding:10px;" class="text-center">{{$appointments[0][$i]->visiting->Room->room_name}}</td>
                    <td style="border:1px solid black; padding:10px;" class="text-center">0{{$appointments[0][$i]->Patient()->contact}}</td>
                    <td style="border:1px solid black; padding:10px;" class="text-center">{{$appointments[0][$i]->status}}</td>
                    </tr>
                @endfor
            </thead>
        </table>
    </div>
    </br>
    </br>
    </br>
    <div class="container custom-text-box">
        <div class="row ">
            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 ">
                <div class="featured-block d-flex justify-content-center align-items-center ">
                    <a href="/doctor/visitings" class="d-block " style="text-decoration:none;">
                        <img src="/images/appo.png " class="featured-block-image img-fluid mt-2" alt=" " height="130px" width="130px">
                        <p class="featured-block-text " style="text-decoration:none;">Manage <strong>Visitings</strong></p>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 ">
                <div class="featured-block d-flex justify-content-center align-items-center ">
                    <a href="{{ route('patient') }}" class="d-block " style="text-decoration:none;">
                        <img src="/images/session.jpg " class="featured-block-image img-fluid mt-2" alt=" " height="130px" width="130px">
                        <p class="featured-block-text " style="text-decoration:none;">Start <strong>Today Session</strong></p>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 ">
                <div class="featured-block d-flex justify-content-center align-items-center ">
                    <a href="{{route('room')}}" class="d-block " style="text-decoration:none;">
                        <img src="/images/money.jpg " class="featured-block-image img-fluid mt-2" alt=" " height="130px" width="130px">
                        <p class="featured-block-text " style="text-decoration:none;">Monthly <strong>Earning</strong></p>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 ">
                <div class="featured-block d-flex justify-content-center align-items-center ">
                    <a href="/editDoctor/{{Auth::user()->id}}" class="d-block " style="text-decoration:none;">
                        <img src="/images/doctor.jpg " class="featured-block-image img-fluid mt-2" alt=" " height="130px" width="130px">
                        <p class="featured-block-text " style="text-decoration:none;">Edit <strong>Profile</strong></p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    </br>
    </br>
</section>
@endsection