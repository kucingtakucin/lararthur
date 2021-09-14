@extends('layouts.auth.app')

@section('content')
    <div class="login-card">
        <div>
            <div><a class="logo text-left" href="{{ route('frontend.home.index') }}"><img class="img-fluid for-light"
                        src="https://appt.demoo.id/tema/cuba/html/assets/images/logo/login.png" alt="looginpage"><img
                        class="img-fluid for-dark"
                        src="https://appt.demoo.id/tema/cuba/html/assets/images/logo/logo_dark.png" alt="looginpage"></a>
            </div>
            <div class="login-main">

                <form class="theme-form needs-validation" novalidate id="form-login" method="post">
                    <h4>Login</h4>
                    <p>Enter your username & password to login</p>
                    <div class="form-group">
                        <label class="col-form-label" for="name">Username</label>
                        <input class="form-control" required id="name" name="name" type="text">
                        {!! validation_feedback('username', 'wajib diisi') !!}
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="password">Password</label>
                        <input class="form-control" required type="password" id="password" name="password">
                        <div class="show-hide"><span class="show"> </span></div>
                        {!! validation_feedback('password', 'wajib diisi') !!}
                    </div>
                    <div class="form-group">
                        {!! NoCaptcha::display() !!}
                    </div>
                    <div class="form-group mb-0">
                        <div class="checkbox p-0">
                            <input id="remember" type="checkbox" name="remember">
                            <label class="text-muted" for="remember">Remember me</label>
                        </div>
                        <button class="btn btn-primary btn-block" type="submit">Sign in</button>
                    </div>
                    @if (Route::has('register'))
                        <p class="mt-4 mb-0">Don't have account?<a class="ml-2"
                                href="{{ route('register') }}">Create
                                Account</a></p>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let login;

        // Document ready
        $(() => {

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
             * Keperluan login
             */
            // ================================================== //

            login = (form) => {
                if (!grecaptcha.getResponse()) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        html: "Recaptcha wajib dicentang!",
                    })
                    return;
                }

                Swal.fire({
                    title: 'Loading...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                })

                let formData = new FormData(form);

                axios.post("{{ route('login') }}", formData)
                    .then(res => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: res.data.message,
                            showConfirmButton: false,
                            timer: 2000
                        })

                        setTimeout(() => {
                            location.replace(res.data.redirect)
                        }, 1000);
                    }).catch(err => {
                        console.error(err);
                        let errors = '';
                        Object.entries(err.response.data.errors)
                            .forEach(function([key, value]) {
                                value.map(item => {
                                    errors +=
                                        `<i><i class="fa fa-angle-right"></i> ${value}</i> <br>`
                                })
                            })

                        Swal.fire({
                            icon: 'error',
                            title: err.response.data.message,
                            html: errors,
                        })
                    }).then(() => {
                        $('#form-login').removeClass('was-validated')
                    })
            }

            $('#form-login').submit(function(event) {
                event.preventDefault()
                if (this.checkValidity()) {
                    login(this);
                }
            })
        })
    </script>
@endpush
