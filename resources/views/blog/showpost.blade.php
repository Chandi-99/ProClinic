
@extends('layouts.app')
@section('content')
<section class="news-section section-padding mt-0 pt-2">
    <div class="container">
        <div class="col-lg-7 col-12">
            <div class="news-block">
            
                <div class="news-block-top" style="width:500px; height:350px;">
                    <img src="{{ url('public/BlogImages/'.$latest[0]->image) }}" width="100%" z-index ='0'/>
                    <div class="news-category-block">
                        <p href="#" class="category-block-link">
                            Lifestyle
                        </p>
                    </div>
                </div>
                        
                <div class="news-block-info">
                    <div class="d-flex mt-2">
                        <div class="news-block-date">
                            <p>
                                <i class="bi-calendar4 custom-icon me-1"></i>
                                {{$latest[0]->created_at}}
                                </p>
                        </div>

                        <div class="news-block-author mx-5">
                            <p>
                                <i class="bi-person custom-icon me-1"></i>
                                    By {{$latest[0]->user->name}}
                            </p>
                        </div>

                        <div class="news-block-comment">
                            <p>
                                <i class="bi-chat-left custom-icon me-1"></i>
                                {{$latest[0]->comments->count()}} Comments
                            </p>
                        </div>
                    </div>

                    <div class="news-block-title mb-2">
                        <h4>{{ ucfirst($latest[0]->title) }}</h4>
                    </div>

                    <div class="news-block-body">
                        <p style="text-align:justify;">{{ ucfirst($latest[0]->body) }}</p>
                    </div>    

                    <div class="social-share border-top mt-5 py-4 d-flex flex-wrap align-items-center">
                        <div class="tags-block me-auto">
                            <a href="#" class="tags-block-link">
                                Donation
                            </a>

                            <a href="#" class="tags-block-link">
                                Clothing
                            </a>

                            <a href="#" class="tags-block-link">
                                Food
                            </a>
                        </div>

                        <div class="d-flex">
                            <a href="#" class="social-icon-link bi-facebook"></a>

                            <a href="#" class="social-icon-link bi-twitter"></a>

                            <a href="#" class="social-icon-link bi-printer"></a>

                            <a href="#" class="social-icon-link bi-envelope"></a>
                        </div>
                    </div>

                    @foreach($latest[0]->comments as $comment)
                    <div class="author-comment d-flex mt-3 mb-4">               
                        <p  class="mb-0 pb-0 mt-0" style="font-weight:bold;">{{$comment->user->name}} : &nbsp;</p>
                        <p class="mb-0 pb-0 mt-0">{{$comment->comment}}</p>    
                    </div>
                    @endforeach

                    @if (session('alert_2'))
                    <div class="alert alert-danger">
                        {{ session('alert_2') }}
                    </div>
                    @endif

                    <form class="custom-form comment-form mt-4"  action ="./{{ $latest[0]->id }}" method="post" role="form">
                    @csrf
                        <h6 class="mb-3">Write a comment</h6>

                        <textarea name="comment" rows="4" class="form-control" id="comment-message" placeholder="Your comment here"></textarea>
                        <a href="/blog" class="btn btn-outline-primary btn-sm">Go back</a>

                        <div class="col-lg-3 col-md-4 col-6 ms-auto">                       
                            <button type="submit" class="form-control">Comment</button>
                        </div>
                        
                    </form>
                </div>                          
            </div>
        </div>
        
    </div>
    
</section>
@endsection