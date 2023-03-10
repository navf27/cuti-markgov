<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from laravel.pixelstrap.com/viho/form-controls/form-validation by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 08 Jul 2022 01:42:03 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities. laravel/framework: ^8.40">
    <meta name="keywords"
        content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    {{-- <link rel="icon" href="{{ asset('viho') }}/assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('viho') }}/assets/images/favicon.png" type="image/x-icon"> --}}
    <link rel="icon" href="{{ asset('LOGO_SCOMPTEC.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('LOGO_SCOMPTEC.png') }}" type="image/x-icon">
    <title>Sistem Informasi Pengajuan Cuti</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="{{ asset('viho') }}/assets/css/fontawesome.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('viho') }}/assets/css/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('viho') }}/assets/css/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('viho') }}/assets/css/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('viho') }}/assets/css/feather-icon.css">
    <!-- Plugins css start-->
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('viho') }}/assets/css/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('viho') }}/assets/css/style.css">
    <link id="color" rel="stylesheet" href="{{ asset('viho') }}/assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('viho') }}/assets/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('viho') }}/assets/css/date-picker.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="https://kit.fontawesome.com/4c88a2d5c6.js" crossorigin="anonymous"></script>
    @yield('styles')
</head>

<body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="theme-loader"></div>
    </div>
    <!-- Loader ends-->

    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-sidebar" id="pageWrapper">

        <!-- Page Header Start-->
        @include('layout.header')
        <!-- Page Header Ends -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper sidebar-icon">
            <!-- Page Sidebar Start-->
            @include('layout.sidebar')
            <!-- Page Sidebar Ends-->
            <div class="page-body">
                <!-- Container-fluid starts-->
                @yield('content')
                <!-- Container-fluid Ends-->
            </div>
            <!-- footer start-->
            @include('layout.footer')
        </div>
    </div>
    @include('modal_change_avatar')
    <!-- latest jquery-->
    <script src="{{ asset('viho') }}/assets/js/jquery-3.5.1.min.js"></script>
    <!-- feather icon js-->
    <script src="{{ asset('viho') }}/assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="{{ asset('viho') }}/assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- Sidebar jquery-->
    <script src="{{ asset('viho') }}/assets/js/sidebar-menu.js"></script>
    <script src="{{ asset('viho') }}/assets/js/config.js"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('viho') }}/assets/js/bootstrap/popper.min.js"></script>
    <script src="{{ asset('viho') }}/assets/js/bootstrap/bootstrap.min.js"></script>
    <!-- Plugins JS start-->
    <script src="{{ asset('viho') }}/assets/js/form-validation-custom.js"></script>
    <script src="{{ asset('viho') }}/assets/js/prism/prism.min.js"></script>
    <script src="{{ asset('viho') }}/assets/js/clipboard/clipboard.min.js"></script>
    <script src="{{ asset('viho') }}/assets/js/counter/jquery.waypoints.min.js"></script>
    <script src="{{ asset('viho') }}/assets/js/counter/jquery.counterup.min.js"></script>
    <script src="{{ asset('viho') }}/assets/js/counter/counter-custom.js"></script>
    <script src="{{ asset('viho') }}/assets/js/custom-card/custom-card.js"></script>
    <script src="{{ asset('viho') }}/assets/js/datepicker/date-picker/datepicker.js"></script>
    <script src="{{ asset('viho') }}/assets/js/datepicker/date-picker/datepicker.en.js"></script>
    <script src="{{ asset('viho') }}/assets/js/datepicker/date-picker/datepicker.custom.js"></script>
    <script src="{{ asset('viho') }}/assets/js/owlcarousel/owl.carousel.js"></script>
    <script src="{{ asset('viho') }}/assets/js/general-widget.js"></script>
    <script src="{{ asset('viho') }}/assets/js/height-equal.js"></script>
    <script src="{{ asset('viho') }}/assets/js/tooltip-init.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('viho') }}/assets/js/script.js"></script>
    {{-- <script src="{{ asset('viho') }}/assets/js/theme-customizer/customizer.js"></script> --}}
    <!-- Plugin used-->
    <script src="{{ asset('viho') }}/assets/js/datepicker/date-picker/datepicker.js"></script>
    <script src="{{ asset('viho') }}/assets/js/datepicker/date-picker/datepicker.en.js"></script>
    <script src="{{ asset('viho') }}/assets/js/datepicker/date-picker/datepicker.custom.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @include('sweetalert::alert')
    @stack('js')
    
</body>

<!-- Mirrored from laravel.pixelstrap.com/viho/form-controls/form-validation by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 08 Jul 2022 01:42:03 GMT -->

</html>
