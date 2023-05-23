@extends('layouts.app')
@section('content')

<main>
<section class="col-lg-12 col-12 p-0  " >
<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner pt-0">
            <div class="carousel-item active">
                <img src="/images/wallpaper1.jpeg" class="d-block w-100 bg-secondary" style="height:auto;" alt="photo 1">
            </div>
            <div class="carousel-item">
                <img src="/images/wallpaper2.jpeg" class="d-block w-100 bg-secondary" style="height:auto;" alt="photo 2">
            </div>
            <div class="carousel-item">
                <img src="/images/wallpaper3.jpeg" class="d-block w-100 bg-secondary" style="height:auto;" alt="photo 3">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
</div>
</section>
<section class="section-padding ">
            <div class="container ">
                <div class="row ">
                    <div class="col-lg-10 col-12 text-center mx-auto pt-0 mt-0">
                        <h2 class="mb-5 ">Welcome to ProClinic Medical Center</h2>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 ">
                        <div class="featured-block d-flex justify-content-center align-items-center ">
                            <a href="donate.html " class="d-block "  style="text-decoration:none;">
                                <img src="/images/doctor.jpg " class="featured-block-image img-fluid mt-2" alt=" " height="130px" width="130px">

                                <p class="featured-block-text " style="text-decoration:none;">Make an <strong>Appointment</strong></p>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 mb-md-4 ">
                        <div class="featured-block d-flex justify-content-center align-items-center ">
                            <a href="donate.html " class="d-block " style="text-decoration:none;">
                                <img src="images/certificate.png " class="featured-block-image img-fluid " alt=" " height="130px" width="130px">

                                <p class="featured-block-text " >Request <strong>Medical Certificate</strong></p>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 ">
                        <div class="featured-block d-flex justify-content-center align-items-center ">
                            <a href="donate.html " class="d-block " style="text-decoration:none;">
                                <img src="images/report.avif " class="featured-block-image img-fluid " alt=" " height="130px" width="130px">

                                <p class="featured-block-text " >Manage<strong> Medical Reports</strong></p>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 mb-md-4 ">
                        <div class="featured-block d-flex justify-content-center align-items-center ">
                            <a href="donate.html " class="d-block " style="text-decoration:none;">
                                <img src="images/icons/receive.png " class="featured-block-image img-fluid " alt=" ">

                                <p class="featured-block-text " style="text-decoration:none;">Make a<strong> Donation</strong> </p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-padding section-bg " id="story">
            <div class="container ">
                <div class="row ">

                    <div class="col-lg-6 col-12 mb-5 mb-lg-0 ">
                        <img src="/images/doctornew.jpg" class="custom-text-box-image img-fluid " alt=" ">
                    </div>

                    <div class="col-lg-6 col-12 " id="section_2">
                        <div class="custom-text-box ">
                            <h2 class="mb-2 " style="font-weight:bold;";>Our Story</h2>

                            <h4 class="mb-3 ">ProClinic, Medical Center</h4>

                            <p class="mb-0 " style="text-align:justify;">At ProClinic Medical Center, we proudly offer a lots of services to our patients. Our team of more than 40 providers delivers high quality healthcare in a community-oriented manner
                                 in more than two dozen services and specialties, including primary care and more.
                                 From our family healthcare clinics to natural health, Senior Care and a variety of inpatient and outpatient specialty services, complete care for the entire family is closer than you think.
                                 We thank you for your interest in the programs and services of Story Medical. We would be honored to serve you and your loved ones.</p>
                        </div>

                        <div class="row ">
                            <div class="col-lg-6 col-md-6 col-12 ">
                                <div class="custom-text-box mb-lg-0 ">
                                    <h5 class="mb-3 " style="font-weight:bold;">Our Vision</h5>
                                    <p style="text-align:justify;">Our vision is to be the leading provider of high-quality, affordable, and accessible healthcare in the community.</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 ">
                                <div class="custom-text-box mb-lg-0 ">
                                    <h5 class="mb-3 " style="font-weight:bold;">Our Mission</h5>
                                    <p style="text-align:justify;">We deliver healthcare excellence by listening to, partnering with and caring for the communities of Sri Lanka - one person, one experience, one story at a time.</p>
                                    <ul class="custom-list mt-2 ">
                                        <li class="custom-list-item d-flex " style="color:black;">
                                            <i class="bi-check custom-text-box-icon me-2 "></i> Service
                                        </li>

                                        <li class="custom-list-item d-flex " style="color:black;">
                                            <i class="bi-check custom-text-box-icon me-2 "></i> Team Work
                                        </li>

                                        <li class="custom-list-item d-flex " style="color:black;">
                                            <i class="bi-check custom-text-box-icon me-2 " ></i> Satisfaction
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="about-section section-padding " id="doctor">
            <div class="container ">
                <div class="row ">
                    <div class="col-lg-6 col-md-5 col-12 " style="margin-right:30px;">
                        <img src="/images/doctor new.jfif " class="about-image ms-lg-auto bg-light shadow-lg img-fluid " alt=" ">
                    </div>
                    <div class="col-lg-5 col-md-7 col-12 ">
                            <h2 class="mb-0 " style="font-weight:bold;">Dr. Yasitha Bandaragodage</h2>

                            <p class="text-muted mb-lg-4 mb-md-4 " style="color:black;">Physician</p>

                            <p style="text-align:justify;">Hi, I'm Dr. Yasitha Bandaragodage, and I'm the owner of ProClinic Medical Center. I'm a board-certified Physician who has been practicing medicine for over 10 years. I'm passionate about providing my patients with the highest quality of care, and I'm committed to helping them achieve their best health.
                                ProClinic is a state-of-the-art facility that offers a wide range of medical services.We have a team of highly skilled and experienced doctors and nurses.
                                We understand that going to the doctor can be a stressful experience, so we do everything we can to make it as comfortable as possible for our patients. 
                                If you're looking for a physician doctor, then I encourage you to schedule an appointment with me at my medical center. I look forward to meeting you!</p>
                        
                            <ul class="social-icon mt-4 ">
                                <li class="social-icon-item ">
                                    <a href="https://linkedin.com " class="social-icon-link bi-twitter "></a>
                                </li>

                                <li class="social-icon-item ">
                                    <a href="https://facebook.com  " class="social-icon-link bi-facebook "></a>
                                </li>

                                <li class="social-icon-item ">
                                    <a href="https://instagram.com  " class="social-icon-link bi-instagram "></a>
                                </li>
                            </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="cta-section section-padding section-bg " id="search_med">
            <div class="container ">
                 @if (session('alert_1'))
                    <div class="alert alert-success">
                        {{ session('alert_1') }}
                                </div>
                @endif
                <div class="row justify-content-center align-items-center ">
                    <div class="col-lg-5 col-12 ms-auto ">
                        <h2 class="mb-0 ">All your Medicines from One Place! <br> We got thousands of Medicines </br>that you need.</h2>
                    </div>
                    <div class="col-lg-5 col-12 ">
                        <form method="POST" action="{{route('welcome')}}" role="form ">
                            <input type="text" placeholder="Medicine Name " name="medicine_name"  class="form-control form-control-lg"/>
                            </br>
                            <button type="submit" class="custom-btn" name="form1">Search</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </section>
        <section class="section-padding " id="foundation">
            <div class="container ">
                <div class="row ">
                    <div class="col-lg-12 col-12 text-center mb-4 ">
                        <h2 style="font-weight:bold; font-size:40px;">Health Fondation</h2>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0 ">
                        <div class="custom-block-wrap ">
                            <img src="images/causes/group-african-kids-paying-attention-class.jpg " class="custom-block-image img-fluid " alt=" ">

                            <div class="custom-block ">
                                <div class="custom-block-body ">
                                    <h5 class="mb-3 ">Children Education</h5>
                                    <p>This money raising programs help to ensure that all children have access to a quality education, regardless of their financial situation.</p>
                                    <div class="progress mt-4 ">
                                        <div class="progress-bar w-75 " role="progressbar " aria-valuenow="75 " aria-valuemin="0 " aria-valuemax="100 "></div>
                                    </div>
                                    <div class="d-flex align-items-center my-2 ">
                                        <p class="mb-0 ">
                                            <strong>Raised:</strong> $18,500
                                        </p>
                                        <p class="ms-auto mb-0 ">
                                            <strong>Goal:</strong> $32,000
                                        </p>
                                    </div>
                                </div>
                                <a href="{{route('donation')}}" class="custom-btn btn ">Donate now</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0 ">
                        <div class="custom-block-wrap ">
                            <img src="images/causes/poor-child-landfill-looks-forward-with-hope.jpg " class="custom-block-image img-fluid " alt=" ">

                            <div class="custom-block ">
                                <div class="custom-block-body ">
                                    <h5 class="mb-3 ">Poverty Development</h5>

                                    <p>Trying to provide financial assistance to those in need, so they can improve their lives and break the cycle of poverty.</p>

                                    <div class="progress mt-4 ">
                                        <div class="progress-bar w-50 " role="progressbar " aria-valuenow="50 " aria-valuemin="0 " aria-valuemax="100 "></div>
                                    </div>

                                    <div class="d-flex align-items-center my-2 ">
                                        <p class="mb-0 ">
                                            <strong>Raised:</strong> $27,600
                                        </p>

                                        <p class="ms-auto mb-0 ">
                                            <strong>Goal:</strong> $60,000
                                        </p>
                                    </div>
                                </div>

                                <a href="{{route('donation')}}" class="custom-btn btn form-control-lg">Donate now</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12 ">
                        <div class="custom-block-wrap ">
                            <img src="images/causes/african-woman-pouring-water-recipient-outdoors.jpg " class="custom-block-image img-fluid " alt=" ">

                            <div class="custom-block ">
                                <div class="custom-block-body ">
                                    <h5 class="mb-3 ">Supply drinking water</h5>

                                    <p>This programs help to provide clean water to those who do not have access to it, so they can live healthy and productive lives.</p>

                                    <div class="progress mt-4 ">
                                        <div class="progress-bar w-100 " role="progressbar " aria-valuenow="100 " aria-valuemin="0 " aria-valuemax="100 "></div>
                                    </div>

                                    <div class="d-flex align-items-center my-2 ">
                                        <p class="mb-0 ">
                                            <strong>Raised:</strong> $84,600
                                        </p>

                                        <p class="ms-auto mb-0 ">
                                            <strong>Goal:</strong> $100,000
                                        </p>
                                    </div>
                                </div>

                                <a href="{{route('donation')}}" class="custom-btn btn ">Donate now</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <section class="volunteer-section section-padding " id="section_4 ">
            <div class="container ">
                <div class="row ">

                    <div class="col-lg-6 col-12 ">
                        <h2 class="text-white mb-4 " style="font-size:50px; font-weight:bold;">Job Vacancies</h2>

                        <form class="custom-form volunteer-form mb-5 mb-lg-0 " method="POST" action="{{route('welcome')}}" enctype="multipart/form-data">
                            <h3 class="mb-4 " style="font-size:30px;">Apply to Work with Our Team!</h3>

                            <div class="row ">
                            @if (session('alert'))
                                <div class="alert alert-success">
                                    {{ session('alert') }}
                                </div>
                            @endif
                                <div class="col-lg-6 col-12 ">
                                    <input type="text" name="cv_name" class="form-control form-control-lg " placeholder="Your Name" style="font-size:15px;" required>
                                </div>

                                <div class="col-lg-6 col-12 ">
                                    <input type="email" name="cv_email" class="form-control form-control-lg " style="font-size:15px;" placeholder="Email Address " required>
                                </div>

                                <div class="col-lg-6 col-12 ">
                                    <input type="text" name="cv_position"  class="form-control form-control-lg  " style="font-size:15px;" placeholder="Position" required>
                                </div>

                                <div class="col-lg-6 col-12 " style="font-size:15px;">
                                    <div >
                                        <input type="file" id ="file" name="cvfile" placeholder="Upload CV" style="font-size:15px;"  class="form-control form-control-lg" accept="application/pdf" style="border-style:none;">
                                    </div>
                                </div>
                            </div>

                            <textarea name="cv_aboutme" style="font-size:15px;" rows="3" class="form-control form-control-lg" placeholder="Tell us Little bit About you " required></textarea>

                            <button type="submit" class="custom-btn" name="form2">Submit</button>
                        </form>
                    </div>

                    <div class="col-lg-6 col-12 " >
                        <img src="images/nurse.avif " class="volunteer-image" alt=" " style="margin:0 auto;">

                        <div class="custom-block-body text-center ">
                            <h4 class="text-white mt-lg-3 mb-lg-3 " style="font-size:30px;">About Vacancies</h4>

                            <p class="text-white text-justify">Our medical center is looking for new doctors and nurses to join our team. We are a busy, growing practice that provides comprehensive primary care services to patients of all ages.
                                 We are looking for qualified candidates who are passionate about providing excellent patient care. If you are interested in joining our team, please submit your CV to us.</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="testimonial-section section-padding section-bg ">
            <div class="container ">
                <div class="row ">

                    <div class="col-lg-8 col-12 mx-auto ">
                        <h2 class="mb-lg-3"><span style="color:black; font-weight:bold;font-size:40px;">ProClinic Medical Center</span><br>Genius in Healthcare</h2>    
                    </div>

                </div>
            </div>
        </section>

        <section class="contact-section section-padding " id="section_6 ">
            <div class="container ">
                <div class="row ">

                    <div class="col-lg-4 col-12 ms-auto mb-5 mb-lg-0 ">
                        <div class="contact-info-wrap ">
                            <h2 style="font-size:50px; font-weight:bold;">Get in touch</h2>

                            <div class="contact-image-wrap d-flex flex-wrap ">
                                <img src="images/hr.jpg " class="img-fluid avatar-image " alt=" ">

                                <div class="d-flex flex-column justify-content-center ms-3 ">
                                    <p class="mb-0 ">Hajar Alafifi</p>
                                    <p class="mb-0 "><strong>HR & Office Manager</strong></p>
                                </div>
                            </div>

                            <div class="contact-info ">
                                <h5 class="mb-3 ">Contact Infomation</h5>

                                <p class="d-flex mb-2 ">
                                    <i class="bi-geo-alt me-2 "></i>No 20, Galle Road, Colombo 06, Sri Lanka.
                                </p>

                                <p class="d-flex mb-2 ">
                                    <i class="bi-telephone me-2 "></i>

                                    <a href="tel: 120-240-9600 " style="text-decoration:none;">
                                            011-2554540
                                        </a>
                                </p>

                                <p class="d-flex ">
                                    <i class="bi-envelope me-2 "></i>

                                    <a style="text-decoration:none;" href="mailto:hajaralafifi@proclinic.com" style="text-decoration:none;">
                                        hajaralafifi@proclinic.com
                                        </a>
                                </p>

                                </br>
                                <a href="# " class="custom-btn mt-5" style="text-decoration:none;">Get Direction</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 col-12 mx-auto ">
                        <form class="custom-form contact-form "  method="POST" action="{{route('welcome')}}" role="form ">
                            <h2 style="font-size:50px; font-weight:bold;">Contact form</h2>

                            <p class="mb-4 ">Or, you can just send an email:
                                <a href="mailto:info@proclinic.com " style="text-decoration:none; color:black;">info@proclinic.com</a>
                            </p>
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-12 ">
                                    <input type="text" name="fname" id="first-name " style="font-size:15px;" class="form-control form-control-lg" placeholder="Amal " required>
                                </div>

                                <div class="col-lg-6 col-md-6 col-12 ">
                                    <input type="text" name="lname" id="last-name " style="font-size:15px;" class="form-control form-control-lg " placeholder="Perera " required>
                                </div>
                            </div>

                            <input type="email" name="contact_email" id="email " style="font-size:15px;" class="form-control form-control-lg" placeholder="amalperera@gmail.com " required>

                            <textarea name="message" rows="5 " style="font-size:15px;" class="form-control form-control-lg" id="message " placeholder="What can we help you? "></textarea>

                            <button type="submit" class="form-control-lg custom-btn mt-3" name="form3">Send Message</button>
                        </form>
                    </div>

                </div>
            </div>
        </section>


    </main>


@endsection

