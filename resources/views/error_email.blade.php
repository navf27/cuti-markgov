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
        <title>Error Update Status Cuti
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
                                <h4>Error Update Status Cuti</h4><hr>
                                <h6>Tidak dapat update status cuti karena Anda telah melakukan konfirmasi sebelumnya.</h6>
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