@extends('layouts.app')
@section('content')
<section class="section-padding section-bg ">
    <div class="container">
        <div class="custom-text-box ">
            <h4 class="mb-2 " style="font-weight:bold;";>Your Message was Sent Successfully!</h4>
                <h5 class="mb-3 ">ProClinic, Medical Center</h5>
                <p class="mb-0 " style="text-align:justify;">We have received your message and we appreciate your patience as we work to respond to it.
                    We understand that you may be eager to hear back from us, but we want to assure you that we are working as quickly as possible.
                    We are currently experiencing a high volume of messages and we are working to get through them as quickly as possible.
                    We will respond to your message as soon as we can.
                </p>
                <br>
                <p>Thank you!</p>
                @auth
                    <a class="btn custom-btn pt-1 pb-1 mt-1 mb-1" href="{{route('home')}}" >Go Back</a>
                @else
                <a class="btn custom-btn pt-1 pb-1 mt-1 mb-1" href="{{route('welcome')}}" >Go Back</a>
                @endauth
        </div>
    </div>
</section>
@endsection