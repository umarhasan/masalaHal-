<!-- Top Header -->
<div class="header-top-section">
    <div class="container">
        <div class="row align-items-center d-flex">
            <div class="col-lg-6 col-md-6">
                <div class="header-address-info">
                    <p>
                        <i class="bi bi-geo-alt"></i> {{ env('SITE_ADDRESS', 'Karachi, Pakistan') }}
                        <span><i class="bi bi-envelope"></i> {{ env('SITE_EMAIL', 'info@maslyhal.com') }}</span>
                    </p>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 text-end d-flex justify-content-end align-items-center">
                <div class="hendre-social-icon me-3">
                    <ul>
                        <li><a href="{{ env('FACEBOOK_URL', '#') }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="{{ env('GMAIL_URL', '#') }}" target="_blank"><i class="fas fa-envelope"></i></a></li>
                        <li><a href="{{ env('TWITTER_URL', '#') }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="{{ env('LINKEDIN_URL', '#') }}" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                        <li><a href="{{ env('PINTEREST_URL', '#') }}" target="_blank"><i class="fab fa-pinterest-p"></i></a></li>
                    </ul>
                </div>
                <div class="phone-number">
                    <p><i class="fas fa-phone-square-alt"></i> Call Us : {{ env('SITE_PHONE', '+923172112995') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Menu -->
<div id="sticky-header" class="hendre_nav_manu">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-2 col-6">
                <div class="logo">
                    <a href="/"><img src="{{ asset('assets/images/logo.png') }}" alt="MaslyHal Logo"></a>
                </div>
            </div>
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

                    <div class="header-menu-right-btn d-flex align-items-center">
                        <!-- Search -->
                        <div class="header-search-button search-box-outer me-2">
                            <a href="#"><i class="fas fa-search"></i></a>
                        </div>

                        @guest

                        <div class="header-button">
                            {{-- <a class="quote-btn btn btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#quoteModal">Get Free Quote</a> --}}
                            <a class="quote-btn btn btn-sm" href="{{ route('login') }}">Login</a>
                            <a class="quote-btn btn btn-sm" href="{{ route('signup') }}">Sign Up</a>
                        </div>
                        @endguest

                        @auth
                        <div class="dropdown">
                            <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="
                                            @if(Auth::user()->hasRole('admin'))
                                                {{ route('admin.dashboard') }}
                                            @elseif(Auth::user()->hasRole('seller'))
                                                {{ route('seller.dashboard') }}
                                            @else
                                                {{ route('customer.dashboard') }}
                                            @endif
                                    ">Dashboard
                                    </a>
                                    <a class="dropdown-item" href="{{ route('customer.profile') }}">Profile</a>
                                    <a class="dropdown-item quote-btn" href="#" data-bs-toggle="modal" data-bs-target="#quoteModal">Get Free Quote</a>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item text-danger" type="submit">
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            </div>

                        @endauth
                        <div id="cartDropdown" class="position-relative ms-3">
                            <a href="{{ route('cart.index') }}" class="position-relative">
                                <i class="fas fa-shopping-cart fa-lg"></i>
                                @php
                                    $cart = (auth()->check() ? \App\Models\Cart::with('items')->where('user_id', auth()->id())->first() : \App\Models\Cart::with('items')->where('session_id', session('cart_session'))->first());
                                    $count = $cart ? $cart->items->sum('quantity') : 0;
                                @endphp
                                @if($count > 0)
                                    <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">{{ $count }}</span>
                                @endif
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Mobile Menu -->
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
                @guest
                <li>
                    <a class="quote-btn" href="#" data-bs-toggle="modal" data-bs-target="#quoteModal">Get Free Quote</a>
                </li>
                @endguest
                @auth
                <li>
                    <a class="quote-btn" href="#" data-bs-toggle="modal" data-bs-target="#quoteModal">Get Free Quote</a>
                </li>
                @endauth
            </ul>
        </nav>
    </div>
</div>
