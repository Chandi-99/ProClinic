@extends('layouts.doctorlayout')
@section('content')
    <section class="news-detail-header-section text-center mt-0">
        <div class="section-overlay"></div>

            <div class="container">
                <div class="row">

                    <div class="col-lg-12 col-12">
                        <h1 class="text-white">Blog</h1>
                    </div>

                </div>
            </div>
    </section>

    <form method="POST" action="{{route('doctorBlog.update')}}" enctype="multipart/form-data">
    @csrf
    <div class="text-center mt-2 mb-1" style="width:50%;margin:0 auto;">
            <button type="submit" name="form1" class="form-control custom-btn" >Add New Blog Post</button>
    </div>
    </form>
        

    <section class="news-section section-padding mt-0 pt-2">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 col-12">
                            <div class="news-block" >
                                @foreach ($latest as $latest)
                                <div class="news-block-top" style="width:500px; height:350px;margin:0 auto">
                                   <img src="{{ url('public/Image/'.$latest->image) }}" width="100%" z-index='0'/>
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
                                            {{$latest->created_at}}
                                        </p>
                                    </div>

                                    <div class="news-block-author mx-5">
                                        <p>
                                            <i class="bi-person custom-icon me-1"></i>
                                            {{$latest->user->name}}
                                        </p>
                                    </div>

                                    <div class="news-block-comment">
                                        <p>
                                            <i class="bi-chat-left custom-icon me-1"></i>
                                            {{$latest->comments->count()}} Comments
                                        </p>
                                    </div>
                                </div>

                                <div class="news-block-title mb-2">
                                    <h4>{{$latest->title}}</h4>
                                </div>

                                    <div class="news-block-body">
                                        <p style="text-align:justify;">{{$latest->body}}
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

                                    @foreach($latest->comments as $comment)
                                    <div class="author-comment d-flex mt-3 mb-4">               
                                        <p  class="mb-0 pb-0 mt-0" style="font-weight:bold;">{{$comment->user->name}} : &nbsp;</p>
                                        <p class="mb-0 pb-0 mt-0">{{$comment->comment}}</p>    
                                    </div>
                                    @endforeach
                                    @endforeach

                                    @if (session('alert_2'))
                                    <div class="alert alert-success">
                                        {{ session('alert_2') }}
                                    </div>
                                    @endif

                                    <form class="custom-form comment-form mt-4"  action ="{{route('doctorBlog.update')}}" method="post" role="form">
                                        @csrf
                                        <h6 class="mb-3">Write a comment</h6>

                                        <textarea name="comment" rows="4" class="form-control" id="comment-message" placeholder="Your comment here"></textarea>

                                        <div class="col-lg-3 col-md-4 col-6 ms-auto">
                                            <button type="submit" name="form2" class="form-control">Comment</button>
                                        </div>
                                    </form>
                                </div>
                                
                            </div>
                        </div>

                        <div class="col-lg-4 col-12 mx-auto mt-4 mt-lg-0">
                            <form class="custom-form search-form" action="{{route('doctorBlog.update')}}" method="post" role="form">
                                @csrf
                                <input class="form-control" type="search" placeholder="Search" aria-label="Search">

                                <button type="submit" name="form3" class="form-control">
                                    <i class="bi-search"></i>
                                </button>
                            </form>

                            <h5 class="mt-5 mb-3">Recent Blogs</h5>

                            @foreach($posts as $post)
                            <div class="news-block news-block-two-col d-flex mt-4">
                                <div class="news-block-two-col-image-wrap">
                                    <a href="news-detail.html">
                                        <img src="{{ url('public/Image/'.$post->image) }}" width="100%" z-index='0'/>
                                    </a>
                                </div>

                                <div class="news-block-two-col-info">
                                    <div class="news-block-title mb-2">
                                        <h6><a href="./blog/{{ $post->id }}" class="news-block-title-link" id="selected_post">{{$post->title}}</a></h6>
                                    </div>

                                    <div class="news-block-date">
                                        <p>
                                            <i class="bi-calendar4 custom-icon me-1"></i>
                                            {{$post->created_at}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            <form class="custom-form subscribe-form" action="{{route('doctorBlog.update')}}" method="post" role="form">
                                @csrf
                                @if (session('alert_1'))
                                <div class="alert alert-success">
                                    {{ session('alert_1') }}
                                </div>
                                @endif
                                <h5 class="mb-4">Notified when new posts published</h5>
                                    <input type="email" name="email" id="subscribe-email"  class="form-control" placeholder="Email Address" required />
                                <div class="col-lg-12 col-12">
                                    <button type="submit" name="form4" class="form-control">Subscribe</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </section>
@endsection