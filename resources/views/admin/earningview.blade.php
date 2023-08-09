@extends('layouts.adminlayout')
@section('content')
<section class="section-padding section-bg mb-0 pt-0 mt-0 pt-0">
    <div class="container pt-3">
        @if($monthly == 'yes')
        <h5 class="text-center">ProClinic Earning Report (Month - {{$thismonthName}})</h5>
        @else
        <h5 class="text-center">ProClinic Earning Report Overall</h5>
        @endif
        </br>
        <div class="col-md-8" style="margin:0 auto;">
            <div class="card pt-3 mb-3">
                <div class="card-body">
                    <div class="top-right" style="float:right; margin-right:20px;">
                        <div class="menu-icon">
                            <span class="icon" style="float:right;">&#9776;</span>
                            <div class="dropdownNew">
                                <a href='/viewearnings' id="mark-all-read">This Month</a>
                                <a href='/viewearnings/overall' id="mark-all-unread">Overall</a>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 pt-3" style="padding-left: 100px; padding-right: 100px; font-size:larger;">
                        <label class="col-form-label"><strong>Total Revenue: </strong>Rs.{{$totalRevenue}}.00</label></br>
                        <label class="col-form-label"><strong>Total Expenses: </strong>Rs.{{$totalExpenses}}.00 </label>
                        <label class="col-form-label"><strong>Total Patient Visits: </strong> {{$totalAppointments}}</lable></br>
                        <label class="col-form-label"><strong>Total Doctor Charges: </strong> Rs.{{$totalDoctorCharges}}.00</label></br>
                        <label class="col-form-label"><strong>Average Revenue Per Person: </strong> {{$avergaeRevenue}}</label></br>
                        <label class="col-form-label"><strong>Total Profit: </strong> Rs.{{$totalProfit}}.00</label></br>
                        <label class="col-form-label"><strong>Target Profit: </strong> Rs.{{$targetProfit}}.00 </label></br>
                        @if($monthly == 'yes')
                        <label class="col-form-label"><strong>Number of Days Remaining to Reach the Goal: </strong> {{$numberofDaysRemain}} </label></br>
                        @endif
                        @if($monthly == 'yes')
                            <div class="progress">
                            @if($profitPercentage == 0)
                                <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow=" totalEarnings " aria-valuemin="0" aria-valuemax="100"></div>
                            @elseif($profitPercentage < 10)
                                <div class="progress-bar" role="progressbar" style="width: 10%;" aria-valuenow=" totalEarnings " aria-valuemin="0" aria-valuemax="100"></div>
                            @elseif($profitPercentage < 20)
                                <div class="progress-bar" role="progressbar" style="width: 20%;" aria-valuenow=" totalEarnings " aria-valuemin="0" aria-valuemax="100"></div>
                            @elseif($profitPercentage < 30)
                                <div class="progress-bar" role="progressbar" style="width: 30%;" aria-valuenow=" totalEarnings " aria-valuemin="0" aria-valuemax="100"></div>
                            @elseif($profitPercentage < 40)
                                <div class="progress-bar" role="progressbar" style="width: 40%;" aria-valuenow=" totalEarnings " aria-valuemin="0" aria-valuemax="100"></div>
                            @elseif($profitPercentage < 50)
                                <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow=" totalEarnings " aria-valuemin="0" aria-valuemax="100"></div>
                            @elseif($profitPercentage < 60)
                                <div class="progress-bar" role="progressbar" style="width: 60%;" aria-valuenow=" totalEarnings " aria-valuemin="0" aria-valuemax="100"></div>
                            @elseif($profitPercentage < 70)
                                <div class="progress-bar" role="progressbar" style="width: 70%;" aria-valuenow=" totalEarnings " aria-valuemin="0" aria-valuemax="100"></div>
                            @elseif($profitPercentage < 80)
                                <div class="progress-bar" role="progressbar" style="width: 80%;" aria-valuenow=" totalEarnings " aria-valuemin="0" aria-valuemax="100"></div> 
                            @elseif($profitPercentage < 90)
                                <div class="progress-bar" role="progressbar" style="width: 90%;" aria-valuenow=" totalEarnings " aria-valuemin="0" aria-valuemax="100"></div>
                            @elseif($profitPercentage < 100)
                                <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow=" totalEarnings " aria-valuemin="0" aria-valuemax="100"></div>
                            @endif
                            </div></br>
                        @else
                        <!-- <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: {{$profitPercentage}}%;" aria-valuenow=" totalEarnings " aria-valuemin="0" aria-valuemax="100"></div>
                        </div></br> -->
                        @endif
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="/admin" class="custom-btn pt-1 pb-1">
                                    {{ __('Back') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="cutom-text-box">
            <div class="message-container">
                <div class="message-box" style="margin-bottom:20px;padding-left:50px;">
                    <h5>Highest Demanding Doctor </h5>
                    </br>
                    <p class="mt-0 mb-0" ><span style="color:black;">Doctor Name: </span>{{$HDDName}} </p>
                    <p class="mt-0 mb-0"><span style="color:black;">Total Number of Appointments: </span>{{$HHDAppoCount}}</p>
                    <p class="mt-0 mb-0"><span style="color:black;">Total Earning for that Doctor: </span>Rs.{{$HDDEarn}}.00</p>
                    <span><img src="/images/top.png " style="width:70px; height:70px; float:right;" /></span>
                </div>
                <div class="message-box" style="margin-bottom:20px; padding-left:50px;">
                    <h5>Cost Per Procedure </h5>
                    </br>
                    <p class="mt-0 mb-0"><span style="color:black;">Cost Per Procedure Up-to-date: </span>{{$CPP}} </p>
                    <p class="mt-0 mb-0"><span style="color:black;">Number of Appointments: </span>{{$totalAppointments}}</p>
                    <p class="mt-0 mb-0"><span style="color:black;">Total Cost: </span>{{$totalExpenses}}</p>
                    <span><img src="/images/cpp.jpg " style="width:70px; height:70px; float:right;" /></span>
                </div>
                <div class="message-box" style="margin-bottom:20px; padding-left:50px;">
                    <h5>Highest Selling Medicine </h5>
                    </br>
                    <p class="mt-0 mb-0"><span style="color:black;">Medicine Name: </span>{{$mostUsedMedicine}}</p>
                    <p class="mt-0 mb-0"><span style="color:black;">Unit Price: </span>{{$mediUnitPrice}}</p>
                    <p class="mt-0 mb-0"><span style="color:black;">Number of Units Sold: </span>{{$mediSoldCount}}</p>
                    <span><img src="/images/medi.png " style="width:70px; height:70px; float:right;" /></span>
                </div>
                <div class="message-box" style="margin-bottom:20px; padding-left:50px;">
                    <h5>Total Number of Appointments</h5>
                    </br>
                    <p class="mt-0 mb-0"><span style="color:black;">Finished Appointments: </span>{{$finishedAppoCount}} </p>
                    <p class="mt-0 mb-0"><span style="color:black;">Incoming Appointments: </span> {{$incomingAppoCount}}</p>
                    <p class="mt-0 mb-0"><span style="color:black;">Absent Patients: </span>{{$absentpatients}}</p>
                    <span><img src="/images/apponew.png " style="width:70px; height:70px; float:right;" /></span>
                </div>
                <div class="message-box" style="margin-bottom:20px; padding-left:50px;">
                    <h5>Prefered Appointment Method </h5>
                    </br>
                    <p class="mt-0 mb-0"><span style="color:black;">Physical Appoitnments: </span>{{$physicalCount}} </p>
                    <p class="mt-0 mb-0"><span style="color:black;">Virtual Appoitnments: </span>{{$virtualCount}} </p>
                    <p class="mt-0 mb-0"><span style="color:black;">Physical to Virtual Ratio: </span>{{$ratio}} </p>
                    <span><img src="/images/physical.png " style="width:70px; height:70px; float:right;" /></span>
                </div>
                <div class="message-box" style="margin-bottom:20px; padding-left:50px;">
                    <h5>Overloaded Session</h5>
                    </br>
                    <p class="mt-0 mb-0"><span style="color:black;">Session: </span>{{$session}} </p>
                    <p class="mt-0 mb-0"><span style="color:black;">Total Appointments: </span>{{$sessionAppo}}</p>
                    <p class="mt-0 mb-0"><span style="color:black;">Total Number of Visitings: </span>{{$sessionVisitings}}</p>
                    <span><img src="/images/sessionnew.jpg " style="width:70px; height:70px; float:right;" /></span>
                </div>
            </div>
        </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const icon = document.querySelector(".icon");
        const dropdownNew = document.querySelector(".dropdownNew");

        icon.addEventListener("click", function() {
            dropdownNew.style.display = dropdownNew.style.display === "block" ? "none" : "block";
        });

    });
</script>
@endsection