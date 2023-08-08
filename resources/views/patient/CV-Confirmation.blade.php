@extends('layouts.app')
@section('content')
<section class="section-padding section-bg pt-3 pb-1">
    <div class="container ">
        <div class="custom-text-box ">
            <h4 class="mb-2 " style="font-weight:bold;" ;>We recieved your application!</h4>
            <h5 class="mb-3 ">ProClinic, Medical Center</h5>
            <p class="mb-0 " style="text-align:justify;">Thank you for submitting your application to our company. We have received it and will be reviewing it carefully.
                We will be in touch with you soon to schedule an interview. In the meantime, please feel free to contact us if you have any questions.</p>
            </br>
            @auth
            <a class="btn custom-btn pt-1 pb-1 mt-1 mb-1" href="{{route('home')}}">Go Back</a>
            @else
            <a class="btn custom-btn pt-1 pb-1 mt-1 mb-1" href="{{route('welcome')}}">Go Back</a>
            @endauth
        </div>
    </div>
    </div>
    @endsection