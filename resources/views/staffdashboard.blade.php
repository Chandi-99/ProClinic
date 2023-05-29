@extends('layouts.stafflayout')
@section('content')
    <div class="container ">
        <div class="row ">
            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 ">
                <div class="featured-block d-flex justify-content-center align-items-center ">
                    <a href="" class="d-block "  style="text-decoration:none;">
                    <img src="/images/doctor.jpg " class="featured-block-image img-fluid mt-2" alt=" " height="130px" width="130px">
                    <p class="featured-block-text " style="text-decoration:none;">Make an <strong>Appointment</strong></p>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 ">
                <div class="featured-block d-flex justify-content-center align-items-center ">
                    <a href="" class="d-block "  style="text-decoration:none;">
                    <img src="/images/doctor.jpg " class="featured-block-image img-fluid mt-2" alt=" " height="130px" width="130px">
                    <p class="featured-block-text " style="text-decoration:none;">New <strong>Patient</strong></p>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 ">
                <div class="featured-block d-flex justify-content-center align-items-center ">
                    <a href="" class="d-block "  style="text-decoration:none;">
                    <img src="/images/doctor.jpg " class="featured-block-image img-fluid mt-2" alt=" " height="130px" width="130px">
                    <p class="featured-block-text " style="text-decoration:none;">Make an <strong>Appointment</strong></p>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 ">
                <div class="featured-block d-flex justify-content-center align-items-center ">
                    <a href="" class="d-block "  style="text-decoration:none;">
                    <img src="/images/doctor.jpg " class="featured-block-image img-fluid mt-2" alt=" " height="130px" width="130px">
                    <p class="featured-block-text " style="text-decoration:none;">Make an <strong>Appointment</strong></p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!--
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card">
              <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span> Appointments Scheduled for Today
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table
                    id="example"
                    class="table table-striped data-table"
                    style="width: 100%"
                    >
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Donna Snider</td>
                        <td>Customer Support</td>
                        <td>New York</td>
                        <td>27</td>
                        <td>2011/01/25</td>
                        <td>$112,000</td>
                      </tr>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

    -->



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