@extends('layouts.doctorlayout')
@section('content')

<section class="section-padding section-bg mb-0 pt-5">
    <div class="row custom-text-box " style="margin:10px 10px;">
        <div class="col-md-3 mb-3" style="text-align:center;">
            <div class="card bg-primary text-white h-100">
                <div class="card-body py-5 pb-0">Total Number of Appointments Today</div>
                <h1 style="padding:10px;">test</h1>
                <a href="/doctor/visitings" style="color:white;">
                    <div class="card-footer d-flex">
                        View Details
                        <span class="ms-auto">
                            <i class="bi bi-chevron-right"></i>
                        </span>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-warning text-white h-100" style="text-align:center;">
                <div class="card-body py-5 pb-0">Total Number of Sessions Today</div>
                <h1 style="padding:10px;">test</h1>
                <a href="/doctor/visitings" style="color:white;">
                    <div class="card-footer d-flex">
                        View Details
                        <span class="ms-auto">
                            <i class="bi bi-chevron-right"></i>
                        </span>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-success text-white h-100" style="text-align:center;">
                <div class="card-body py-5 pb-0">Next Session Start Time and Room</div>
                <h1 style="padding:10px;">test</h1>
                <a href="/doctor/visitings" style="color:white;">
                    <div class="card-footer d-flex">
                        View Details
                        <span class="ms-auto">
                            <i class="bi bi-chevron-right"></i>
                        </span>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-danger text-white h-100" style="text-align:center;">
                <div class="card-body py-5 pb-0">Total Earning for This Month</div>
                <h1 style="padding:10px;">test</h1>
                <a href="/doctor/visitings" style="color:white;">
                    <div class="card-footer d-flex">
                        View Details
                        <span class="ms-auto">
                            <i class="bi bi-chevron-right"></i>
                        </span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    @if (Session::has('error'))
    <div class="alert alert-success text-center">
        <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
        <p>{{ Session::get('error') }}</p>
    </div>
    @endif
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
                    <a href="/todaysession/{{Auth::user()->id}}" class="d-block " style="text-decoration:none;">
                        <img src="/images/session.jpg " class="featured-block-image img-fluid mt-2" alt=" " height="130px" width="130px">
                        <p class="featured-block-text " style="text-decoration:none;">Start <strong>Today Session</strong></p>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 ">
                <div class="featured-block d-flex justify-content-center align-items-center ">
                    <a href="{{ route('patient') }}" class="d-block " style="text-decoration:none;">
                        <img src="/images/test4.jpg " class="featured-block-image img-fluid mt-2" alt=" " height="130px" width="130px">
                        <p class="featured-block-text " style="text-decoration:none;">New <strong>Patient</strong></p>
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