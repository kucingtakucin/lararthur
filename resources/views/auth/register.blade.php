@extends('layouts.auth.app')

@section('content')
    <div class="login-card">
        <div>
            <div><a class="logo" href="{{ route('frontend.home.index') }}"><img class="img-fluid for-light"
                        src="https://appt.demoo.id/tema/cuba/html/assets/images/logo/login.png" alt="looginpage"><img
                        class="img-fluid for-dark"
                        src="https://appt.demoo.id/tema/cuba/html/assets/images/logo/logo_dark.png" alt="looginpage"></a>
            </div>
            <div class="login-main">
                <form class="theme-form needs-validation" novalidate id="form-register" method="POST">
                    @csrf @method('POST')
                    <h4>Create your account</h4>
                    <p>Enter your personal details to create account</p>
                    <div class="form-group">
                        <label for="name" class="col-form-label pt-0">Your Name</label>
                        <input class="form-control" id="name" name="name" type="text" required placeholder="Masukkan nama">
                        {!! validation_feedback('nama', 'wajib diisi') !!}

                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="email">Email Address</label>
                        <input class="form-control" id="email" type="email" name="email" required
                            placeholder="Test@gmail.com">
                        {!! validation_feedback('email', 'wajib diisi') !!}
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="password">{{ __('Password') }}</label>
                        <input class="form-control" id="password" type="password" name="password" minlength="8" required
                            placeholder="Password">
                        <div class="show-hide"><span class="show"></span></div>
                        {!! validation_feedback('password', 'wajib diisi & minimal 8 karakter') !!}
                    </div>
                    <div class="form-group">
                        <label for="password-confirm" class="col-form-label">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" minlength="8"
                            name="password_confirmation" required placeholder="Password Confirmation">
                        <div class="show-hide"><span class="show"></span></div>
                        {!! validation_feedback('password confirmation', 'wajib diisi & minimal 8 karakter') !!}
                    </div>
                    <div class="form-group">
                        {!! NoCaptcha::display() !!}
                    </div>
                    <div class="form-group">
                        <div class="checkbox p-0">
                            <input id="agree-privacy-policy" required type="checkbox">
                            <label class="text-muted mt-0 mb-0" for="agree-privacy-policy">Agree with<a class="ml-2"
                                    href="#">Privacy
                                    Policy</a></label>
                            {!! validation_feedback('checkbox', 'wajib dicentang') !!}
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block" type="submit">Create Account</button>
                    <p class="mt-4 mb-0">Already have an account?<a class="ml-2" href="{{ route('login') }}">Sign in</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let register;

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

            register = async (form) => {
                if (!grecaptcha.getResponse()) {
                    Swal.fire({
                        icon: 'error',
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

                axios.post("{{ route('register') }}", formData)
                    .then(res => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: res.data.message,
                            showConfirmButton: false,
                            timer: 1500
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
                        $('#form-register').removeClass('was-validated')
                    })
            }

            $('#form-register').submit(function(event) {
                event.preventDefault()
                if (this.checkValidity()) {
                    register(this);
                }
            })
        })
    </script>
@endpush
