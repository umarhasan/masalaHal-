<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/images/q.png') }}" type="image/x-icon">
    <link rel="icon" type="image/png" sizes="56x56" href="assets/images/fav-icon/icon.png') }}">
	<!-- bootstrap CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" type="text/css" media="all">
	<!-- carousel CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}" type="text/css" media="all">
	<!-- animate CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}" type="text/css" media="all">
	<!-- animated-text CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/animated-text.css') }}" type="text/css" media="all">
	<!-- font-awesome CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}" type="text/css" media="all">
	<!-- font-flaticon CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/flaticon.css') }}" type="text/css" media="all">
	<!-- theme-default CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/theme-default.css') }}" type="text/css" media="all">
	<!-- meanmenu CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/meanmenu.min.css') }}" type="text/css" media="all">
	<!-- transitions CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/owl.transitions.css') }}" type="text/css" media="all">
	<!-- venobox CSS -->
	<link rel="stylesheet" href="{{ asset('venobox/venobox.css') }}" type="text/css" media="all">
	<!-- bootstrap icons -->
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-icons.css') }}" type="text/css" media="all">
	<!-- Main Style CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" type="text/css" media="all">
	<!-- responsive CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}" type="text/css" media="all">
	<!-- modernizr js -->
	<script src="{{ asset('assets/js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <link rel="icon" href="{{ asset('assets/images/maslyhal.png') }}" type="image/x-icon">
    <title>Problem Solving</title>
    <style>
        b, strong {
            font-weight: bolder;
            color: #208bee;
        }
    </style>

</head>

  <body>
    <!-- loder -->
            <div class="loader-wrapper">
                <div class="loader"></div>
                <div class="loder-section left-section"></div>
                <div class="loder-section right-section"></div>
            </div>

                <!-- Navbar -->
                @include('layouts.header')
                <!-- / Navbar -->
                 <!-- Content wrapper -->
                @yield('content')
                <!-- / Content -->
                <!-- Footer -->
                @include('layouts.footer')
                <!-- / Footer -->
                
    <script src="{{ asset('assets/js/vendor/jquery-3.6.2.min.js') }}"></script>
	<script src="{{ asset('assets/js/popper.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
	<script src="{{ asset('assets/js/waypoints.min.js') }}"></script>
	<script src="{{ asset('assets/js/wow.js') }}"></script>
	<script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
	<script src="{{ asset('venobox/venobox.js') }}"></script>
	<script src="{{ asset('assets/js/animated-text.js') }}"></script>
	<script src="{{ asset('venobox/venobox.min.js') }}"></script>
	<script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.meanmenu.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.scrollUp.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.barfiller.js') }}"></script>
	<script src="{{ asset('assets/js/theme.js') }}"></script>

</body>

</html>
