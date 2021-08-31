<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Icon & Shortcut icon -->
    <link rel="icon" href="https://appt.demoo.id/tema/cuba/html/assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="https://appt.demoo.id/tema/cuba/html/assets/images/favicon.png" type="image/x-icon">

    <!--  Meta description, keywords -->
    <meta name="description"
        content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">

    <!-- Google font-->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
        rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://appt.demoo.id/tema/cuba/html/assets/css/fontawesome.css">

    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="https://appt.demoo.id/tema/cuba/html/assets/css/vendors/icofont.css">

    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="https://appt.demoo.id/tema/cuba/html/assets/css/vendors/themify.css">

    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="https://appt.demoo.id/tema/cuba/html/assets/css/vendors/flag-icon.css">

    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css"
        href="https://appt.demoo.id/tema/cuba/html/assets/css/vendors/feather-icon.css">
    <!-- Plugins css Ends-->

    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="https://appt.demoo.id/tema/cuba/html/assets/css/vendors/bootstrap.css">

    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="https://appt.demoo.id/tema/cuba/html/assets/css/style.css">
    <link id="color" rel="stylesheet" href="https://appt.demoo.id/tema/cuba/html/assets/css/color-1.css" media="screen">

    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="https://appt.demoo.id/tema/cuba/html/assets/css/responsive.css">

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" type="text/css" href="https://appt.demoo.id/tema/cuba/html/assets/css/vendors/animate.css">

    <!-- DataTables -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.11.0/b-2.0.0/b-colvis-2.0.0/b-html5-2.0.0/b-print-2.0.0/fh-3.1.9/r-2.2.9/datatables.min.css" />

    <!-- Bootstrap Datepicker -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
        integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />

    <!-- Custom Stylesheets -->
    <link href="{{ asset('assets/backend/css/app.css') }}" rel="stylesheet">
    @stack('styles')
</head>

<body>
    <div class="preloader-container">
        <svg class="preloader" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 340 340">
            <circle cx="170" cy="170" r="160" stroke="#E2007C" />
            <circle cx="170" cy="170" r="135" stroke="#404041" />
            <circle cx="170" cy="170" r="110" stroke="#E2007C" />
            <circle cx="170" cy="170" r="85" stroke="#404041" />
        </svg>
    </div>

    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <div class="page-header">
            <div class="header-wrapper row m-0">
                <div class="header-logo-wrapper col-1">
                    <div class="logo-wrapper">
                        <a href="{{ route('frontend.home.index') }}">
                            <img class="img-fluid"
                                src="https://appt.demoo.id/tema/cuba/html/assets/images/logo/logo.png" alt="">
                        </a>
                    </div>
                    <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="grid" id="sidebar-toggle">
                        </i></div>
                </div>
                <div class="nav-right col-11 pull-right right-header p-0">
                    <ul class="nav-menus">
                        <li>
                            <div class="mode"><i class="fa fa-moon-o"></i></div>
                        </li>
                        <li class="maximize"><a class="text-dark" href="#!"
                                onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
                        <li class="profile-nav onhover-dropdown p-0 mr-0">
                            <div class="media profile-media"><img class="b-r-10"
                                    src="https://appt.demoo.id/tema/cuba/html/assets/images/dashboard/profile.jpg"
                                    alt="profile">
                                <div class="media-body">
                                    <span>{{ auth()->user()->name }}</span>
                                    <p class="mb-0 font-roboto">
                                        @php use App\Models\User; @endphp
                                        @if (User::find(auth()->id())->hasRole('admin'))
                                            {{ __('Admin') }}
                                        @elseif (User::find(auth()->id())->hasRole('member'))
                                            {{ __('Member') }}
                                        @endif
                                        <i class="middle fa fa-angle-down"></i>
                                    </p>
                                </div>
                            </div>
                            <ul class="profile-dropdown onhover-show-div">
                                <li><i data-feather="user"></i><span>Account </span></li>
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();
                                        ">
                                        <i data-feather="log-out"></i>
                                        <span>{{ __('Logout') }}</span>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @method('POST')
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Page Header Ends -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper horizontal-menu">
            <!-- Page Sidebar Start-->
            <div class="sidebar-wrapper">
                <div class="logo-wrapper">
                    <a href="{{ route('frontend.home.index') }}">
                        <img class="img-fluid for-light"
                            src="https://appt.demoo.id/tema/cuba/html/assets/images/logo/logo.png" alt="logo">
                        <img class="img-fluid for-dark"
                            src="https://appt.demoo.id/tema/cuba/html/assets/images/logo/logo_dark.png" alt="logo dark">
                    </a>
                </div>
                <div class="logo-icon-wrapper"><a href="{{ route('frontend.home.index') }}"><img
                            class="img-fluid"
                            src="https://appt.demoo.id/tema/cuba/html/assets/images/logo/logo-icon.png" alt=""></a>
                </div>
                <nav>
                    <div class="sidebar-main">
                        <div id="sidebar-menu">
                            <ul class="sidebar-links custom-scrollbar">
                                @include('layouts.backend.sidebar')
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <!-- Page Sidebar Ends-->
            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-lg-12">
                                @yield('breadcumb')
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="row starter-main">
                        <div class="col-sm-12">
                            @yield('content')
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->
            </div>

            @include('layouts.backend.footer')
        </div>
    </div>
    <!-- latest jquery-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Bootstrap js-->
    <script src="https://appt.demoo.id/tema/cuba/html/assets/js/bootstrap/popper.min.js"></script>
    <script src="https://appt.demoo.id/tema/cuba/html/assets/js/bootstrap/bootstrap.js"></script>

    <!-- feather icon js-->
    <script src="https://appt.demoo.id/tema/cuba/html/assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="https://appt.demoo.id/tema/cuba/html/assets/js/icons/feather-icon/feather-icon.js"></script>

    <!-- Sidebar jquery-->
    <script src="https://appt.demoo.id/tema/cuba/html/assets/js/config.js"></script>

    <!-- Clipboard -->
    <script src="https://appt.demoo.id/tema/cuba/html/assets/js/clipboard/clipboard.min.js"></script>

    <!-- Custom Card -->
    <script src="https://appt.demoo.id/tema/cuba/html/assets/js/custom-card/custom-card.js"></script>

    <!-- Tooltip init -->
    <script src="https://appt.demoo.id/tema/cuba/html/assets/js/tooltip-init.js"></script>

    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- DataTables -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.11.0/b-2.0.0/b-colvis-2.0.0/b-html5-2.0.0/b-print-2.0.0/fh-3.1.9/r-2.2.9/datatables.min.js">
    </script>

    <!-- JQuery Validate -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

    <!-- Bootstrap Datepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
        integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- SweetAlert 2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Leaflet -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>

    <!-- Form Validation Custom -->
    <script src="https://appt.demoo.id/tema/cuba/html/assets/js/form-validation-custom.js"></script>

    <!-- Bootstrap Custom File Input -->
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>

    <!-- ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- Custom Javascripts -->
    <script src="{{ asset('assets/backend/js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.preloader-container').fadeOut(500)
        })
    </script>
    @stack('scripts')
</body>

</html>
