@extends('layouts.app')
@section('content')
<section class="section-padding section-bg mt-0 pt-4 pb-4 mb-0">
    <div class="row custom-text-box col-9" style="margin:0px auto;">
        <h5 class="text-center">Reply to Patient Messages</h5>
        <div class="chat-container" id="chatLog1">
            <form action="/staffchat/{{$patientID}}/send">
                <div class="chat-log pt-4" id="chatLog">
                    @foreach($messages as $message)
                    @if($message->sender_id == 'patient')
                    <div class="chat-message bot-message" style="text-align:left;">
                        <p style="padding-bottom:0px; margin-bottom:0px;" class="text-danger">{{$message->User->name}}</p>{{ $message->message}}
                    </div>
                    @else
                    <div class="chat-message bot-message" style="background-color:#f0f8ff; text-align:right;">
                        <p style="padding-bottom:0px; margin-bottom:0px;" class="text-primary">You</p>{{ $message->message}}
                    </div>
                    @endif
                    @endforeach

                    <div class="chat-input">
                        <input type="text" id="userInput" name="message" placeholder="Type your message..." style="border:1px solid black; width:70%;" class="textbox">
                        <button id="sendButton" class="sendButton btn custom-btn pt-1 pb-1">Send</button>
                    </div>
                </div>
                <div class="col-md-6 offset-md-4 item-align-center">
                    <a href="/newappointment/{{Auth::user()->id}}" class="custom-btn pt-1 pb-1" style="margin-right:10px;">
                        {{ __('Back') }}
                    </a>
                </div>
                </br>
            </form>
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

    setInterval(function() {
        // Perform additional actions here if needed

        // Reload a specific section of the page (assuming you have a div with id "reloadable-content")
        //$('#chatLog1').load('/partial-view');

        // Or reload the entire page
        location.reload();
    }, 15000); // 15,000 milliseconds = 15 seconds
</script>
@endsection