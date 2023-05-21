<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ 'ProClinic' }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

     <!-- CSS FILES -->
     <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/bootstrap-icons.css" rel="stylesheet">
    <link href="/css/proclinic_layout.css" rel="stylesheet">

    <!--Bootstrap File-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>

<body id="section_1">
<header class="site-header">

        <div class="container">
            <div class="row">

                <div class="col-lg-8 col-12 d-flex flex-wrap">
                    <p class="d-flex me-4 mb-0">
                        <i class="bi-geo-alt me-2"></i> No 20, Galle Road, Colombo 06, Sri Lanka.
                    </p>

                    <p class="d-flex mb-0">
                        <i class="bi-envelope me-2"></i>

                        <a href="mailto:info@company.com">
                                info@proclinic.com
                            </a>
                    </p>
                </div>

                <div class="col-lg-3 col-12 ms-auto d-lg-block d-none">
                    <ul class="social-icon" >
                        <li class="social-icon-item ">
                            <a href=" https://twitter.com " class="social-icon-link bi-twitter"></a>
                        </li>

                        <li class=" social-icon-item ">
                            <a href="https://facebook.com " class="social-icon-link bi-facebook "></a>
                        </li>

                        <li class=" social-icon-item ">
                            <a href="https://instagram.com " class="social-icon-link bi-instagram "></a>
                        </li>

                        <li class="social-icon-item " >
                            <a href="https://youtube.com " class="social-icon-link bi-youtube "></a>
                        </li>

                        <li class="social-icon-item ">
                            <a href="https://whatsapp.com " class="social-icon-link bi-whatsapp "></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
</header>
<nav class="navbar navbar-expand-lg bg-light shadow-lg ">
        <div class="container">
            <a class="navbar-brand " href="{{ ('/') }}">
                <img src="/images/logo.png" class="logo img-fluid ">
                <span style="font-size:30px; color:#5bc1ac;" > ProClinic
                        <small style="font-size:17px;" id="title">Medical Center</small>
                    </span>
            </a>

            <button class="navbar-toggler " type="button " data-bs-toggle="collapse " data-bs-target="#navbarNav " aria-controls="navbarNav " aria-expanded="false " aria-label="Toggle navigation ">
                    <span class="navbar-toggler-icon "></span>
                </button>

            <div class="collapse navbar-collapse " id="navbarNav ">
                <ul class="navbar-nav ms-auto ">
                    <li class="nav-item ">
                        <a class="nav-link click-scroll " href="{{ ('/') }}">Home</a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link click-scroll " href="{{ ('/') }}" >About</a>
                    </li>

                    <li class="nav-item dropdown ">
                        <a class="nav-link click-scroll dropdown-toggle " href="#section_5 " id="navbarLightDropdownMenuLink " role="button " data-bs-toggle="dropdown " aria-expanded="false ">News</a>

                        <ul class="dropdown-menu dropdown-menu-light " aria-labelledby="navbarLightDropdownMenuLink ">
                            <li><a class="dropdown-item " href="news.html ">News Listing</a></li>

                            <li><a class="dropdown-item " href="news-detail.html ">News Detail</a></li>
                        </ul>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link click-scroll " href="#footer ">Contact</a>
                    </li>

                    <li class="nav-item ms-3 ">
                        <a class="nav-link custom-btn custom-border-btn btn " href="donate.html ">Donate</a>
                    </li>

                    <!-- Authentication Links -->
                    @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link click-scroll " href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link click-scroll " href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif

                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
                
    <main class="py-4">
        @yield('content')
    </main>

    <footer class="site-footer " id="footer">
        <div class="container">
            <div class="row " style="margin:0px; padding:0px">
                <div class="col-lg-3 col-12 mb-2 ">
                    <img src="/images/logo.png " class="logo img-fluid " alt=" ">
                </div>

                <div class="col-lg-4 col-md-6 col-12 ">
                    <h5 class="site-footer-title mb-3 " id="id_1">Quick Links</h5>

                    <ul class="footer-menu ">
                        <li class="footer-menu-item "><a href="#story " class="footer-menu-link " style="text-decoration:none;">Our Story</a></li>

                        <li class="footer-menu-item "><a href="#newsroom " class="footer-menu-link " style="text-decoration:none;">Newsroom</a></li>

                        <li class="footer-menu-item "><a href="#foundation " class="footer-menu-link " style="text-decoration:none;">Foundation</a></li>

                        <li class="footer-menu-item "><a href="# " class="footer-menu-link " style="text-decoration:none;">Partner with us</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6 col-12 mx-auto">
                    <h5 class="site-footer-title mb-3 " id="id_1">Contact Infomation</h5>

                    <p class="text-white d-flex mb-2 ">
                        <i class="bi-telephone me-2 "></i>

                        <a href="tel: 120-240-9600 " class="footer-menu-link " style="text-decoration:none;">
                                011-2554540
                            </a>
                    </p>

                    <p class="text-white d-flex ">
                        <i class="bi-envelope me-2 "></i>

                        <a href="mailto:info@proclinic.com " class="footer-menu-link " style="text-decoration:none;">
                                info@proclinic.org
                            </a>
                    </p>

                    <p class="text-white d-flex mt-3 ">
                        <i class="bi-geo-alt me-2 mb-3" ></i> No 20, Galle Road, Colombo 06, Sri Lanka
                    </p>
                    <a href="https://googlemaps.com " class="custom-btn  mt-3 " style="text-decoration:none;">Get Direction</a>
                </div>
            </div>
        </div>

        <div class="site-footer-bottom ">
            <div class="container ">
                <div class="row ">

                    <div class="col-lg-6 col-md-7 col-12 ">
                        <p class="copyright-text mb-0 ">Developed by: <span style="font-weight:bold;">Chandi_99 Solutions</span> &nbsp  Follow on: <a href="https://www.linkedin.com/in/udara-chandimal-8a5b19199/ " style="font-weight:bold;" target="_blank ">Linkedin</a></p>
                    </div>
                    <div class="col-lg-6 col-md-5 col-12 d-flex justify-content-center align-items-center mx-auto ">
                        <ul class="social-icon">
                            <li class="social-icon-item">
                                <a href="https://twitter.com " class="social-icon-link bi-twitter "></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="https://facebook.com " class="social-icon-link bi-facebook "></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="https://instagram.com " class="social-icon-link bi-instagram "></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="https://linkedin.com " class="social-icon-link bi-linkedin "></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="https://youtube.com " class="social-icon-link bi-youtube "></a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </footer>

    <!-- JAVASCRIPT FILES -->
    <script src="/js/jquery.min.js "></script>
    <script src="/js/bootstrap.min.js "></script>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="/js/jquery.sticky.js "></script>
    <script src="/js/click-scroll.js "></script>
    <script src="/js/counter.js "></script>
    <script src="/js/custom.js "></script>

</body>
</html>
