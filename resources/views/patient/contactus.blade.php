@extends('layouts.app')
@section('content')

<main>

<section class="section-padding section-bg ">
    <div class="container ">
        <div class="col-12 ">
            <div class="custom-text-box ">
                <h2 class="mb-2 " style="font-weight:bold;";>Your Message was Sent Successfully!</h2>

                    <h4 class="mb-3 ">ProClinic, Medical Center</h4>

                    <p class="mb-0 " style="text-align:justify;">We have received your message and we appreciate your patience as we work to respond to it.
                     We understand that you may be eager to hear back from us, but we want to assure you that we are working as quickly as possible.
                      We are currently experiencing a high volume of messages and we are working to get through them as quickly as possible.
                       We will respond to your message as soon as we can.</p>
                       <br>
                       <p>Thank you!</p>
                       <a class="custom-btn" href="{{route('welcome')}}" >Go Back</a>
                    </div>
            
            </div>
            

            </div>

</main>

@endsection