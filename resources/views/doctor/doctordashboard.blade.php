@extends('layouts.doctorlayout')
@section('content')

<section class="news-section section-padding mt-0 pt-2">
<div class="container">
<h3 class="text-center">Today Appointments</h3>
        <table id="rooms" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Appointment ID</th>
                    <th>Appointment Type</th>
                    <th>Number</th>
                    <th>Doctor Name</th>
                    <th>Patient Name</th>
                    <th>Room Name</th>
                    <th>Patient Contact Number</th>
                    <th>Status</th>
                </tr>
                <tr></tr>
            </thead>
        </table>
    </div>
</br>
</br>
</br>
    <div class="container ">
        <div class="row ">
            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 ">
                <div class="featured-block d-flex justify-content-center align-items-center ">
                    <a href="/doctor/visitings" class="d-block "  style="text-decoration:none;">
                    <img src="/images/appo.png " class="featured-block-image img-fluid mt-2" alt=" " height="130px" width="130px">
                    <p class="featured-block-text " style="text-decoration:none;">Manage <strong>Visitings</strong></p>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 ">
                <div class="featured-block d-flex justify-content-center align-items-center ">
                    <a href="{{ route('patient') }}" class="d-block "  style="text-decoration:none;">
                    <img src="/images/session.jpg " class="featured-block-image img-fluid mt-2" alt=" " height="130px" width="130px">
                    <p class="featured-block-text " style="text-decoration:none;">Start <strong>Today Session</strong></p>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 ">
                <div class="featured-block d-flex justify-content-center align-items-center ">
                    <a href="{{route('room')}}" class="d-block "  style="text-decoration:none;">
                    <img src="/images/money.jpg " class="featured-block-image img-fluid mt-2" alt=" " height="130px" width="130px">
                    <p class="featured-block-text " style="text-decoration:none;">Monthly <strong>Earning</strong></p>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 ">
                <div class="featured-block d-flex justify-content-center align-items-center ">
                    <a href="{{route('doctor')}}" class="d-block "  style="text-decoration:none;">
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
<script>
$(document).ready(function() {
    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{!! route('staffdashboard') !!}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
});
</script>
@endsection