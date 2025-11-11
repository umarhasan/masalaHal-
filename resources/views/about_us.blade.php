<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css"
        integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css"
        integrity="sha512-6lLUdeQ5uheMFbWm3CP271l14RsX1xtx+J5x2yeIDkkiBpeVTNhTqijME7GgRKKi6hCqovwCoBTlRBEC20M8Mg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    <link href="assets/css/style.css" rel="stylesheet" />

    <link rel="icon" href="{{ asset('assets/images/q.png') }}" type="image/x-icon">
    <title>Quick Solutions</title>
    <style>
    b, strong {
    font-weight: bolder;
    color: #208bee;
    }
    .ab3 {
        padding: 25px 0;
        width: 80%;
        margin: auto;
    }
.about-us {
            font-size: 50px;
            font-weight: 800;
            color: #000;
            letter-spacing: -0.2px; /* Padding around the text */
            text-align: center; /* Center text */
            
        }
</style>

</head>
  <body>
            <div class="progress">
        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0"
            aria-valuemax="100"></div>
    </div>


    <div class="overlay" id="overlay"></div>



    <div id="confirmation-popup" class="popup">
        <div class="popup-content">
            <p>Do you want to quit the form?</p>
            <button id="quit-button">Quit</button>
            <button id="continue-button">Continue</button>
        </div>
    </div>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <header data-aos="fade-down">
                    <!-- Navigation -->
                    <nav>
                        <div class="container">
                            <div class="row align-items-center">
                                <!-- Logo -->
                                <div class="col-md-2 col-2">
                                    <a href="/">
                                        <img src="{{ asset('assets/images/logo.png') }}" class="logo1" />
                                    </a>
                                </div>
            
            
                                <!-- Buttons Section -->
                                <div class="col-sm-10 col-10 text-end">
                                    <button class="custom-button1">
                                        <a href="{{ route('login') }}"><span>Login</span></a>
                                    </button>
                                    <button class="custom-button1 join-as-btn">
                                        <a href="{{ route('register') }}"><span>Join As A Professional</span></a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </nav>
        
                </header>
                <!-- / Navbar -->
                <section>
                <p  class="about-us">About Us</p>
                
            </section>
                <section class="ab3">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-12" data-aos="zoom-in-right">
                    <img src="./assets/images/about-1.gif" class="about-img" />
                    <div class="two-img">
                        <img src="./assets/images/about-2.gif" class="about-img" />
                        <img src="./assets/images/about-3.gif" class="about-img" />
                    </div>
                </div>
                <div class="col-sm-6 col-12" data-aos="zoom-in-left">
                    <h2 class="about-text"></h2><br/>
                    <p class="about-p">
                    Welcome to <strong>Quick Solutions</strong>, your reliable partner for all maintenance needs. 
                    Our expert services cover <strong>plumbing</strong>, <strong>electrical repairs</strong>, 
                    <strong>roofing</strong>, <strong>furniture fixing</strong>, and <strong>appliance servicing</strong>, 
                    ensuring your home or office stays in top shape.
                </p>
                <p class="about-p">
                    With a team of skilled professionals, we guarantee <strong>quality</strong>, 
                    <strong>efficiency</strong>, and <strong>affordability</strong> in every task. At 
                    <strong>Quick Solutions</strong>, we simplify maintenance so you can enjoy peace of mind. 
                    Experience hassle-free service with us today!
                </p>
                <p class="about-p">
                    At Quick Solutions, we pride ourselves on using the latest tools and techniques to deliver 
                    exceptional results. Whether it’s a minor repair or a major renovation, our experts ensure 
                    the job is completed on time and to your satisfaction. No problem is too big or small for us to handle!
                </p>
                <p class="about-p">
                    Your trust is our priority. That’s why we provide transparent pricing, regular updates, and 
                    excellent customer support to make the entire process stress-free for you. Join the growing 
                    community of satisfied customers who count on Quick Solutions for their maintenance needs.
                </p>
                </div>
            </div>
        </div>
    </section>

                @include('layouts.footer')
                <!-- / Footer -->
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>
        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js"
        integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"
        integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script>
        $(document).ready(function () {
            // Function to fetch service suggestions based on user input
            function fetchServiceSuggestions() {
                $('#lead_service_type').on('input', function () {
                    let query = $(this).val();

                    if (query.length > 1) {
                        $.ajax({
                            url: "{{ route('search.service') }}",
                            method: 'GET',
                            data: { service: query },
                            success: function (data) {
                                let suggestions = '';
                                if (data.length > 0) {
                                    data.forEach(function (item) {
                                        suggestions += `<a href="javascript:void(0);" class="dropdown-item" onclick="selectService('${item.name}')">${item.name}</a>`;
                                    });
                                } else {
                                    suggestions = '<a href="javascript:void(0);" class="dropdown-item disabled">No services found</a>';
                                }
                                $('#service-suggestions').html(suggestions).show();
                            },
                            error: function () {
                                $('#service-suggestions').html('<a href="javascript:void(0);" class="dropdown-item disabled">Error fetching data</a>').show();
                            }
                        });
                    } else {
                        $('#service-suggestions').hide();
                    }
                });
            }

            // Function to handle service selection (either from input or dropdown)
            window.selectService = function (serviceName) {
                $('#lead_service_type').val(serviceName);
                $('#service-suggestions').hide();

                // Now, let's fetch the related services based on the selected service
                fetchServicesOnSubmit(serviceName);
            };

            function fetchServicesOnSubmit(serviceType) {
                if (serviceType.trim() !== '') {
                    $.ajax({
                        url: "{{ route('search.service') }}",
                        method: 'GET',
                        data: { service: serviceType },
                        success: function (data) {
                            let serviceTypeName = data[0]?.name || serviceType;
                            let dynamicContent = '';
            
                            if (data.length > 0) {
                                dynamicContent += `
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <!-- Display service type image -->
                                            <div class="image-container">
                                                <img src="${data[0]?.image_url}" alt="${serviceTypeName}" class="img-fluid" style="width: 100%; height:200px; border-radius: 10px;">
                                            </div>
                                            <h2 class="fs-title mt-3">What are your ${serviceTypeName} needs?</h2>
                                        </div>
                                    </div>`;
            
                                data.forEach(function (item) {
                                    if (item.services && item.services.length > 0) {
                                        item.services.forEach(function (service) {
                                            dynamicContent += `
                                                <div class="field-div">
                                                    <input type="radio" id="service-${service.id}" name="need" value="${service.name}" required>
                                                    <label for="service-${service.id}">${service.name}</label>
                                                    <input type="hidden" name="service_id" value="${service.id}">
                                                </div>`;
                                        });
                                    }
                                });
                            } else {
                                dynamicContent = `
                                    <div class="field-div">
                                        <p>No services found for "${serviceType}".</p>
                                    </div>`;
                            }
            
                            $('#dynamic-services').html(dynamicContent);
                        },
                        error: function () {
                            $('#dynamic-services').html(`
                                <div class="field-div">
                                    <p>Something went wrong. Please try again later.</p>
                                </div>
                            `);
                        }
                    });
                } else {
                    alert('Please enter a service to search for.');
                }
            }
            // Function to handle form submission for lead generation
            function handleLeadGenerationFormSubmit() {
                $('#msform').on('submit', function (e) {
                    e.preventDefault(); // Prevent the default form submission

                    // Serialize form data
                    let formData = $(this).serialize();

                    // AJAX Request
                    $.ajax({
                        url: "{{ route('lead_genrate') }}",
                        method: "POST",
                        data: formData,
                        beforeSend: function () {
                            // Optionally, show a loading indicator here
                            $('#submit-button').text('Submitting...').prop('disabled', true);
                        },
                        success: function (response) {
                            // On success, move to step 8 and display success message
                            const fieldsets = $('fieldset');
                            const currentFieldset = fieldsets.last(); // Assuming step 8 is the last fieldset
                            fieldsets.hide(); // Hide all fieldsets
                            currentFieldset.show(); // Show the success fieldset

                            // Reset the form or perform any additional success handling
                            $('#msform')[0].reset();
                            $('#submit-button').text('Submit').prop('disabled', false);
                        },
                        error: function (xhr) {
                            // Handle errors (e.g., validation, server issues)
                            alert("An error occurred: " + xhr.responseJSON.message || "Unknown error");
                            $('#submit-button').text('Submit').prop('disabled', false);
                        }
                    });
                });
            }

            // Function to hide suggestions on outside click
            function hideSuggestionsOnClickOutside() {
                $(document).click(function (e) {
                    if (!$(e.target).closest('#service-suggestions, #lead_service_type').length) {
                        $('#service-suggestions').hide();
                    }
                });
            }

            // Function to initialize "Other" radio button functionality
            function initializeOtherFunctionality(radioName, inputId) {
                const otherRadioButton = document.querySelector(`input[name="${radioName}"][value="Other"]`);
                const otherInput = document.getElementById(inputId);
                const allRadioButtons = document.querySelectorAll(`input[name="${radioName}"]`);

                const handleRadioChange = (event) => {
                    if (event.target === otherRadioButton) {
                        otherInput.style.display = 'inline';
                        otherInput.focus();
                    } else {
                        otherInput.style.display = 'none';
                        otherInput.value = ''; // Clear input value
                        otherRadioButton.value = 'Other'; // Reset the "Other" value
                    }
                };

                otherInput.addEventListener('input', function () {
                    otherRadioButton.value = this.value;
                });

                allRadioButtons.forEach((radio) => {
                    radio.addEventListener('change', handleRadioChange);
                });
            }

            // Function to handle slider background changes
            function handleSliderBackground() {
                const sliders = @json($sliders);
                const sliderElement = document.getElementById("slider");
                const titleElement = document.getElementById("slider-title");
                const descriptionElement = document.getElementById("slider-description");

                let currentIndex = 0;

                function changeBackground() {
                    const currentSlider = sliders[currentIndex];
                    const storageBaseUrl = "{{ asset('storage/') }}";
                    const imageUrl = `${storageBaseUrl}/${currentSlider.image}`;

                    sliderElement.style.backgroundImage = `url('${imageUrl}')`;
                    titleElement.textContent = currentSlider.title || "Default Title";
                    descriptionElement.textContent = currentSlider.description || "Default Description";

                    currentIndex = (currentIndex + 1) % sliders.length;
                }

                setInterval(changeBackground, 3000);
                changeBackground(); // Initial load
            }
            
            // Function to initialize event handlers
            function initializeEventHandlers() {
                // Handle the form submission for lead generation
                handleLeadGenerationFormSubmit();

                // Handle closing the form
                window.closeForm = closeForm;
                // Handle service selection from dropdown
                window.handleServiceSelect = handleServiceSelect;
            }
            // Function to handle the service selection (dropdown click)
            function handleServiceSelect(serviceType) {
                // Fetch the form data based on the selected service
                resetFormContent();
                fetchServiceForm(serviceType);
            }

            // Function to fetch service form data dynamically
            function fetchServiceForm(serviceType) {
                $.ajax({
                    url: '/get-service-form-data/' + serviceType,  // The endpoint to get the form data
                    method: 'GET',
                    success: function (response) {
                        // Inject the received form HTML into the 'dynamic-services' div
                        injectFormContent(response.html);

                        // Display the form section
                        displayFormSection();
                        // Scroll to the top after the form is loaded
                        scrollToTop();
                    },
                    error: function () {
                        alert('Something went wrong while fetching the service form. Please try again later.');
                    }
                });
            }
            // Function to scroll to the top of the page
            function scrollToTop() {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
            // Function to inject the form HTML content into the page
            function injectFormContent(htmlContent) {
                // $('#dynamic-services').html(''); // Clear old content
                $('#dynamic-services').html(htmlContent);
                $('#myForm').show();// Inject new content
            }
            // Function to show the form section
            function displayFormSection() {

                var form = document.getElementById("myForm");
                form.style.display = "block";
                form.classList.add("fade-in");
                form.classList.remove("fade-out");

                // Show the overlay
                var overlay = document.getElementById("overlay");
                overlay.style.display = "block";
                //$('#myForm').show();  // Assuming '#myForm' is the ID of the form container
            }
            // Function to reset the form content
            function resetFormContent() {
                // $('#dynamic-services').html(''); // Clear existing dynamic content
                $('#msform')[0].reset(); // Reset the form fields
            }
            // Function to handle successful form submission
            function handleFormSuccess(response) {
                const fieldsets = $('fieldset');
                const currentFieldset = fieldsets.last(); // Assuming step 8 is the last fieldset
                fieldsets.hide(); // Hide all fieldsets
                currentFieldset.show(); // Show the success fieldset
                $('#msform')[0].reset(); // Optionally reset the form
                $('#submit-button').text('Submit').prop('disabled', false);
            }
            // Function to handle form submission errors
            function handleFormError(xhr) {
                alert("An error occurred: " + (xhr.responseJSON.message || "Unknown error"));
                $('#submit-button').text('Submit').prop('disabled', false);
            }
            
            // Initialize functions
            initializeEventHandlers();
            fetchServiceSuggestions();
            hideSuggestionsOnClickOutside();
            handleLeadGenerationFormSubmit();
            initializeOtherFunctionality('business', 'other-business');
            initializeOtherFunctionality('industry', 'industry-other');
            initializeOtherFunctionality('live_website', 'website-other');
            initializeOtherFunctionality('budget', 'budget-other');
            initializeOtherFunctionality('hire', 'hire-other');
            handleSliderBackground();
        });
    </script>

    @stack('scripts')
    
</body>

</html>
