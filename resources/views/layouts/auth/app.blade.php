<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Meta description, keywords, author-->
    <meta name="description"
        content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">

    <!-- Icon -->
    <link rel="icon" href="https://appt.demoo.id/tema/cuba/html/assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="https://appt.demoo.id/tema/cuba/html/assets/images/favicon.png" type="image/x-icon">

    <!-- Google re-Captcha  -->
    {!! NoCaptcha::renderJs() !!}

    <!-- Google font-->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
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
    <!-- Plugins css start-->
    <!-- Plugins css Ends-->

    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="https://appt.demoo.id/tema/cuba/html/assets/css/vendors/bootstrap.css">

    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="https://appt.demoo.id/tema/cuba/html/assets/css/style.css">
    <link id="color" rel="stylesheet" href="https://appt.demoo.id/tema/cuba/html/assets/css/color-1.css" media="screen">

    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="https://appt.demoo.id/tema/cuba/html/assets/css/responsive.css">

    <!-- Custom Stylesheets -->
    <link href="{{ asset('assets/auth/css/app.css') }}" rel="stylesheet">
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
    <!-- login page start-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-7"><img class="bg-img-cover bg-center"
                    src="https://appt.demoo.id/tema/cuba/html/assets/images/login/2.jpg" alt="looginpage">
            </div>
            <div class="col-xl-5 p-0">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- latest jquery-->
    <script src="https://appt.demoo.id/tema/cuba/html/assets/js/jquery-3.5.1.min.js"></script>

    <!-- Bootstrap js-->
    <script src="https://appt.demoo.id/tema/cuba/html/assets/js/bootstrap/popper.min.js"></script>
    <script src="https://appt.demoo.id/tema/cuba/html/assets/js/bootstrap/bootstrap.js"></script>

    <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- feather icon js-->
    <script src="https://appt.demoo.id/tema/cuba/html/assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="https://appt.demoo.id/tema/cuba/html/assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- Sidebar jquery-->
    <script src="https://appt.demoo.id/tema/cuba/html/assets/js/config.js"></script>
    <!-- Plugins JS start-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://appt.demoo.id/tema/cuba/html/assets/js/form-validation-custom.js"></script>

    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('assets/auth/js/app.js') }}"></script>
    <!-- login js-->
    <script>
        let loading;

        /**
         * Keperluan disable inspect element
         */
        // ================================================== //

        // Disable right click
        $(document).contextmenu(function(event) {
            event.preventDefault()
        })

        $(document).keydown(function(event) {
            // Disable F12
            if (event.keyCode == 123) return false;

            // Disable Ctrl + Shift + I
            if (event.ctrlKey && event.shiftKey && event.keyCode == 'I'.charCodeAt(0)) {
                return false;
            }

            // Disable Ctrl + Shift + J
            if (event.ctrlKey && event.shiftKey && event.keyCode == 'J'.charCodeAt(0)) {
                return false;
            }

            // Disable Ctrl + U
            if (event.ctrlKey && event.keyCode == 'U'.charCodeAt(0)) {
                return false;
            }
        })

        /**
         * Keperluan show loading
         */
        // ================================================== //
        loading = () => {
            Swal.fire({
                title: 'Loading...',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            })
        }

        $(document).ready(function() {
            $('.preloader-container').fadeOut(500)

            let width = $('.g-recaptcha').parent().width();
            if (width < 302) {
                let scale = width / 302;
                $('.g-recaptcha').css('transform', 'scale(' + scale + ')');
                $('.g-recaptcha').css('-webkit-transform', 'scale(' + scale + ')');
                $('.g-recaptcha').css('transform-origin', '0 0');
                $('.g-recaptcha').css('-webkit-transform-origin', '0 0');
            }
        })
    </script>

    @stack('scripts')
</body>

</html>
