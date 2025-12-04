<!-- Footer Section -->
<div class="footer-section">
    <div class="container">
        <div class="row subscribe-section">
            <div class="col-lg-5 col-md-12">
                <div class="subscribe-contact-info">
                    <div class="subscribe-icon">
                        <img src="{{ asset('assets/images/resource/call.png') }}" alt="">
                    </div>
                    <div class="subscribe-contact">
                        <span class="subscribe-text">For Enquiry :</span>
                        <h2 class="subscribe-phone-number">{{ env('FOOTER_PHONE', '+923172112995') }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12">
                <div class="widget-title">
                    <h2 class="widget-title"> Subscribe Now </h2>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="subscribe-widget">
                    <form action="#" method="get">
                        <input type="text" class="src-input-box" placeholder="Search Here" name="s" value="">
                        <button class="subscribe-btn" type="submit"><span>Subscribe</span></button>
                    </form>
                </div>
            </div>
        </div>

        <div class="row footer-bg">
            <!-- Company Info -->
            <div class="col-lg-3 col-md-6">
                <div class="widget widgets-company-info">
                    <div class="dreamhub-logo">
                        <a class="logo_thumb" href="{{ url('/') }}" title="logo">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="logo" />
                        </a>
                    </div>
                    <div class="company-info-desc">
                        <p>{{ env('FOOTER_TEXT', 'Professionally develop long-term performance based architectures metrics rather than') }}</p>
                    </div>
                    <div class="follow-company-icon">
                        <a href="{{ env('FOOTER_FACEBOOK', '#') }}"><i class="fab fa-facebook-f"></i></a>
                        <a href="{{ env('FOOTER_TWITTER', '#') }}"><i class="fab fa-twitter"></i></a>
                        <a href="{{ env('FOOTER_LINKEDIN', '#') }}"><i class="fab fa-linkedin-in"></i></a>
                        <a href="{{ env('FOOTER_PINTEREST', '#') }}"><i class="fab fa-pinterest-p"></i></a>
                    </div>
                </div>
            </div>

            <!-- Popular Services -->
            <div class="col-lg-3 col-md-6 pl-40">
                <div class="widget widget-nav-menu">
                    <h4 class="widget-title">Popular Services</h4>
                    <ul class="footer-menu">
                        @foreach($service_types as $service)
                            <li><a href="{{ url('service-details/'.$service->id) }}">{{ $service->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Useful Links -->
            <div class="col-lg-3 col-md-6">
                <div class="widget widget-nav-menu">
                    <h4 class="widget-title"> Useful Links </h4>
                    <ul class="footer-menu">
                        <li><a href="/#home">Home</a></li>
                        <li><a href="/#about">About</a></li>
                        <li><a href="/#service"> Service</a></li>
                        <li><a href="/#team"> Team</a></li>
                        <li><a href="/#choose"> Why Choose</a></li>
                        <li><a href="/#testi">Booking</a></li>
                        <li><a href="/#blog">Blog</a></li>
                    </ul>
                </div>
            </div>

            <!-- Working Hours -->
            <div class="col-lg-3 col-md-6 pr-0">
                <div class="menu-quick-link-contact">
                    <h4 class="widget-title"> Working Hours </h4>
                    <ul>
                        <li>Mon - Wed <span>{{ env('WORKING_HOURS_MON_WED', '8.00 AM - 5.00 PM') }}</span></li>
                        <li>Thu - Fri <span>{{ env('WORKING_HOURS_THU_FRI', '9.00 AM - 4.00 PM') }}</span></li>
                        <li>Saturday <span>{{ env('WORKING_HOURS_SAT', '9.00 AM - 2.00 PM') }}</span></li>
                        <li>Sunday <span>{{ env('WORKING_HOURS_SUN', 'Closed') }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer Bottom -->
<div class="footer-bottom-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <p>Copyright © {{ env('COPYRIGHT_YEAR', date('Y')) }} <span>{{ env('COPYRIGHT_TEXT', 'Maslyhal.com') }}</span>. All rights reserved.</p>
            </div>
            <div class="col-lg-6 col-md-6 text-right">
                <ul>
                    <li><a href="#">Terms Condition</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
