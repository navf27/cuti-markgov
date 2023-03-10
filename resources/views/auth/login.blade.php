<!DOCTYPE html>
<html lang="en">

    <!-- Mirrored from laravel.pixelstrap.com/viho/login by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 08 Jul 2022 01:42:51 GMT -->
    <!-- Added by HTTrack -->
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description"
            content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities." />
        <meta name="keywords"
            content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app" />
        <meta name="author" content="pixelstrap" />
        <link rel="icon" href="assets/images/favicon.png" type="image/x-icon" />
        <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon" />
        <title>login
            | Sistem Informasi Pengajuan Cuti
        </title>
        <!-- Google font-->
        <link rel="preconnect" href="https://fonts.gstatic.com/" />
        <link
            href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
            rel="stylesheet" />
        <link
            href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
            rel="stylesheet" />
        <link
            href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
            rel="stylesheet" />
        <!-- Font Awesome-->
        <link rel="stylesheet" type="text/css" href="{{ asset('viho') }}/assets/css/fontawesome.css" />
        <!-- ico-font-->
        <link rel="stylesheet" type="text/css" href="{{ asset('viho') }}/assets/css/icofont.css" />
        <!-- Themify icon-->
        <link rel="stylesheet" type="text/css" href="{{ asset('viho') }}/assets/css/themify.css" />
        <!-- Flag icon-->
        <link rel="stylesheet" type="text/css" href="{{ asset('viho') }}/assets/css/flag-icon.css" />
        <!-- Feather icon-->
        <link rel="stylesheet" type="text/css" href="{{ asset('viho') }}/assets/css/feather-icon.css" />
        <!-- Plugins css start-->
        <!-- Plugins css Ends-->
        <!-- Bootstrap css-->
        <link rel="stylesheet" type="text/css" href="{{ asset('viho') }}/assets/css/bootstrap.css" />
        <!-- App css-->
        <link rel="stylesheet" type="text/css" href="{{ asset('viho') }}/assets/css/style.css" />
        <link id="color" rel="stylesheet" href="{{ asset('viho') }}/assets/css/color-1.css" media="screen" />
        <!-- Responsive css-->
        <link rel="stylesheet" type="text/css" href="{{ asset('viho') }}/assets/css/responsive.css" />
    </head>

    <body>
        {{-- @include('layout.header') --}}
        <!-- Loader starts-->
        <div class="loader-wrapper">
            <div class="theme-loader">
                <div class="loader-p"></div>
            </div>
        </div>
        <!-- Loader ends-->
        <!-- error page start //-->
        <section>
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-12">
                        <div class="login-card">
                            <form class="theme-form login-form" method="POST" action="{{ route('login') }}">
                                @csrf
                                <h4>Login</h4>
                                <h6>Welcome back! Log in to your account.</h6>
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="icon-email"></i></span>
                                        <input class="form-control @error('email') is-invalid @enderror" type="email"
                                            name="email" value="{{ old('email') }}" required="" placeholder="Email" />
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <div class="input-group" id="show_hide_password">
                                        <span class="input-group-text"><i class="icon-lock"></i></span>
                                        <input
                                            class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror"
                                            type="password" name="password" autocomplete="off"
                                            placeholder="Masukkan password anda" />
                                        <span class="input-group-text">
                                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                        </span>
                                    </div>
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <input id="checkbox1" class="form-check-input" type="checkbox" name="remember"
                                            {{ old('remember') ? 'checked' : '' }} />
                                        <label for="checkbox1">Remember password</label>
                                    </div>
                                    @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block" type="submit">Sign in</button>
                                </div>
                                {{-- <div class="login-social-title">
                                    <h5>Sign in with</h5>
                                </div>
                                <div class="form-group">
                                    <ul class="login-social">
                                        <li>
                                            <a href="https://www.linkedin.com/login" target="_blank"><i
                                                    data-feather="linkedin"></i></a>
                                        </li>
                                        <li>
                                            <a href="https://www.twitter.com/login" target="_blank"><i
                                                    data-feather="twitter"></i></a>
                                        </li>
                                        <li>
                                            <a href="https://www.facebook.com/login" target="_blank"><i
                                                    data-feather="facebook"></i></a>
                                        </li>
                                        <li>
                                            <a href="https://www.instagram.com/login" target="_blank"><i
                                                    data-feather="instagram"> </i></a>
                                        </li>
                                    </ul>
                                </div>
                                <p>Don't have account?<a class="ms-2" href="{{ route('register') }}">Create Account</a>
                                </p> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @include('layout.footer')
        </section>



        <!-- error page end //-->
        <!-- latest jquery-->
        <script src="{{ asset('viho') }}/assets/js/jquery-3.5.1.min.js"></script>
        <!-- feather icon js-->
        <script src="{{ asset('viho') }}/assets/js/icons/feather-icon/feather.min.js"></script>
        <script src="{{ asset('viho') }}/assets/js/icons/feather-icon/feather-icon.js"></script>
        <!-- Sidebar jquery-->
        <script src="{{ asset('viho') }}/assets/js/config.js"></script>
        <!-- Bootstrap js-->
        <script src="{{ asset('viho') }}/assets/js/bootstrap/popper.min.js"></script>
        <script src="{{ asset('viho') }}/assets/js/bootstrap/bootstrap.min.js"></script>
        <!-- Plugins JS start-->
        <script>
            $(document).ready(function() {
                $("#show_hide_password a").on('click', function(event) {
                    event.preventDefault();
                    if($('#show_hide_password input').attr("type") == "text"){
                        $('#show_hide_password input').attr('type', 'password');
                        $('#show_hide_password i').addClass( "fa-eye-slash" );
                        $('#show_hide_password i').removeClass( "fa-eye" );
                    }else if($('#show_hide_password input').attr("type") == "password"){
                        $('#show_hide_password input').attr('type', 'text');
                        $('#show_hide_password i').removeClass( "fa-eye-slash" );
                        $('#show_hide_password i').addClass( "fa-eye" );
                    }
                });
            });
        </script>
        <!-- Plugins JS Ends-->
        <!-- Theme js-->
        <script src="{{ asset('viho') }}/assets/js/script.js"></script>
        <!-- Plugin used-->
        @include('sweetalert::alert')
    </body>

    <!-- Mirrored from laravel.pixelstrap.com/viho/login by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 08 Jul 2022 01:42:51 GMT -->

</html>