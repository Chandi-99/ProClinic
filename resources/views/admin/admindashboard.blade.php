@extends('layouts.adminlayout')
@section('content')
      <div class="container-fluid" >
        <h1 style="text-align:center; color:black;font-size:30px; padding-bottom:5px;">Admin Dashboard</h1>
        <div class="row">
          <div class="col-md-3 mb-3" style="text-align:center;">
            <div class="card bg-primary text-white h-100">
              <div class="card-body py-5 pb-0" >Total Number of Patients Registered</div>
              <h1 style="padding:10px;">test</h1>
              <div class="card-footer d-flex">
                View Details
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="card bg-warning text-white h-100" style="text-align:center;">
              <div class="card-body py-5 pb-0">Total Number of Doctors Registered</div>
              <h1 style="padding:10px;">test</h1>
              <div class="card-footer d-flex">
                View Details
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="card bg-success text-white h-100" style="text-align:center;">
              <div class="card-body py-5 pb-0">Total Number of Appointments Today</div>
              <h1 style="padding:10px;">test</h1>
              <div class="card-footer d-flex">
                View Details
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="card bg-danger text-white h-100" style="text-align:center;">
              <div class="card-body py-5 pb-0">Total Earning for this month</div>
              <h1 style="padding:10px;">test</h1>
              <div class="card-footer d-flex">
                View Details
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
       
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
                        <th>Patient Name</th>
                        <th>Doctor Name</th>
                        <th>Type</th>
                        <th>Session</th>
                        <th>Start Time</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <!-- <tbody>
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
                    </tfoot> -->
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endsection