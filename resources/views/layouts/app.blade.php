<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <!-- Mobile Responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Primary SEO -->
    <title>MaslyHal - Ghar Ka Har Masla Hal</title>
    <meta name="description" content="Electrician, Plumber, AC Repair, Painting, Carpenter & Home Maintenance services. Book Now on WhatsApp for fast, reliable home repair.">
    <meta name="keywords" content="home services, electrician, plumber, AC repair, carpenter, pakistan home maintenance, maslyhal">

    <!-- Canonical -->
    <link rel="canonical" href="https://maslyhal.com/">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/images/maslyhal.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/maslyhal.png') }}">

    <!-- Performance Preconnect -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Open Graph (Social Preview) -->
    <meta property="og:title" content="MaslyHal - Ghar Ka Har Masla Hal">
    <meta property="og:description" content="Electrician, Plumber, AC Repair & Home Maintenance Services. Quick WhatsApp Booking!">
    <meta property="og:image" content="{{ asset('assets/images/maslyhal.png') }}">
    <meta property="og:url" content="https://maslyhal.com/">
    <meta property="og:type" content="website">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="MaslyHal - Home Repair Services">
    <meta name="twitter:description" content="Ghar ka har masla — MaslyHal se hal! Book now on WhatsApp.">
    <meta name="twitter:image" content="{{ asset('assets/images/maslyhal.png') }}">

    <!-- Local Business Schema -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "MaslyHal",
        "image": "{{ asset('assets/images/maslyhal.png') }}",
        "url": "https://maslyhal.com",
        "telephone": "+923172112995",
        "address": {
            "@type": "PostalAddress",
            "addressCountry": "PK"
        },
        "description": "Electrician, Plumber, AC Repair, Painting & Home Maintenance services."
    }
    </script>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animated-text.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/theme-default.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/meanmenu.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.transitions.css') }}">
    <link rel="stylesheet" href="{{ asset('venobox/venobox.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

    <!-- Modernizr -->
    <script src="{{ asset('assets/js/vendor/modernizr-3.5.0.min.js') }}"></script>

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
            <!-- Toastr -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

            <script>
                @if(Session::has('success'))
                    toastr.success("{{ Session::get('success') }}");
                @endif
                @if(Session::has('error'))
                    toastr.error("{{ Session::get('error') }}");
                @endif
                @if(Session::has('info'))
                    toastr.info("{{ Session::get('info') }}");
                @endif
                @if(Session::has('warning'))
                    toastr.warning("{{ Session::get('warning') }}");
                @endif
            </script>
</body>
</html>
