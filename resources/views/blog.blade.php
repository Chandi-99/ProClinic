@extends('layouts.app')
@section('content')

<main>
    <section class="news-detail-header-section text-center">
        <div class="section-overlay"></div>

            <div class="container">
                <div class="row">

                    <div class="col-lg-12 col-12">
                        <h1 class="text-white">Blog</h1>
                    </div>

                </div>
            </div>
    </section>

    <section class="news-section section-padding">
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
                                        <p> Content of the Blog <p>
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

                                    <form class="custom-form comment-form mt-4" action="#" method="post" role="form">
                                        <h6 class="mb-3">Write a comment</h6>

                                        <textarea name="comment-message" rows="4" class="form-control" id="comment-message" placeholder="Your comment here"></textarea>

                                        <div class="col-lg-3 col-md-4 col-6 ms-auto">
                                            <button type="submit" class="form-control">Comment</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-12 mx-auto mt-4 mt-lg-0">
                            <form class="custom-form search-form" action="#" method="post" role="form">
                                <input class="form-control" type="search" placeholder="Search" aria-label="Search">

                                <button type="submit" class="form-control">
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

                            <form class="custom-form subscribe-form" action="#" method="post" role="form">
                                <h5 class="mb-4">Newsletter Form</h5>

                                <input type="email" name="subscribe-email" id="subscribe-email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Email Address" required>

                                <div class="col-lg-12 col-12">
                                    <button type="submit" class="form-control">Subscribe</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </section>



</main>
@endsection