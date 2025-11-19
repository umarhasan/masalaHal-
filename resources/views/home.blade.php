@extends('layouts.app')

@section('content')
<style>
	.abc{
		list-style-type: disc; /* default bullets */
        margin: 10px 0;
        padding-left: 20px;
        font-size: 9px; /* smaller size */
        line-height: 1.5; /* spacing between points */
        color: #555;
	}
</style>
<!--==================================================-->
	<!-- Start Hendre Hero Section  -->
	<!--==================================================-->
    <div id="home" class="hero-list owl-carousel">
        @foreach($sliders as $slider)
            <div class="hero-section d-flex align-items-center">
                <div class="container">
                    <div class="row align-items-center">

                        {{-- ===== Left Side (Text) ===== --}}
                        <div class="col-lg-6 col-md-6">
                            {{-- 🔽 Always-visible Static Block --}}
                                <div class="sero-content mt-4">
                                    <h4>100% Satisfaction Gaurenty</h4>
                                    <h1>Heighst Quality</h1>
                                    <h1>Home Services</h1>
                                    <h1>With <span>MasalaHal</span></h1>
                                </div>
                                <div class="">
                                    {{-- Dynamic Content from Slider --}}
                                    @if($slider->tagline)
                                        <h1>{{ $slider->tagline }}</h1>
                                    @endif
                                    <h3>{{ $slider->title }}</h3>
                                    @if($slider->subtitle)
                                        <h1>{{ $slider->subtitle }}</h1>
                                    @endif
                                    @if($slider->highlight_text)
                                        <h1>With <span>{{ $slider->highlight_text }}</span></h1>
                                    @endif
                                    @if($slider->button_text)
                                    <div class="hero-button">
                                        <a href="{{ $slider->button_link ?? '#' }}">
                                            {{ $slider->button_text }} <i class="bi bi-plus"></i>
                                        </a>
                                    </div>
                                    @endif
                                    <div class="hero-button">
                                            <a href="#">
                                                Get An Estimate <i class="bi bi-plus"></i>
                                            </a>
                                        </div>

                                    <div class="hero-shape">
                                        <img src="{{ asset('assets/images/slider/hero-shape.png') }}" alt="">
                                    </div>
                                </div>
                        </div>

                        {{-- ===== Right Side (Image) ===== --}}
                        <div class="col-lg-6 col-md-6">
                            <div class="hero-thumb">
                                <img src="{{ asset('storage/'.$slider->image) }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!--==================================================-->
	<!-- Dynamic Service Slider Section -->
	<!--==================================================-->
    <div class="feature-section">
        <div class="container-fluid">
            <div class="row feature-bg align-items-center">

                <div class="col-lg-8 col-md-6">
                    <div class="hendre-section-title padding-lg">
                        <h4>features</h4>
                        <h1>Fixing What We <span>Improves</span></h1>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="feature-contact-info">
                        <div class="feature-ctn-icon">
                            <img src="{{ asset('assets/images/slider/icon.png') }}" alt="">
                        </div>
                        <div class="feature-contact">
                            <span class="feature-ask">For Enquiry :</span>
                            <h2 class="feature-phone-number">+92 317 211 299 5</h2>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="service-list owl-carousel">
                        @foreach($service_types as $service)
                            <div class="col-lg-12">
                                <div class="feature-single-box wow fadeInUp" data-wow-delay="0.{{ $loop->index + 5 }}s">
                            <div class="feature-thumb">
                                <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}">
                                <div class="feature-icon">
                                    <img src="{{ asset('assets/images/slider/feature1.png') }}" alt="">
                                    <a class="feature-icon2" href="{{ url('service-details/'.$service->id) }}"><i class="bi bi-arrow-right"></i></a>
                                </div>
                                <div class="feature-content">
                                    <h2>{{ $service->name }}</h2>
                                </div>
                            </div>
                        </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--==================================================-->
	<!-- End Hendre Feature Section  -->
	<!--==================================================-->

	<!--==================================================-->
	<!-- Start Hendre About Section  -->
	<!--==================================================-->
    <div id="about" class="about-section">
        <div class="container">
            <div class="row align-items-center">
                <!-- Left Image & Counter -->
                <div class="col-lg-6 col-md-12">
                    <div class="about-right-thumb wow fadeInLeft" data-wow-delay="0.1s">
                        @if(isset($about->image))
                            <img src="{{ asset('storage/' . $about->image) }}" alt="About Image">
                        @else
                            <img src="{{ asset('assets/images/slider/about.png') }}" alt="">
                        @endif
                        <div class="about-counter">
                            <h2 class="counter">{{ $projects_completed ?? 500 }}</h2>
                            <h2 class="counter1">+</h2>
                            <span class="counter-text">Project Completed</span>
                        </div>
                    </div>
                </div>
                <!-- Right Content -->
                <div class="col-lg-6 col-md-12 wow fadeInDown" data-wow-delay="0.1s">
                    <div class="hendre-section-title">
                        <h4>ABOUT US</h4>
                        <h1>{{ $about->title ?? 'Problem Solving Every' }}</h1>
                        <p>{{ $about->description ?? 'At Masala Hal, we provide professional home services across all categories – from maintenance and cleaning to technical repairs and renovation. Our mission is to make your home safe, functional, and beautiful, ensuring every project is completed with care and quality.' }}</p>
                    </div>

                    <!-- Main About Item -->
                    <div class="about-items">
                        <div class="about-icon">
                            <img src="{{ asset('assets/images/slider/about-icn.png') }}" alt="">
                        </div>
                        <div class="about-item-content">
                            <h2 class="about-item-title">{{ $main_about_item_title ?? 'Smart Repair System' }}</h2>
                            <p class="about-discription">{{ $main_about_item_description ?? 'Conveniently target business opportunities market-driven solutions' }}</p>
                        </div>
                    </div>

                    <!-- Dynamic Service List -->
                    <div class="row">
                        @if(isset($service_types) && $service_types->count() > 0)
                            @foreach($service_types as $service)
                                <div class="col-lg-6 col-md-6">
                                    <div class="about-item-list">
                                        <ul>
                                            <li><i class="bi bi-check-circle-fill"></i> {{ $service->name }}</li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-12">
                                <p>No services available currently.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Button -->
                    <div class="hendre-button">
                        <a href="#">Get An Estimate <i class="bi bi-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<!--==================================================-->
	<!-- End Hendre About Section  -->
	<!--==================================================-->

	<!--==================================================-->
	<!-- Start Hendre Service Section  -->
	<!--==================================================-->
	<div class="service-top-section">
		<div class="container">
			<div class="row align-items-center wow fadeInUp "data wow daley="1s">
				<div class="col-lg-12">
					<div class="hendre-section-title white padding-lg">
						<h4>OUR SERVICES</h4>
						<h1>Solutions for Renovating</h1>
						<h1 class="sections">Home <span>Repairing</span></h1>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="service" class="service-section">
		<div class="container">
			<div class="row service-bg">
				<div class="service-list owl-carousel">
                    @foreach($service_types as $service)
                        <div class="col-lg-12">
                            <div class="single-service-box" data-wow-delay="0.{{ $loop->index + 3 }}s">

                                {{-- Service Image --}}
                                <div class="service-thumb">
                                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}">
                                </div>

                                {{-- Service Content --}}
                                <div class="service-content">
                                    <h3 class="service-title">{{ $service->name }}</h3>

                                    {{-- Description as list points --}}
                                    @if($service->description)
                                        @php
                                            // Split description by new lines or commas
                                            $points = preg_split("/[\r\n,]+/", $service->description);
                                        @endphp
                                        <ul class="abc">
                                            @foreach($points as $point)
                                                <li>{{ trim($point) }}</li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    <a class="hendre-button" href="{{ url('service-details/'.$service->id) }}">
                                        Read More <i class="bi bi-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
				</div>
			</div>
		</div>
	</div>
	<!--==================================================-->
	<!-- End Hendre Service Section  -->
	<!--==================================================-->

	<!--==================================================-->
	<!-- Start Hendre Why Choose  Section  -->
	<!--==================================================-->
    <div id="choose" class="why-choose-section">
        <div class="container">
            <div class="row align-items-center" data-wow-delay="1s">
                <div class="col-lg-12">
                    <div class="hendre-section-title text-center padding-lg">
                        <h4> why choose us </h4>
                        <h1> Some Reason for Choose <span> Problem Solving </span></h1>
                        <h1 class="sections"> Repairing Your Home </h1>

                        <div class="rs-video2">
                            <div class="animate-border">
                                <a class="video-vemo-icon venobox vbox-item" data-vbtype="youtube" data-autoplay="true" href="https://youtu.be/BS4TUd7FJSg">Play</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">

                    <div class="tab" data-wow-delay="3.9s">

                        <!-- ========== TABS TITLE (DYNAMIC) ========== -->
                        <ul class="tabs">
                             <li>
                                <a href="#">
                                        <span>01.</span> Why Choose Us ? </a></li>
                                        <li><a href="#">
                                            <span>02.</span> MasalaHal </a>
                                        </li>
                                        <li><a href="#"> <span>03.</span> Mission & Vission </a>
                                        </li>
                                    </ul>

                        <!-- ========== TABS CONTENT (DYNAMIC) ========== -->
                        <div class="tab_content">

                            @foreach($whychooses as $item)
                            <div class="tabs_item">
                                <div class="row">

                                    <!-- LEFT IMAGE -->
                                    <div class="col-lg-6 col-md-6">
                                        <div class="tab-thumb">
                                            <img src="{{ asset($item->image) }}" alt="">
                                        </div>
                                    </div>

                                    <!-- RIGHT CONTENT -->
                                    <div class="col-lg-6 col-md-6 tab-right">
                                        <div class="hendre-section-title">
                                            <h4>{{ $item->title }}</h4>
                                            <h1>{!! $item->subtitle !!}</h1>
                                            {{-- <h1 class="sections">{{ $item->section }}</h1> --}}
                                            <p>{{ $item->description }}</p>
                                        </div>

                                        <div class="row">
                                            @php
                                                // Convert bullet_points column to array
                                                $points = explode("\n", $item->bullet_points);
                                                $chunks = array_chunk($points, ceil(count($points) / 2));
                                            @endphp

                                            @foreach($chunks as $chunk)
                                            <div class="col-lg-6 col-md-6">
                                                <div class="about-item-list">
                                                    <ul>
                                                        @foreach($chunk as $point)
                                                            @if(trim($point) != "")
                                                                <li><i class="bi bi-check-circle-fill"></i> {{ $point }}</li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                            @endforeach

                                        </div>
                                        <!-- Dynamic Service List -->
                                        <div class="row">
                                            @if(isset($service_types) && $service_types->count() > 0)
                                                @foreach($service_types as $service)
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="about-item-list">
                                                            <ul>
                                                                <li><i class="bi bi-check-circle-fill"></i> {{ $service->name }}</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="col-12">
                                                    <p>No services available currently.</p>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="hendre-button">
                                            <a href="{{ $item->button_link }}">Get An Estimate <i class="bi bi-plus"></i></a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
	<!--==================================================-->
	<!-- End Hendre Why Choose Section  -->
	<!--==================================================-->

	<!--==================================================-->
	<!-- Start Hendre Team Section  -->
	<!--==================================================-->
	<div id="team" class="team-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12" data-wow-delay="3.6s">
                    <div class="hendre-section-title white">
                        <h4> Our Team </h4>
                        <h1> Meet Our Experts </h1>
                        <h1 class="sections"> Team <span>Member</span> </h1>
                        <p>Competently repurpose go forward benefits without goal-oriented ROI the conveniently target business opportunities whereas proactive</p>
                    </div>
                </div>

                <div class="col-lg-8 col-md-12">
                    <div class="row">
                        <div class="team-list owl-carousel">

                            @foreach($teams as $index => $team)
                            <div class="col-lg-12">
                                <div class="single-team-box wow
                                    @if($index % 3 == 0) fadeInDown
                                    @elseif($index % 3 == 1) fadeInUp
                                    @else fadeInRight
                                    @endif"
                                    data-wow-delay="3.{{ 6 + $index*0.1 }}s">

                                    <div class="team-thumb">
                                        <img src="{{ asset($team->image) }}" alt="{{ $team->name }}">
                                        <ul class="team-social-list">
                                            @if($team->facebook)
                                                <li><a href="{{ $team->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                                            @endif
                                            @if($team->twitter)
                                                <li><a href="{{ $team->twitter }}"><i class="fab fa-twitter"></i></a></li>
                                            @endif
                                            @if($team->linkedin)
                                                <li><a href="{{ $team->linkedin }}"><i class="fab fa-linkedin-in"></i></a></li>
                                            @endif
                                        </ul>
                                    </div>

                                    <div class="team-content">
                                        <h3 class="team-title">{{ $team->name }}</h3>
                                        <p class="team-text">{{ $team->role }}</p>
                                    </div>

                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<!--==================================================-->
	<!-- End Hendre Team Section  -->
	<!--==================================================-->

	<!--==================================================-->
	<!-- Start Hendre Teastimonial Section  -->
	<!--==================================================-->
	<div id="testi" class="testimonial-section">
        <div class="container">
            <div class="row testi-bg">

                <!-- Testimonial Carousel -->
                <div class="col-lg-5 col-md-12">
                    <div class="row">
                        <div class="testmn-bg" data-wow-delay="3.8s">
                            <div class="testi-list owl-carousel">
                                @foreach($testimonials as $testimonial)
                                <div class="col-lg-12">
                                    <div class="teastimonial-single-box">
                                        <div class="testi-content">
                                            <div class="testi-icon">
                                                <i class="bi bi-quote"></i>
                                            </div>
                                            <p class="testi-desc">{{ $testimonial->content }}</p>
                                            <div class="testi-rating">
                                                @for($i=0; $i < $testimonial->rating; $i++)
                                                    <i class="bi bi-star-fill"></i>
                                                @endfor
                                            </div>
                                            <div class="user-pic">
                                                <img src="{{ asset('storage/'.$testimonial->image) }}" alt="{{ $testimonial->name }}">
                                            </div>
                                            <div class="user-name">
                                                <h4>{{ $testimonial->name }}</h4>
                                                <span class="user-sector">{{ $testimonial->position }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Booking Form -->
                <div class="col-lg-7 col-md-12">
                    <div class="contact-form-box" data-wow-delay="3.9s">
                        <div class="hendre-section-title pb-tsmn">
                            <h4> BOOKING NOW </h4>
                            <h1> Booking A <span>Services</span> </h1>
                        </div>
                        <form action="{{ route('lead_genrate') }}" method="POST" id="dreamit-form">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-box">
                                        <input type="text" name="name" placeholder="Your Name*" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-box">
                                        <input type="email" name="email" placeholder="Enter E-Mail">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-box">
                                        <input type="text" name="phone" placeholder="Mobile No." required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-box">
                                        <select id="service" name="service" required>
                                            <option value=""> Select Service* </option>
                                            @foreach($service_types as $service)
                                                <option value="{{ $service->name }}">{{ $service->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-box">
                                        <textarea name="message" cols="30" rows="10" placeholder="Write Message:"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="contact-form">
                                        <button type="submit">Submit Request</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div id="status"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
	<!--==================================================-->
	<!-- End Hendre Testimonial Section  -->
	<!--==================================================-->

	<!--==================================================-->
	<!-- Start Hendre Process Section  -->
	<!--==================================================-->
	<div class="process-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="hendre-section-title white text-center padding-lg">
                        <h4> Work Process </h4>
                        <h1> We Follow the <span>Process</span> </h1>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($processes as $process)
                <div class="col-lg-3 col-md-6">
                    <div class="single-process-box wow fadeInUp" data-wow-delay="0.{{ $loop->iteration + 4 }}s">
                        <div class="process-thumb">
                            {{-- <img src="{{ asset('storage/'.$process->image) }}" alt="{{ $process->title }}"> --}}
                            <div class="process-number">
                                <span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            </div>
                        </div>
                        <div class="process-content">
                            <h4 class="process-title">{{ $process->title }}</h4>
                            <p class="process-desc">{{ $process->description }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
	<!--==================================================-->
	<!-- End Hendre Process Section  -->
	<!--==================================================-->

	<!--==================================================-->
	<!-- Start Hendre Blog Section  -->
	<!--==================================================-->
	<div id="blog" class="blog-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="hendre-section-title text-center padding-lg">
                    <h4> Our Blog </h4>
                    <h1> Our Recent Blog <span>Post</span> </h1>
                </div>
            </div>
        </div>

        <!-- Blog Slider -->
        <div class="row">
        <div class="blog-list owl-carousel">

            @foreach($blogs as $blog)
            <div class="col-lg-12">
                <div class="single-blog-box wow fadeInUp mb-4" style="margin-right:20px;" data-wow-delay="0.{{ $loop->iteration + 6 }}s">
                    <div class="blog-thumb">
                        <img src="{{ asset('storage/'.$blog->image) }}" alt="{{ $blog->title }}">
                        <div class="meta-blog">
                            <a href="#"> By {{ $blog->author }}</a>
                        </div>
                    </div>
                    <div class="blog-content">
                        <h2 class="blog-title">
                            <a href="#">
                                {{ $blog->title }}
                            </a>
                        </h2>
                        <p class="blog-excerpt">{{ \Illuminate\Support\Str::limit($blog->description, 100, '...') }}</p>
                        <div class="blog-btn">
                            <a href="#">
                                Read More <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
</div>
    </div>
</div>
	<!--==================================================-->
	<!-- End Hendre Blog Section  -->
	<!--==================================================-->

   <!-- Get a Free Quote Section -->
    <section id="get-free-quote" class="quote-section">
        <!-- Modal -->
       <!-- Quote Modal -->
        <div class="modal fade" id="quoteModal" tabindex="-1" aria-labelledby="quoteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quoteModalLabel">Get a Free Quote</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                @auth
                <form action="{{ route('quotes.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Enter Title" required>
                    </div>

                    <div class="form-group mt-2">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" placeholder="Enter Description" rows="4" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Submit Quote</button>
                </form>
                @else
                    <div class="text-center">
                        <p class="mb-3">Please login to submit a free quote.</p>
                        <a href="{{ route('login') }}" class="btn btn-warning">Login Now</a>
                    </div>
                @endauth
            </div>
            </div>
        </div>
        </div>
    </section>

    @endsection
