@extends('layouts.stafflayout')
@section('content')
<section class="section-padding section-bg mb-0 pt-0 mt-0 pt-0">
    <div class="container pt-2">
        <h5 class="text-center">Messages</h5>
        <div class="col-md-8" style="margin:0 auto;">
            <div class="card pt-3 mb-3">
                <div class="card-body">
                    <form method="POST" action="{{route('viewmessages.search')}}">
                        @csrf
                        <div class="top-right" style="float:right; margin-right:20px;">
                            <div class="menu-icon">
                                <span class="icon" style="float:right;">&#9776;</span>
                                <div class="dropdownNew">
                                    <a href='/viewMessages/allread' id="mark-all-read">Mark All as Read</a>
                                    <a href='/viewMessages/allunread' id="mark-all-unread">Mark All as Unread</a>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-end" style="display:inline;">{{ __('Select Message Status: ') }}</label>

                            <div class="col-md-6">
                                <select id="status" type="text" class="form-control @error('status') is-invalid @enderror" style="width:60%;" name="status" required autocomplete="status" autofocus>
                                    @if($reload == 'no' || $reload == 'all')
                                    <option selected>All</option>
                                    <option>Unread</option>
                                    <option>Read</option>
                                    @elseif($reload == 'unread')
                                    <option>All</option>
                                    <option selected>Unread</option>
                                    <option>Read</option>
                                    @else
                                    <option>All</option>
                                    <option>Unread</option>
                                    <option selected>Read</option>
                                    @endif
                                </select>
                                @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Invalid Status</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="/staff" class="custom-btn pt-1 pb-1" style="margin-right:10px;">
                                    {{ __('Back') }}
                                </a>
                                <button type="submit" class="custom-btn pt-1 pb-1">
                                    {{ __('Search') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="message-container">
            @if(isset($messages))
            @foreach($messages as $message)
            <div class="message-box" style="margin-bottom:20px;">
                <h6>{{ $message->fname }} {{ $message->lname }}</h6>
                <p><strong>Email: </strong>{{ $message->contact_email }}</p>
                <p>{{ $message->message }}</p>
                <a href="mailto:{{$message->contact_email}}" class="btn custom-btn pt-2 pb-2" style="display:inline;"> Reply</a>
                @if($message->status == 'unread')
                <span><img src="/images/new.png " style="width:40px; height:40px; float:right;" /></span>
                @else
                <span><img src="/images/unreaded.jpg " style="width:25px; height:25px; float:right;" /></span>
                @endif
            </div>
            @endforeach
            @endif
            @if(isset($texts))
            @foreach($texts as $text)
            <div class="message-box" style="margin-bottom:20px;">
                <h6>{{ $text->User->name }}</h6>
                <p><strong>Email: </strong>{{ $text->User->email }}</p>
                <p>{{ $text->message }}</p>
                <a href="/staffchat/{{$text->user_id}}" class="btn custom-btn pt-2 pb-2" style="display:inline;"> Reply</a>
                @if($text->status == 'unread')
                <span><img src="/images/new.png " style="width:40px; height:40px; float:right;" /></span>
                @else
                <span><img src="/images/unreaded.jpg " style="width:25px; height:25px; float:right;" /></span>
                @endif
            </div>
            @endforeach
            @endif
        </div>
    </div>
    <section class="section-padding section-bg mb-0 pt-0 mt-0 pt-0">
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