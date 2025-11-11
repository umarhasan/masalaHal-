@extends('layouts.app')

@section('content')


   <section class="bg1">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6 text-section">
                 
                <h3 id="slider-title" class="slider-title">Discover Your Perfect Solution</h3>
                <p id="slider-description" class="slider-description">
                    Join thousands of satisfied customers who trust us for exceptional services. Let’s build something amazing together.
                </p>
            </div>
            <div class="col-md-6">
                 
                <div class="slider-image-container">
                    <div class="slider-image" id="slider-image" 
                         style="background-image: url('https://via.placeholder.com/600x400');">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

     
    <section class="bg2" data-aos="zoom-in">

        <div class="container-fluid">
            <form id="myForm-search">
                <div class="row">
                    <div class="col-sm-6">
                        <input class="input-form" id="lead_service_type" type="text" placeholder="What Services are You Looking For?" required />
                        <div id="service-suggestions" class="dropdown-menu show" style="position: absolute; display: none; z-index: 1000;"></div>
                    </div>
                    <div class="col-sm-6">
                        <input class="input-form" id="postcode" type="text" placeholder="Postcode" required />
                    </div>
                    <div class="col-sm-12">
                        <button type="submit" class="search-btn">Search</button>
                    </div>
                    <div class="col-sm-12">
                        <p class="form-p">Popular: House Cleaning, Web Design, Personal Trainers</p>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <section class="step-up" id="myForm">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="text-center p-0 mb-2">
                    <div class="card px-0 pb-0 mb-3">
                        <button type="button" class="btn cancel" onclick="closeForm()"><i
                                class="fa-solid fa-x"></i></button>
                                <form id="msform">
                                    @csrf
                                    <fieldset>
                                        <div class="form-card">
                                            <div class="field-main-div">
                                                <div id="dynamic-services" class="field-main-div">
                                                    
                                                </div>
                                            </div>
                                            <div class="error-message" id="age-error"></div>
                                        </div>
                                        <input type="button" name="next" class="next action-button" value="Next" />
                                    </fieldset>

                                    {{-- Start --}}
                                        {{-- First Form --}}
                                        <fieldset>
                                            <div class="form-card">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h2 class="fs-title">What type of business is this for?</h2>
                                                    </div>
                                                </div>
                                                <div class="field-main-div">
                                                    <div class="field-div">
                                                        <input type="radio" id="daily" name="business" value="Personal project">
                                                        <label for="daily">Personal project</label>
                                                    </div>
                                                    <div class="field-div">
                                                        <input type="radio" id="twice" name="business" value="Sole trader/self-employed">
                                                        <label for="twice">Sole trader/self-employed</label>
                                                    </div>
                                                    <div class="field-div">
                                                        <input type="radio" id="weekly" name="business" value="Small business (1 - 9 employees)">
                                                        <label for="weekly">Small business (1 - 9 employees)</label>
                                                    </div>
                                                    <div class="field-div">
                                                        <input type="radio" id="every" name="business" value="Medium business (10 - 29 employees)">
                                                        <label for="every">Medium business (10 - 29 employees)</label>
                                                    </div>
                                                    <div class="field-div">
                                                        <input type="radio" id="once" name="business" value="Large business (30 - 99 employees)">
                                                        <label for="once">Large business (30 - 99 employees)</label>
                                                    </div>
                                                    <div class="field-div">
                                                        <input type="radio" id="one" name="business" value="Extra large business (100 or more employees)">
                                                        <label for="one">Extra large business (100 or more employees)</label>
                                                    </div>
                                                    <div class="field-div">
                                                        <input type="radio" id="charity" name="business" value="Charity/non-profit">
                                                        <label for="charity">Charity/non-profit</label>
                                                    </div>
                                                     
                                                    <div class="field-div">
                                                        <input type="radio" id="other" name="business" value="Other">
                                                        <label for="other">Other</label>&nbsp;
                                                        <input type="text" id="other-business" class="input-text" style="display: none;" placeholder="Please Enter your Business">
                                                    </div>
                                                </div>
                                                <div class="error-message" id="daily-error"></div>
                                            </div>
                                            <input type="button" name="next" class="next action-button" value="Next" />
                                            <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                        </fieldset>
                                        {{-- Second Form --}}
                                        <fieldset>
                                            <div class="form-card">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h2 class="fs-title">What industry do you operate in?</h2>
                                                    </div>
                                                </div>
                                                <div class="field-main-div">
                                                    <div class="field-div">
                                                        <input type="radio" id="0bedroom" name="industry" value="Business services">
                                                        <label for="0bedroom">Business services</label>
                                                    </div>
                                                    <div class="field-div">
                                                        <input type="radio" id="1bedroom" name="industry"
                                                            value="Creative industries">
                                                        <label for="1bedroom">Creative industries</label>
                                                    </div>
                                                    <div class="field-div">
                                                        <input type="radio" id="2bedroom" name="industry"
                                                            value="Entertainment & events">
                                                        <label for="2bedroom"> Entertainment & events</label>
                                                    </div>
                                                    <div class="field-div">
                                                        <input type="radio" id="3bedroom" name="industry"
                                                            value="Financial services">
                                                        <label for="3bedroom">Financial services</label>
                                                    </div>
                                                    <div class="field-div">
                                                        <input type="radio" id="4bedroom" name="industry" value="Health & fitness">
                                                        <label for="4bedroom">Health & fitness</label>
                                                    </div>
                                                    <div class="field-div">
                                                        <input type="radio" id="5bedroom" name="industry" value="Home services">
                                                        <label for="5bedroom">Home services</label>
                                                    </div>
                                                    <div class="field-div">
                                                        <input type="radio" id="studio" name="industry" value="Restaurant/food">
                                                        <label for="studio">Restaurant/food</label>
                                                    </div>
                                                    <div class="field-div">
                                                        <input type="radio" id="consumer" name="industry"
                                                            value="Retail/consumer goods">
                                                        <label for="consumer">Retail/consumer goods</label>
                                                    </div>
                                                    <div class="field-div">
                                                        <input type="radio" id="industry-other-radio" name="industry" value="Other">
                                                        <label for="industry-other-radio">Other</label>&nbsp;
                                                        <input type="text" id="industry-other" class="input-text" style="display: none;" placeholder="Please Enter your Industries">
                                                    </div>
                                                </div>
                                                <div class="error-message" id="bed-error"></div>
                                            </div> <input type="button" name="next" class="next action-button" value="Next" />
                                            <input type="button" name="previous" class="previous action-button-previous"
                                                value="Previous" />
                                        </fieldset>
                                        {{-- Third Form --}}
                                        <fieldset>
                                            <div class="form-card">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h2 class="fs-title">When would you like the website to go live/be updated?
                                                        </h2>
                                                    </div>
                                                </div>
                                                <div class="field-main-div">
                                                    <div class="field-div">
                                                        <input type="radio" id="1bathroom" name="live_website"
                                                            value="As soon as possible">
                                                        <label for="1bathroom">As soon as possible</label>
                                                    </div>
                                                    <div class="field-div">
                                                        <input type="radio" id="1bathroom+1" name="live_website"
                                                            value="Within a few weeks">
                                                        <label for="1bathroom+1">Within a few weeks</label>
                                                    </div>
                                                    <div class="field-div">
                                                        <input type="radio" id="2bathroom" name="live_website" value="Within a month">
                                                        <label for="2bathroom"> Within a month</label>
                                                    </div>
                                                    <div class="field-div">
                                                        <input type="radio" id="2bathroom+1" name="live_website"
                                                            value="Within a few months">
                                                        <label for="2bathroom+1">Within a few months</label>
                                                    </div>
                                                    <div class="field-div">
                                                        <input type="radio" id="3bathroom" name="live_website"
                                                            value="I would like to discuss this with the professional">
                                                        <label for="3bathroom">I would like to discuss this with the
                                                            professional</label>
                                                    </div>
                                                    <div class="field-div">
                                                        <input type="radio" id="website-other-radio" name="live_website" value="Other">
                                                        <label for="website-other-radio">Other</label>&nbsp;
                                                        <input type="text" id="website-other" class="input-text" style="display: none;" placeholder="Please Enter your Live Website">
                                                    </div>
                                                </div>
                                                <div class="error-message" id="bath-error"></div>
                                            </div> <input type="button" name="next" class="next action-button" value="Next" />
                                            <input type="button" name="previous" class="previous action-button-previous"
                                                value="Previous" />
                                        </fieldset>
                                        {{-- Fourth Form --}}
                                        <fieldset>
                                            <div class="form-card">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h2 class="fs-title">What is your estimated budget for this project?</h2>
                                                    </div>
                                                </div>
                                                <div class="field-main-div">
                                                    <div class="field-div">
                                                        <input type="radio" id="rec0" name="budget" value="Less than 250">
                                                        <label for="rec0">Less than 250</label>
                                                    </div>
                                                    <div class="field-div">
                                                        <input type="radio" id="rec1" name="budget" value="250 - 999">
                                                        <label for="rec1">250 - 999</label>
                                                    </div>
                                                    <div class="field-div">
                                                        <input type="radio" id="rec2" name="budget" value="1,000 - 1,999">
                                                        <label for="rec2">1,000 - 1,999</label>
                                                    </div>
                                                    <div class="field-div">
                                                        <input type="radio" id="rec3" name="budget" value="2,000 - 2,999">
                                                        <label for="rec3">2,000 - 2,999</label>
                                                    </div>
                                                    <div class="field-div">
                                                        <input type="radio" id="rec4" name="budget" value="3,000 - 4,999">
                                                        <label for="rec4">3,000 - 4,999</label>
                                                    </div>
                                                    <div class="field-div">
                                                        <input type="radio" id="rec5" name="budget" value="5,000 or more">
                                                        <label for="rec5">5,000 or more</label>
                                                    </div>
                                                    <div class="field-div">
                                                        <input type="radio" id="budget-other-radio" name="budget" value="Other">
                                                        <label for="budget-other-radio">Other</label>&nbsp;
                                                        <input type="text" id="budget-other" class="input-text" style="display: none;" placeholder="Please Enter your Budget">
                                                    </div>
                                                </div>
                                                <div class="error-message" id="rec-error"></div>
                                            </div> <input type="button" name="next" class="next action-button" value="Next" />
                                            <input type="button" name="previous" class="previous action-button-previous"
                                                value="Previous" />
                                        </fieldset>
                                        {{-- Five Form --}}
                                        <fieldset>
                                            <div class="form-card">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h2 class="fs-title">How likely are you to make a hiring decision?</h2>
                                                    </div>
                                                </div>
                                                <div class="field-main-div">
                                                    <div class="field-div">
                                                        <input type="radio" id="hire1" name="hire" value="Im ready to hire now">
                                                        <label for="hire1">I'm ready to hire now</label>
                                                    </div>
                                                    <div class="field-div">
                                                        <input type="radio" id="hire2" name="hire"
                                                            value="Im definitely going to hire someone">
                                                        <label for="hire2">I'm definitely going to hire someone</label>
                                                    </div>
                                                    <div class="field-div">
                                                        <input type="radio" id="hire3" name="hire"
                                                            value="Im likely to hire someone">
                                                        <label for="hire3">I'm likely to hire someone</label>
                                                    </div>
                                                    <div class="field-div">
                                                        <input type="radio" id="hire4" name="hire"
                                                            value="I will possibly hire someone">
                                                        <label for="hire4">I will possibly hire someone</label>
                                                    </div>
                                                    <div class="field-div">
                                                        <input type="radio" id="hire5" name="hire"
                                                            value="Im planning and researching">
                                                        <label for="hire5">I'm planning and researching</label>
                                                    </div>
                                                    <div class="field-div">
                                                        <input type="radio" id="hire-other-radio" name="hire" value="Other">
                                                        <label for="hire-other-radio">Other</label>&nbsp;
                                                        <input type="text" id="hire-other" class="input-text" style="display: none;" placeholder="Please Enter your Hire">
                                                    </div>

                                                </div>
                                                <div class="error-message" id="hire-error"></div>
                                            </div> <input type="button" name="next" class="next action-button" value="Next" />
                                            <input type="button" name="previous" class="previous action-button-previous"
                                                value="Previous" />
                                        </fieldset>
                                    {{-- End --}}

                                    <fieldset>
                                        <div class="form-card">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h2 class="fs-title">Provide Your Project Details</h2>
                                                </div>
                                            </div>
                                            <div class="field-main-div">
                                                <div class="field-div">
                                                    <!--<input name="contact" rows="5" placeholder="Enter your Project details" class="input-text"></input>-->
                                                     <textarea name="contact" class="form-control" placeholder="What's on your mind?" id="summernote"></textarea>
                                                </div>
                                            </div>
                                            <div class="error-message" id="name-error"></div>
                                        </div>
                                        <input type="button" name="next" class="next action-button" value="Next" />
                                        <input type="button" name="previous" class="previous action-button-previous"
                                            value="Previous" />
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-card">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h2 class="fs-title">Provide Your Personal Information</h2>
                                                </div>
                                            </div>
                                            <div class="field-main-div">
                                                <div class="field-div">
                                                    <input type="text" class="input-text" name="name"
                                                        placeholder="Enter Your Full Name" />
                                                </div>

                                                <div class="field-div">
                                                    <input type="text" class="input-text" name="phone"
                                                        placeholder="Enter Your Phone Number" />
                                                </div>

                                                <div class="field-div">
                                                    <input type="email" class="input-text" name="email"
                                                        placeholder="Enter Your Email" />
                                                </div>

                                                <div class="field-div">
                                                    <input type="text" class="input-text" name="zip"
                                                        placeholder="Enter Your Zip Code" />
                                                </div>

                                                <div class="field-div">
                                                    <!--<textarea name="address" class="form-control" placeholder="What's on your mind?" id="summernote1"></textarea>-->
                                                    <input name="address" rows="3" placeholder="Enter Your Address" class="input-textarea"></input>
                                                </div>

                                                <div class="field-div">
                                                    <select class="input-text" name="country" id="country" onchange="loadStates(this.value)">
                                                        <option value="">Select Your Country</option>
                                                        <option value="Pakistan">Pakistan</option>
                                                        <option value="India">India</option>
                                                        <option value="United States">United States</option>
                                                        <option value="Canada">Canada</option>
                                                        <!-- Add more countries as needed -->
                                                    </select>
                                                </div>

                                                <div class="field-div">
                                                    <select class="input-text" name="state" id="state" onchange="loadCities(this.value)">
                                                        <option value="">Select Your State</option>
                                                        <!-- States will be dynamically loaded based on selected country -->
                                                    </select>
                                                </div>

                                                <div class="field-div">
                                                    <select class="input-text" name="city" id="city">
                                                        <option value="">Select Your City</option>
                                                        <!-- Cities will be dynamically loaded based on selected state -->
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="error-message" id="name-error"></div>
                                        </div>
                                            <button type="submit"  class="next action-button" id="submit-button">Submit</button>
                                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-card">
                                            <h2 class="purple-text text-center"><strong>Great!</strong></h2> <br>
                                            <div class="row justify-content-center">
                                                <div class="col-3"> <img src="{{ asset('assets/images/success.gif') }}" class="fit-image">
                                                </div>
                                            </div> <br><br>
                                            <div class="row justify-content-center">
                                                <div class="col-7 text-center">
                                                    <h5 class="purple-text text-center">We've Recieved Your Details.</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg5">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 mb-4" data-aos="fade-down">
                    <h4 class="discover-h4 mb-4">DISCOVER</h4>
                    <p class="discover-p">Discover the convenience of having all your essential services in one place with Quick Solutions. We provide a wide range of professional services, from home maintenance to electrical repairs, plumbing, and even appliance servicing. No matter the task, our team of skilled experts is committed to delivering high-quality, efficient, and affordable solutions. Whether you’re in need of urgent repairs or planning a long-term project, we’ve got the experience and tools to handle it all. Explore our services and see how we can make your life easier with hassle-free, reliable assistance, tailored to your unique needs.</p>
                </div>
                <div class="col-sm-12 extra" data-aos="zoom-in">
                    <div class="your-class">
                        
                        @foreach($service_types as $service)
                                 <div>
                                    <a href="javascript:void(0);" class="dropdown-item" onclick="handleServiceSelect('{{ $service->name }}')">
                                        <img src="{{ asset('storage/' . $service->image) }}" alt="Image 1" style="width: 100%;height:250px;">
                                        <p>{{ $service->name }}</p>
                                    </a>
                                </div>
                            </a>
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
