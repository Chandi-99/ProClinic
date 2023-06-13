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

    <form method="POST" action="{{route('blog.update')}}" enctype="multipart/form-data">
    @csrf
    <div class="text-center mt-2 mb-1" style="width:50%;margin:0 auto;">
            <button type="submit" name="form1" class="form-control custom-btn" >Add New Blog Post</button>
    </div>
    </form>
        

    <section class="news-section section-padding mt-0 pt-2">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 col-12">
                            <div class="news-block">
                                <div class="news-block-top">
                                    <img src="images/news/medium-shot-volunteers-with-clothing-donations.jpg" class="news-image img-fluid" alt="">

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
                                            October 12, 2036
                                        </p>
                                    </div>

                                    <div class="news-block-author mx-5">
                                        <p>
                                            <i class="bi-person custom-icon me-1"></i>
                                            By Admin
                                        </p>
                                    </div>

                                    <div class="news-block-comment">
                                        <p>
                                            <i class="bi-chat-left custom-icon me-1"></i>
                                            48 Comments
                                        </p>
                                    </div>
                                </div>

                                <div class="news-block-title mb-2">
                                    <h4>Clothing donation to urban area</h4>
                                </div>

                                    <div class="news-block-body">
                                        <p style="text-align:justify;">Our medical center recently held a clothing drive for local residents in need. The drive was a huge success, and we were able to collect over 1,000 items of clothing.
                                             All of the donated clothing was distributed to local shelters and organizations that help people in need.
                                            We are so grateful to everyone who donated to our clothing drive. Your generosity will help make a real difference in the lives of people in our community.
                                            We would also like to thank our volunteers who helped to collect and sort the donated clothing. Your hard work made this event possible.
                                            If you are interested in donating clothing in the future, please contact our medical center. We are always looking for ways to help those in need.
                                            </br>
                                            <strong>Call to action:</strong></br>
                                            If you have any gently used clothing that you no longer need, please consider donating it to our medical center. Your donation will help make a real difference in the lives of people in our community.
                                            To donate clothing, please drop it off at our medical center's main entrance. We are open Monday through Friday from 8:00 AM to 5:00 PM.
                                            Thank you for your generosity!
                                            </br>
                                            <strong>Benefits of donating clothing:</strong>
                                            </br>
                                            There are many benefits to donating clothing. When you donate clothing, you are helping to:
                                            Provide clothing to people in need
                                            Reduce waste
                                            Save energy
                                            Protect the environment
                                            Clothing donation is a great way to give back to your community and make a difference in the world. If you have any gently used clothing that you no longer need, please consider donating it to a local charity or organization.<p>
                                    </div>    


                                    <div class="row mt-5 mb-4">
                                        <div class="col-lg-6 col-12 mb-4 mb-lg-0">
                                            <img src="images/news/africa-humanitarian-aid-doctor.jpg" class="news-detail-image img-fluid" alt="">
                                        </div>

                                        <div class="col-lg-6 col-12">
                                            <img src="images/news/close-up-happy-people-working-together.jpg" class="news-detail-image img-fluid" alt="">
                                        </div>
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

                                    <div class="author-comment d-flex mt-3 mb-4">
                                        <img src="images/avatar/studio-portrait-emotional-happy-funny.jpg" class="img-fluid avatar-image" alt="">

                                        <div class="author-comment-info ms-3">
                                            <h6 class="mb-1">Jack</h6>
                                            <p class="mb-0">Very Nice.</p>
                                        </div>
                                    </div>

                                    <form class="custom-form comment-form mt-4" action="{{route('doctorBlog.update')}}" method="post" role="form">
                                        @csrf
                                        <h6 class="mb-3">Write a comment</h6>

                                        <textarea name="comment-message" rows="4" class="form-control" id="comment-message" placeholder="Your comment here"></textarea>

                                        <div class="col-lg-3 col-md-4 col-6 ms-auto">
                                            <button type="submit" name="form2" class="form-control">Comment</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-12 mx-auto mt-4 mt-lg-0">
                            @csrf
                            <form class="custom-form search-form" action="{{route('doctorBlog.update')}}" method="post" role="form">
                                <input class="form-control" type="search" placeholder="Search" aria-label="Search">

                                <button type="submit" name="form3" class="form-control">
                                    <i class="bi-search"></i>
                                </button>
                            </form>

                            <h5 class="mt-5 mb-3">Recent news</h5>

                            <div class="news-block news-block-two-col d-flex mt-4">
                                <div class="news-block-two-col-image-wrap">
                                    <a href="news-detail.html">
                                        <img src="images/news/africa-humanitarian-aid-doctor.jpg" class="news-image img-fluid" alt="">
                                    </a>
                                </div>

                                <div class="news-block-two-col-info">
                                    <div class="news-block-title mb-2">
                                        <h6><a href="news-detail.html" class="news-block-title-link">Food donation area</a></h6>
                                    </div>

                                    <div class="news-block-date">
                                        <p>
                                            <i class="bi-calendar4 custom-icon me-1"></i>
                                            October 16, 2036
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="news-block news-block-two-col d-flex mt-4">
                                <div class="news-block-two-col-image-wrap">
                                    <a href="news-detail.html">
                                        <img src="images/news/close-up-happy-people-working-together.jpg" class="news-image img-fluid" alt="">
                                    </a>
                                </div>

                                <div class="news-block-two-col-info">
                                    <div class="news-block-title mb-2">
                                        <h6><a href="news-detail.html" class="news-block-title-link">Volunteering Clean</a></h6>
                                    </div>

                                    <div class="news-block-date">
                                        <p>
                                            <i class="bi-calendar4 custom-icon me-1"></i>
                                            October 20, 2036
                                        </p>
                                    </div>
                                </div>
                            </div>

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