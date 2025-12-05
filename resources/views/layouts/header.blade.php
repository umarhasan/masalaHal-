<!--===========================
    Loader
============================-->
<div class="loader-wrapper">
    <div class="loader"></div>
    <div class="loder-section left-section"></div>
    <div class="loder-section right-section"></div>
</div>

<!--===========================
   Top Header
============================-->
<div class="header-top-section">
    <div class="container">
        <div class="row align-items-center d-flex">
            <!-- Left Info -->
            <div class="col-lg-6 col-md-6">
                <div class="header-address-info">
                    <p>
                        <i class="bi bi-geo-alt"></i>
                        {{ env('SITE_ADDRESS', 'Karachi, Pakistan') }}
                        <span>
                            <i class="bi bi-envelope"></i>
                            {{ env('SITE_EMAIL', 'info@maslyhal.com') }}
                        </span>
                    </p>
                </div>
            </div>

            <!-- Right Info -->
            <div class="col-lg-6 col-md-6">
                <div class="header-top-right text-end d-flex align-items-center justify-content-end">

                    <!-- Social Icons -->
                    <div class="hendre-social-icon me-3">
                        <ul>
                            <li><a href="{{ env('FACEBOOK_URL', '#') }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="{{ env('GMAIL_URL', '#') }}" target="_blank"><i class="fas fa-envelope"></i></a></li>
                            <li><a href="{{ env('TWITTER_URL', '#') }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="{{ env('LINKEDIN_URL', '#') }}" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="{{ env('PINTEREST_URL', '#') }}" target="_blank"><i class="fab fa-pinterest-p"></i></a></li>
                        </ul>
                    </div>

                    <!-- Phone -->
                    <div class="phone-number">
                        <p>
                            <i class="fas fa-phone-square-alt"></i>
                            <span>Call Us :</span>
                            {{ env('SITE_PHONE', '+923172112995') }}
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<!--===========================
   Main Menu
============================-->
<div id="sticky-header" class="hendre_nav_manu">
    <div class="container">
        <div class="row align-items-center">

            <!-- Logo -->
            <div class="col-lg-2 col-6">
                <div class="logo">
                    <a href="/" title="MaslyHal - Problem Solving">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="MaslyHal Logo">
                    </a>
                </div>
            </div>

            <!-- Menu -->
            <div class="col-lg-10 col-6 d-none d-lg-block">
                <nav class="hendre_menu">
                    <ul class="nav_scroll">

                        <li><a href="/#home">Home</a></li>
                        <li><a href="/#about">About</a></li>
                        <li><a href="/#service">Services</a></li>
                        <li><a href="/#team">Team</a></li>
                        <li><a href="/#choose">Why Choose Us</a></li>
                        <li><a href="/#testi">Booking</a></li>
                        <li><a href="/#blog">Blog</a></li>
                        <li><a href="{{ route('shop.index') }}">Shop</a></li>

                    </ul>

                    <!-- Right Buttons -->
                    <div class="header-menu-right-btn">

                        <!-- Search -->
                        <div class="header-search-button search-box-outer">
                            <a href="#" aria-label="Search">
                                <i class="fas fa-search"></i>
                            </a>
                        </div>

                        <!-- Quote Button -->
                        <div class="header-button">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#quoteModal">
                                Get Free Quote
                            </a>
                        </div>

                    </div>
                </nav>
            </div>

        </div>
    </div>
</div>

<!--===========================
   Mobile Menu
============================-->
<div class="mobile-menu-area sticky d-lg-none">
    <div class="mobile-menu">
        <nav class="hendre_menu">
            <ul class="nav_scroll">
                <li><a href="/#home">Home</a></li>
                <li><a href="/#about">About</a></li>
                <li><a href="/#service">Services</a></li>
                <li><a href="/#team">Team</a></li>
                <li><a href="/#choose">Why Choose Us</a></li>
                <li><a href="/#testi">Booking</a></li>
                <li><a href="/#blog">Blog</a></li>
                <li><a href="{{ route('shop.index') }}">Shop</a></li>
            </ul>
        </nav>
    </div>
</div>
