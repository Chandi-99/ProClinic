@extends('layouts.doctorlayout')
@section('content')
<section class="section-padding section-bg mb-0 pt-0 mt-0 pt-0">
    <div class="container pt-3">
        @if($monthly == 'yes')
        <h5 class="text-center">ProClinic Earning Report for Doctor (Month - {{$thismonthName}})</h5>
        @else
        <h5 class="text-center">ProClinic Earning Report for Doctor (Overall)</h5>
        @endif
        </br>
        <div class="col-md-8" style="margin:0 auto;">
            <div class="card pt-3 mb-3">
                <div class="card-body">
                    <div class="top-right" style="float:right; margin-right:20px;">
                        <div class="menu-icon">
                            <span class="icon" style="float:right;">&#9776;</span>
                            <div class="dropdownNew">
                                <a href='/viewMyearnings' id="mark-all-read">This Month</a>
                                <a href='/viewMyearnings/overall' id="mark-all-unread">Overall</a>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 pt-3" style="padding-left: 100px; padding-right: 100px; font-size:larger;">
                        <label class="col-form-label"><strong>Doctor Name: </strong>{{$doctor->fname}}  {{$doctor->lname}}</label></br>
                        <label class="col-form-label"><strong>Specialization: </strong>{{$doctor->specialization}}</label></br>
                        <label class="col-form-label"><strong>Total Sessions: </strong>{{$sessionCount}}</label></br>
                        <label class="col-form-label"><strong>Total Revenue: </strong>Rs.{{$totalRevenue}}.00</label></br>
                        <label class="col-form-label"><strong>Total Patient Visits: </strong> {{$totalAppointments}}</lable></br>
                        <label class="col-form-label"><strong>Target Revenue: </strong> Rs.{{$targetProfit}}.00 </label></br>
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
                                <a href="/doctor" class="custom-btn pt-1 pb-1">
                                    {{ __('Back') }}
                                </a>
                            </div>
                        </div>
                    </div>
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