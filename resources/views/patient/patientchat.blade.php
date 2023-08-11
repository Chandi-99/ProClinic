@extends('layouts.app')
@section('content')
<section class="section-padding section-bg mt-0 pt-4 pb-4 mb-0">
    <div class="row custom-text-box col-9" style="margin:0px auto;">
        <h5 class="text-center">Message to a Staff Member</h5>
        <div class="chat-container">
            <form action="/send">
                <div style="float:right; margin-right:20px;">
                    <div class="menu-icon">
                        <span class="icon" style="float:right;">&#9776;</span>
                        <div class="dropdownNew">
                            <a href='/chat/clearall' id="mark-all-read">Clear Chat</a>
                        </div>
                    </div>
                </div>
                <div class="chat-log pt-4" id="chatLog">

                </div>
                <div class="chat-message bot-message ">
                    <p style="padding-bottom:0px; margin-bottom:5px;" class="text-primary">User Staff</p>
                    Hello! How can I help you today?
                </div>

                @foreach($messages as $message)
                @if($message->sender_id == 'patient')
                <div class="chat-message bot-message" style="background-color:#f0f8ff; text-align:right;">
                    <p style="padding-bottom:0px; margin-bottom:0px;" class="text-danger">You</p>{{ $message->message}}
                </div>
                @else
                <div class="chat-message bot-message ">
                    <p style="padding-bottom:0px; margin-bottom:5px;" class="text-primary">User Staff</p>
                    {{$message->message}}
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
        $('#chatLog').load('/partial-view');
        location.reload();
    }, 15000); // 15,000 milliseconds = 15 seconds
</script>
@endsection