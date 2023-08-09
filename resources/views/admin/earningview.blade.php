@extends('layouts.adminlayout')
@section('content')
<section class="section-padding section-bg mb-0 pt-0 mt-0 pt-0">
    <div class="container pt-3">
        @if($monthly == 'yes')
        <h5 class="text-center">ProClinic Earning Report (Month - month)</h5>
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
                                <a href='/viewearnings/thismonth' id="mark-all-read">This Month</a>
                                <a href='/viewearnings/overall' id="mark-all-unread">Overall</a>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 pt-3" style="padding-left: 100px; padding-right: 100px; font-size:larger;">
                        <label class="col-form-label"><strong>Total Revenue: </strong> totalEarnings</label></br>
                        <label class="col-form-label"><strong>Total Expenses: </strong> totalMedicineCharges</label>
                        <label class="col-form-label"><strong>Total Patient Visits: </strong> totalAppointments</lable></br>
                        <label class="col-form-label"><strong>Total Doctor Charges: </strong> totalDoctorCharges</label></br>
                        <label class="col-form-label"><strong>Average Revenue Per Person: </strong> revenue/active patients</label></br>
                        <label class="col-form-label"><strong>Total Profit: </strong> revenue-expenses</label></br>
                        <label class="col-form-label"><strong>Target Profit: </strong> $1000 </label></br>
                        <label class="col-form-label"><strong>Number of Days Remaining to Reach the Goal: </strong> 10 Days </label></br>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 40%;" aria-valuenow=" totalEarnings " aria-valuemin="0" aria-valuemax="100"></div>
                        </div></br>
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
                    <p class="mt-0 mb-0" ><strong style="color:black;">Doctor Name: </strong>HDdoctor->fname </p>
                    <p class="mt-0 mb-0"><strong style="color:black;">Total Number of Appointments: </strong></p>
                    <p class="mt-0 mb-0"><strong style="color:black;">Total Earning for that Doctor: </strong></p>
                    <span><img src="/images/top.png " style="width:70px; height:70px; float:right;" /></span>
                </div>
                <div class="message-box" style="margin-bottom:20px; padding-left:50px;">
                    <h5>Cost Per Procedure </h5>
                    </br>
                    <p class="mt-0 mb-0"><strong style="color:black;">Cost Per Procedure Up-to-date: </strong>test </p>
                    <p class="mt-0 mb-0"><strong style="color:black;">Number of Appointments: </strong>test</p>
                    <p class="mt-0 mb-0"><strong style="color:black;">Total Cost: </strong>test</p>
                    <span><img src="/images/cpp.jpg " style="width:70px; height:70px; float:right;" /></span>
                </div>
                <div class="message-box" style="margin-bottom:20px; padding-left:50px;">
                    <h5>Highest Selling Medicine </h5>
                    </br>
                    <p class="mt-0 mb-0"><strong style="color:black;">Medicine Name: </strong>test</p>
                    <p class="mt-0 mb-0"><strong style="color:black;">Unit Price: </strong>test</p>
                    <p class="mt-0 mb-0"><strong style="color:black;">Number of Units Sold: </strong>test</p>
                    <span><img src="/images/medi.png " style="width:70px; height:70px; float:right;" /></span>
                </div>
                <div class="message-box" style="margin-bottom:20px; padding-left:50px;">
                    <h5>Total Number of Appointments</h5>
                    </br>
                    <p class="mt-0 mb-0"><strong style="color:black;">Finished Appointments: </strong>message->contact_email </p>
                    <p class="mt-0 mb-0"><strong style="color:black;">Incoming Appointments: </strong> test</p>
                    <p class="mt-0 mb-0"><strong style="color:black;">Absent Patients: </strong>test</p>
                    <span><img src="/images/apponew.png " style="width:70px; height:70px; float:right;" /></span>
                </div>
                <div class="message-box" style="margin-bottom:20px; padding-left:50px;">
                    <h5>Patients Prefered Appointment Method </h5>
                    </br>
                    <p class="mt-0 mb-0"><strong style="color:black;">Physical Appoitnments: </strong>message </p>
                    <p class="mt-0 mb-0"><strong style="color:black;">Virtual Appoitnments: </strong>message </p>
                    <p class="mt-0 mb-0"><strong style="color:black;">Physical to Vrtual Ratio: </strong>message </p>
                    <span><img src="/images/physical.png " style="width:70px; height:70px; float:right;" /></span>
                </div>
                <div class="message-box" style="margin-bottom:20px; padding-left:50px;">
                    <h5>Overloaded Session</h5>
                    </br>
                    <p class="mt-0 mb-0"><strong style="color:black;">Session: </strong>message </p>
                    <p class="mt-0 mb-0"><strong style="color:black;">Total Appointments: </strong>message</p>
                    <p class="mt-0 mb-0"><strong style="color:black;">Room Name: </strong>message</p>
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