<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <title>{{ 'ProClinic' }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- CSS FILES -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/bootstrap-icons.css" rel="stylesheet">
    <link href="/css/proclinic_layout.css" rel="stylesheet">

    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .content-table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            min-width: 400px;
        }

        .content-table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
            font-weight: bold;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
        }

        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

        .styled-table tbody tr.active-row {
            font-weight: bold;
            color: #009879;
        }

        .message-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .message-box {
            border: 1px solid #ddd;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: calc(33.33% - 20px);
            /* Adjust as needed for responsiveness */
        }

        .top-right {
            position: absolute;
            display: inline-block;
            top: 10px;
            right: 10px;
        }

        .menu-icon {
            position: absolute;
            display: inline-block;
        }

        .icon {
            cursor: pointer;
        }


        .dropdownNew {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 5px;
            min-width: 170px;
            z-index: 1;
        }

        .dropdownNew a {
            display: block;
            padding: 5px;
            text-decoration: none;
            color: #333;
        }

        .dropdownNew a:hover {
            background-color: #ddd;
        }

        .column {
            float: left;
            /* Float the column to the left */
            width: 50%;
            /* Set the width of each column to 50% for equal distribution */
            padding: 10px;
            /* Add padding for spacing */
        }

        .imgzoom {
            transition: transform .2s;
        }

        .imgzoom:hover {
            -ms-transform: scale(1.5);
            /* IE 9 */
            -webkit-transform: scale(1.5);
            /* Safari 3-8 */
            transform: scale(1.5);
        }
    </style>


    <!-- Datatable script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.22/js/jquery.dataTables.min.js"></script>

    <!--Bootstrap File-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <!-- DataTables CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet" />
</head>
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
                <ul class="social-icon">
                    <li class="social-icon-item ">
                        <a href=" https://twitter.com " class="social-icon-link bi-twitter"></a>
                    </li>

                    <li class=" social-icon-item ">
                        <a href="https://facebook.com " class="social-icon-link bi-facebook "></a>
                    </li>

                    <li class=" social-icon-item ">
                        <a href="https://instagram.com " class="social-icon-link bi-instagram "></a>
                    </li>

                    <li class="social-icon-item ">
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

<body>
    <nav class="navbar navbar-expand-lg bg-light shadow-lg ">
        <div class="container">
            @if (Route::has('login'))
            <a class="navbar-brand " href="{{ route('doctordashboard') }}">
                <img src="/images/logo.png" class="logo img-fluid ">
                <span style="font-size:30px; color:#5bc1ac;"> ProClinic
                    <small style="font-size:17px;" id="title">Medical Center</small>
                </span>
            </a>
            @else
            <a class="navbar-brand " href="{{ route('login') }}">
                <img src="/images/logo.png" class="logo img-fluid ">
                <span style="font-size:30px; color:#5bc1ac;"> ProClinic
                    <small style="font-size:17px;" id="title">Medical Center</small>
                </span>
            </a>
            @endif
            <button class="navbar-toggler " type="button " data-bs-toggle="collapse " data-bs-target="#navbarNav " aria-controls="navbarNav " aria-expanded="false " aria-label="Toggle navigation ">
                <span class="navbar-toggler-icon "></span>
            </button>

            <div class="collapse navbar-collapse " id="navbarNav ">
                <ul class="navbar-nav ms-auto ">
                    <li class="nav-item ">
                        <a class="nav-link click-scroll " href="/show/doctor/appointments">Appointments</a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link click-scroll " href="/doctor/visitings">Visitings</a>
                    </li>

                    <li class="nav-item dropdown ">
                        <a class="nav-link click-scroll " href="/viewMyearnings">Payments</a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link click-scroll " href="{{ route('doctorBlog') }}">Blog</a>
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
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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
    <main class="mt-2 pt-3" style="margin-left:10px; margin-right:10px;">
        @yield('content')
    </main>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="./js/jquery-3.5.1.js"></script>
    <script src="./js/jquery.dataTables.min.js"></script>
    <script src="./js/dataTables.bootstrap5.min.js"></script>
    <script src="./js/script.js"></script>

    <footer class="site-footer mt-0 pt-3" id="footer">
        <div class="container pb-0">
            <div class="row " style="margin:0px; padding:0px">
                <div class="col-lg-3 col-12 ">
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
                        <i class="bi-geo-alt me-2 mb-3"></i> No 20, Galle Road, Colombo 06, Sri Lanka
                    </p>
                    <a href="https://googlemaps.com " class="custom-btn  mt-3 " style="text-decoration:none;">Get Direction</a>
                </div>
            </div>
        </div>

        <div class="site-footer-bottom mt-4 pt-3  pb-1">
            <div class="container ">
                <div class="row ">

                    <div class="col-lg-6 col-md-7 col-12 ">
                        <p class="copyright-text mb-0 ">Developed by: <span style="font-weight:bold;">Chandi_99 Solutions</span> &nbsp Follow on: <a href="https://www.linkedin.com/in/udara-chandimal-8a5b19199/ " style="font-weight:bold;" target="_blank ">Linkedin</a></p>
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
</body>
</html>