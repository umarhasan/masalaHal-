@extends('layouts.app')

@section('content')
    <!--==================================================-->
	<!-- Start Hendre Hero Section  -->
	<!--==================================================-->

	{{-- <div class="hero-list owl-carousel">
		<div id="Home" class="hero-section d-flex align-items-center">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-6 col-md-6">
						<div class="sero-content">
							<h4>100% Satisfaction Gaurenty</h4>
							<h1> Heighst Quality </h1>
							<h1> Home Services </h1>
							<h1> With <span>MasalaHal</span> </h1>

							<div class="hero-button">
								<a href="about.html"> Get An Estimate <i class="bi bi-plus"></i></a>
							</div>
							<div class="hero-shape">
								<img src="assets/images/slider/hero-shape.png" alt="">
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<div class="hero-thumb">
							<img src="assets/images/slider/img.png" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="home" class="hero-section slider2 d-flex align-items-center">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-6 col-md-6">
						<div class="sero-content">
							<h4>100% Satisfaction Gaurenty</h4>
							<h1> Heighst Quality </h1>
							<h1> Home Services </h1>
							<h1> With <span>Problem Solving</span> </h1>

							<div class="hero-button">
								<a href="about.html"> Get An Estimate <i class="bi bi-plus"></i></a>
							</div>
							<div class="hero-shape">
								<img src="assets/images/slider/hero-shape.png" alt="">
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<div class="hero-thumb">
							<img src="assets/images/slider/img2.png" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="home" class="hero-section d-flex align-items-center">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-6 col-md-6">
						<div class="sero-content">
							<h4>100% Satisfaction Gaurenty</h4>
							<h1> Heighst Quality </h1>
							<h1> Home Services </h1>
							<h1> With <span>Hendre</span> </h1>

							<div class="hero-button">
								<a href="about.html"> Get An Estimate <i class="bi bi-plus"></i></a>
							</div>
							<div class="hero-shape">
								<img src="assets/images/slider/hero-shape.png" alt="">
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<div class="hero-thumb">
							<img src="assets/images/slider/img.png" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> --}}
    <div class="hero-list owl-carousel">
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
							<img src="assets/images/resource/icon.png" alt="">
						</div>
						<div class="feature-contact">
							<span class="feature-ask">For Enquery :</span>
							<h2 class="feature-phone-number">+980 987 (0986) 030</h2>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="feature-single-box wow fadeInLeft "data wow daley="3.5s">
						<div class="feature-thumb">
							<img src="assets/images/resource/feature.jpg" alt="">
							<div class="feature-icon">
								<img src="assets/images/resource/feature1.png" alt="">
								<a class="feature-icon2" href="service-details.html"><i class="bi bi-arrow-right"></i></a>
							</div>
							<div class="feature-content">
								<h2>Home Repairing</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="feature-single-box wow fadeInDown "data wow daley="3.6s">
						<div class="feature-thumb">
							<img src="assets/images/resource/feature2.jpg" alt="">
							<div class="feature-icon">
								<img src="assets/images/resource/feature1.png" alt="">
								<a class="feature-icon2" href="service-details.html"><i class="bi bi-arrow-right"></i></a>
							</div>
							<div class="feature-content">
								<h2>Home Repairing</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="feature-single-box wow fadeInRight "data wow daley="3.7s">
						<div class="feature-thumb">
							<img src="assets/images/resource/feature3.jpg" alt="">
							<div class="feature-icon">
								<img src="assets/images/resource/feature2.png" alt="">
								<a class="feature-icon2" href="service-details.html"><i class="bi bi-arrow-right"></i></a>
							</div>
							<div class="feature-content">
								<h2>Home Maintaince</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="feature-shape">
					<img src="assets/images/resource/feature-shape.jpg" alt="">
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
				<div class="col-lg-6 col-md-12">
					<div class="about-right-thumb wow fadeInLeft "data wow daley="3.6s">
						<img src="assets/images/resource/about.png" alt="">
						<div class="about-counter">
							<h2 class="counter">795</h2>
							<h2 class="counter1">+</h2>
							<span class="counter-text">Project Completed</span>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-12 wow fadeInDown "data wow daley="3.7s">
					<div class="hendre-section-title">
						<h4>ABOUT US</h4>
						<h1>Repairing Your <span>House for</span></h1>
						<h1 class="sections">Looks as a New Home</h1>
						<p>Competently repurpose go forward benefits without goal-oriented ROI the conveniently target business opportunities whereas proactive</p>
					</div>
					<div class="about-items">
						<div class="about-icon">
							<img src="assets/images/resource/about-icn.png" alt="">
						</div>
						<div class="about-item-content">
							<h2 class="about-item-title">Smart Repair System</h2>
							<p class="about-discription">Conveniently target business opportunities market-driven solutions</p>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="about-item-list">
								<ul>
									<li><i class="bi bi-check-circle-fill"></i> Repairing Roofing and Door</li>
									<li><i class="bi bi-check-circle-fill"></i> Repairing Roofing and Door</li>
								</ul>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="about-item-list">
								<ul>
									<li><i class="bi bi-check-circle-fill"></i> Repairing Roofing and Door</li>
									<li><i class="bi bi-check-circle-fill"></i> Repairing Roofing and Door</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="hendre-button">
						<a href="about.html">Get An Estimate <i class="bi bi-plus"></i></a>
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
			<div class="row align-items-center wow fadeInUp "data wow daley="3.6s">
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
					<div class="col-lg-12">
						<div class="single-service-box wow fadeInLeft "data wow daley="3.7s">
							<div class="service-thumb">
								<img src="assets/images/resource/service1.jpg" alt="">
							</div>
							<div class="service-content">
								<div class="service-icon">
									<img src="assets/images/resource/service-icn1.png" alt="">
								</div>
								<h3 class="service-title">Commercial Reparing</h3>
								<p class="service-desc">Repurpose go forward benefits without goal conveniently targeted to business</p>
								<a class="hendre-button" href="service-details.html">Read More <i class="bi bi-plus"></i></a>
							</div>
						</div>
					</div>

					<div class="col-lg-12">
						<div class="single-service-box wow fadeInDown "data wow daley="3.8s">
							<div class="service-thumb">
								<img src="assets/images/resource/service2.jpg" alt="">
							</div>
							<div class="service-content">
								<div class="service-icon">
									<img src="assets/images/resource/service-icn3.png" alt="">
								</div>
								<h3 class="service-title">Home Floor Reparing</h3>
								<p class="service-desc">Repurpose go forward benefits without goal conveniently targeted to business</p>
								<a class="hendre-button" href="service-details.html">Read More <i class="bi bi-plus"></i></a>
							</div>
						</div>
					</div>

					<div class="col-lg-12">
						<div class="single-service-box wow fadeInRight "data wow daley="3.9s">
							<div class="service-thumb">
								<img src="assets/images/resource/service3.jpg" alt="">
							</div>
							<div class="service-content">
								<div class="service-icon">
									<img src="assets/images/resource/service-icn2.png" alt="">
								</div>
								<h3 class="service-title">Door Window Reparing</h3>
								<p class="service-desc">Repurpose go forward benefits without goal conveniently targeted to business</p>
								<a class="hendre-button" href="service-details.html">Read More <i class="bi bi-plus"></i></a>
							</div>
						</div>
					</div>

					<div class="col-lg-12">
						<div class="single-service-box wow fadeInLeft "data wow daley="4s">
							<div class="service-thumb">
								<img src="assets/images/resource/service1.jpg" alt="">
							</div>
							<div class="service-content">
								<div class="service-icon">
									<img src="assets/images/resource/service-icn1.png" alt="">
								</div>
								<h3 class="service-title">Commercial Reparing</h3>
								<p class="service-desc">Repurpose go forward benefits without goal conveniently targeted to business</p>
								<a class="hendre-button" href="service-details.html">Read More <i class="bi bi-plus"></i></a>
							</div>
						</div>
					</div>
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
			<div class="row align-items-center wow fadeInDown "data wow daley="3.9s">
				<div class="col-lg-12">
					<div class="hendre-section-title text-center padding-lg">
						<h4> why choose us </h4>
						<h1> Some Reason for Choose <span> Problem Solving </span></h1>
						<h1 class="sections"> Repairing Your Home </h1>
						<div class="rs-video2">
						<div class="animate-border">
							<a class="video-vemo-icon venobox vbox-item" data-vbtype="youtube" data-autoplay="true" href="https://youtu.be/BS4TUd7FJSg">
							Play</a>
						</div>
					</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<!-- Tab  -->
					<div class="tab wow fadeInRight "data wow daley="3.9s">

						<ul class="tabs">
							<li><a href="#"> <span>01.</span> Why Choose Us ? </a></li>
							<li><a href="#"> <span>02.</span> Problem Solving Missions </a></li>
							<li><a href="#"> <span>03.</span> Mission & Vission </a></li>
						</ul> <!-- / tabs -->

						<div class="tab_content">

							<!-- / tabs_item -->

							<div class="tabs_item">
								<div class="row">
									<div class="col-lg-6 col-md-6">
										<div class="tab-thumb">
											<img src="assets/images/resource/tab_1.jpg" alt="">
										</div>
									</div>

									<div class="col-lg-6 col-md-6 tab-right">
										<div class="hendre-section-title">
											<h4> Why Choose Us ? </h4>
											<h1> Repairing Your <span> House for </span> </h1>
											<h1 class="sections">Looks as a New Home</h1>
											<p>Competently repurpose go forward benefits without goal-oriented ROI the conveniently target business opportunities whereas proactive</p>
										</div>

										<div class="row">
											<div class="col-lg-6 col-md-6">
												<div class="about-item-list">
													<ul>
														<li><i class="bi bi-check-circle-fill"></i> Repairing Roofing and Door</li>
														<li><i class="bi bi-check-circle-fill"></i> Repairing Roofing and Door</li>
													</ul>
												</div>
											</div>

											<div class="col-lg-6 col-md-6">
												<div class="about-item-list">
													<ul>
														<li><i class="bi bi-check-circle-fill"></i> Repairing Roofing and Door</li>
														<li><i class="bi bi-check-circle-fill"></i> Repairing Roofing and Door</li>
													</ul>
												</div>
											</div>
										</div>
										<div class="hendre-button">
											<a href="service-details.html">Get An Estimate <i class="bi bi-plus"></i></a>
										</div>
									</div>
								</div>
							</div>

							<!-- / tabs_item -->

							<div class="tabs_item">
								<div class="row">
									<div class="col-lg-6 col-md-6">
										<div class="tab-thumb">
											<img src="assets/images/resource/tab_2.jpg" alt="">
										</div>
									</div>

									<div class="col-lg-6 col-md-6 tab-right">
										<div class="hendre-section-title">
											<h4> Problem Solving missions </h4>
											<h1> Repairing Your <span> House for </span> </h1>
											<h1 class="sections">Looks as a New Home</h1>
											<p>Competently repurpose go forward benefits without goal-oriented ROI the conveniently target business opportunities whereas proactive</p>
										</div>

										<div class="row">
											<div class="col-lg-6 col-md-6">
												<div class="about-item-list">
													<ul>
														<li><i class="bi bi-check-circle-fill"></i> Repairing Roofing and Door</li>
														<li><i class="bi bi-check-circle-fill"></i> Repairing Roofing and Door</li>
													</ul>
												</div>
											</div>

											<div class="col-lg-6 col-md-6">
												<div class="about-item-list">
													<ul>
														<li><i class="bi bi-check-circle-fill"></i> Repairing Roofing and Door</li>
														<li><i class="bi bi-check-circle-fill"></i> Repairing Roofing and Door</li>
													</ul>
												</div>
											</div>
										</div>
										<div class="hendre-button">
											<a href="service-details.html">Get An Estimate <i class="bi bi-plus"></i></a>
										</div>
									</div>
								</div>
							</div>

							<!-- / tabs_item -->

							<div class="tabs_item">
								<div class="row">
									<div class="col-lg-6 col-md-6">
										<div class="tab-thumb">
											<img src="assets/images/resource/tab_3.jpg" alt="">
										</div>
									</div>

									<div class="col-lg-6 col-md-6 tab-right">
										<div class="hendre-section-title">
											<h4> Mission & Vission </h4>
											<h1> Repairing Your <span> House for </span> </h1>
											<h1 class="sections">Looks as a New Home</h1>
											<p>Competently repurpose go forward benefits without goal-oriented ROI the conveniently target business opportunities whereas proactive</p>
										</div>

										<div class="row">
											<div class="col-lg-6 col-md-6">
												<div class="about-item-list">
													<ul>
														<li><i class="bi bi-check-circle-fill"></i> Repairing Roofing and Door</li>
														<li><i class="bi bi-check-circle-fill"></i> Repairing Roofing and Door</li>
													</ul>
												</div>
											</div>

											<div class="col-lg-6 col-md-6">
												<div class="about-item-list">
													<ul>
														<li><i class="bi bi-check-circle-fill"></i> Repairing Roofing and Door</li>
														<li><i class="bi bi-check-circle-fill"></i> Repairing Roofing and Door</li>
													</ul>
												</div>
											</div>
										</div>
										<div class="hendre-button">
											<a href="service-details.html">Get An Estimate <i class="bi bi-plus"></i></a>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
					<!-- End tab -->
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
				<div class="col-lg-4 col-md-12 wow fadeInLeft "data wow daley="3.6s">
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
							<div class="col-lg-12">
								<div class="single-team-box wow fadeInDown "data wow daley="3.7s">
									<div class="team-thumb">
										<img src="assets/images/resource/team1.png" alt="">

										<ul class="team-social-list">
											<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
											<li><a href="#"><i class="fab fa-twitter"></i></a></li>
											<li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
										</ul>
									</div>
									<div class="team-content">
										<h3 class="team-title"> Tina E. Rose </h3>
										<p class="team-text"> HR Manager </p>
									</div>
								</div>
							</div>

							<div class="col-lg-12">
								<div class="single-team-box wow fadeInUp"data wow daley="3.8s">
									<div class="team-thumb">
										<img src="assets/images/resource/team2.png" alt="">

										<ul class="team-social-list">
											<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
											<li><a href="#"><i class="fab fa-twitter"></i></a></li>
											<li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
										</ul>
									</div>
									<div class="team-content">
										<h3 class="team-title"> John D. Alexon </h3>
										<p class="team-text"> Carpenter </p>
									</div>
								</div>
							</div>

							<div class="col-lg-12">
								<div class="single-team-box wow fadeInRight "data wow daley="3.9s">
									<div class="team-thumb">
										<img src="assets/images/resource/team3.png" alt="">

										<ul class="team-social-list">
											<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
											<li><a href="#"><i class="fab fa-twitter"></i></a></li>
											<li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
										</ul>
									</div>
									<div class="team-content">
										<h3 class="team-title"> Mark B. Steward </h3>
										<p class="team-text"> CEO & Founder </p>
									</div>
								</div>
							</div>

							<div class="col-lg-12">
								<div class="single-team-box wow fadeInRight "data wow daley="3.9s">
									<div class="team-thumb">
										<img src="assets/images/resource/team2.png" alt="">

										<ul class="team-social-list">
											<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
											<li><a href="#"><i class="fab fa-twitter"></i></a></li>
											<li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
										</ul>
									</div>
									<div class="team-content">
										<h3 class="team-title"> John D. Alexon </h3>
										<p class="team-text"> Carpenter </p>
									</div>
								</div>
							</div>
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
				<div class="col-lg-5 col-md-12">
					<div class="row">
						<div class="testmn-bg wow fadeInDown "data wow daley="3.8s">
							<div class="testi-list owl-carousel">
								<div class="col-lg-12">
									<div class="teastimonial-single-box">
										<div class="testi-content">
											<div class="testi-icon">
												<i class="bi bi-quote"></i>
											</div>
											<p class="testi-desc">“Proactively unleash a vertical to communities rather than intuitive niche. Holisticly deliver toresource sucking infrastructures wire services authoritatively</p>
											<div class="testi-rating">
												<i class="bi bi-star-fill"></i>
												<i class="bi bi-star-fill"></i>
												<i class="bi bi-star-fill"></i>
												<i class="bi bi-star-fill"></i>
												<i class="bi bi-star-fill"></i>
											</div>
											<div class="user-pic">
												<img src="assets/images/resource/testi.png" alt="">
											</div>
											<div class="user-name">
												<h4>David M. Alexon</h4>
												<span class="user-sector">IT Manager</span>
											</div>
										</div>
									</div>
								</div>

								<div class="col-lg-12">
									<div class="teastimonial-single-box">
										<div class="testi-content">
											<div class="testi-icon">
												<i class="bi bi-quote"></i>
											</div>
											<p class="testi-desc">“Proactively unleash a vertical to communities rather than intuitive niche. Holisticly deliver toresource sucking infrastructures wire services authoritatively</p>
											<div class="testi-rating">
												<i class="bi bi-star-fill"></i>
												<i class="bi bi-star-fill"></i>
												<i class="bi bi-star-fill"></i>
												<i class="bi bi-star-fill"></i>
												<i class="bi bi-star-fill"></i>
											</div>
											<div class="user-pic">
												<img src="assets/images/resource/testi.png" alt="">
											</div>
											<div class="user-name">
												<h4>David M. Alexon</h4>
												<span class="user-sector">IT Manager</span>
											</div>
										</div>
									</div>
								</div>

								<div class="col-lg-12">
									<div class="teastimonial-single-box">
										<div class="testi-content">
											<div class="testi-icon">
												<i class="bi bi-quote"></i>
											</div>
											<p class="testi-desc">“Proactively unleash a vertical to communities rather than intuitive niche. Holisticly deliver toresource sucking infrastructures wire services authoritatively</p>
											<div class="testi-rating">
												<i class="bi bi-star-fill"></i>
												<i class="bi bi-star-fill"></i>
												<i class="bi bi-star-fill"></i>
												<i class="bi bi-star-fill"></i>
												<i class="bi bi-star-fill"></i>
											</div>
											<div class="user-pic">
												<img src="assets/images/resource/testi.png" alt="">
											</div>
											<div class="user-name">
												<h4>David M. Alexon</h4>
												<span class="user-sector">IT Manager</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-7 col-md-12">
					<!-- contact form box -->
					<div class="contact-form-box wow fadeInUp "data wow daley="3.9s">

						<div class="hendre-section-title pb-tsmn">
							<h4> BOOKING NOW </h4>
							<h1> Booking A <span>Services</span> </h1>
						</div>
						<form action="https://formspree.io/f/myyleorq" method="POST" id="dreamit-form">
							<div class="row">
								<div class="col-lg-6 col-md-6">
									<div class="form-box">
										<input type="text" placeholder="Your Name*">
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-box">
										<input type="text" placeholder="Enter E-Mail">
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-box">
										<input type="text" placeholder="Mobile No.">
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-box">
										<select id="service" name="service">
											<option value="select"> Select Service* </option>
											<option value="select"> Electrical System </option>
											<option value="select"> Auto Car Repiar </option>
											<option value="select"> Engine Diagonstrics </option>
											<option value="select"> Car & Engine Clean </option>
										</select>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-box">
										<textarea name="massage" id="massage" cols="30" rows="10" placeholder="Write Massege:"></textarea>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="contact-form">
										<button type="submit">  Submit Request </button>
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
						<h1> We Follow the <span>Processr</span> </h1>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="single-process-box wow fadeInLeft "data wow daley="3.5s">
						<div class="process-thumb">
							<img src="assets/images/resource/process1.png" alt="">
							<div class="process-number">
								<span>01</span>
							</div>
						</div>
						<div class="process-content">
							<h4 class="process-title">Booking Online</h4>
							<p class="process-desc">Competently repurpose forward conveniently target fixed</p>
						</div>
					</div>
				</div>

				<div class="col-lg-3 col-md-6">
					<div class="single-process-box wow fadeInDown "data wow daley="3.6s">
						<div class="process-thumb">
							<img src="assets/images/resource/process2.png" alt="">
							<div class="process-number">
								<span>02</span>
							</div>
						</div>
						<div class="process-content">
							<h4 class="process-title">Confirmation</h4>
							<p class="process-desc">Competently repurpose forward conveniently target fixed</p>
						</div>
					</div>
				</div>

				<div class="col-lg-3 col-md-6">
					<div class="single-process-box wow fadeInUp "data wow daley="3.7s">
						<div class="process-thumb">
							<img src="assets/images/resource/process3.png" alt="">
							<div class="process-number">
								<span>03</span>
							</div>
						</div>
						<div class="process-content">
							<h4 class="process-title">Estimate Details</h4>
							<p class="process-desc">Competently repurpose forward conveniently target fixed</p>
						</div>
					</div>
				</div>

				<div class="col-lg-3 col-md-6">
					<div class="single-process-box wow fadeInRight "data wow daley="3.9s">
						<div class="process-thumb">
							<img src="assets/images/resource/process4.png" alt="">
							<div class="process-number">
								<span>04</span>
							</div>
						</div>
						<div class="process-content">
							<h4 class="process-title">Complete Works</h4>
							<p class="process-desc">Competently repurpose forward conveniently target fixed</p>
						</div>
					</div>
				</div>
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
						<h1> Our Recent Blog  <span>Post</span> </h1>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-6">
					<div class="single-blog-box wow fadeInLeft "data wow daley="3.7s">
						<div class="blog-thumb">
							<img src="assets/images/resource/blog1.jpg" alt="">
							<div class="meta-blog">
								<a href="#"> By Admin</a>
							</div>
						</div>
						<div class="blog-content">
							<h2 class="blog-title"><a href="blog-details.html">Top 5 Secrete Home Repairing Tips Discussions</a></h2>
							<div class="blog-btn">
								<a href="blog-details.html">Read More <i class="bi bi-arrow-right"></i></a>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-4 col-md-6">
					<div class="single-blog-box wow fadeInUp "data wow daley="3.8s">
						<div class="blog-thumb">
							<img src="assets/images/resource/blog2.jpg" alt="">
							<div class="meta-blog">
								<a href="#"> By Admin</a>
							</div>
						</div>
						<div class="blog-content">
							<h2 class="blog-title"><a href="blog-details.html">10 Most Popular Comod Clean Styles for your Home</a></h2>
							<div class="blog-btn">
								<a href="blog-details.html">Read More <i class="bi bi-arrow-right"></i></a>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-4 col-md-6">
					<div class="single-blog-box wow fadeInRight "data wow daley="3.9s">
						<div class="blog-thumb">
							<img src="assets/images/resource/blog3.jpg" alt="">
							<div class="meta-blog">
								<a href="#"> By Admin</a>
							</div>
						</div>
						<div class="blog-content">
							<h2 class="blog-title"><a href="blog-details.html">Repairing Your Home Pipeline Using Equipments</a></h2>
							<div class="blog-btn">
								<a href="blog-details.html">Read More <i class="bi bi-arrow-right"></i></a>
							</div>
						</div>
					</div>
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

		<!-- <div class="modal fade" id="quoteModal" tabindex="-1" aria-labelledby="quoteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="quoteModalLabel">Get a Free Quote</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
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
                </div>
                </div>
            </div>
        </div> -->
    </section>
@endsection
