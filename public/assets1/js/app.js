
        $(document).ready(function () {
            let isFormSubmitting = false; // Flag to track form submission state
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
                                                <img src="${data[0]?.image_url}" alt="${serviceTypeName}" class="img-fluid" style="width:60%; height:200px; border-radius: 10px;">
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
        // $(document).ready(function () {
        //     // Function to fetch service suggestions based on user input
        //     function fetchServiceSuggestions() {
        //         $('#lead_service_type').on('input', function () {
        //             let query = $(this).val();

        //             if (query.length > 1) {
        //                 $.ajax({
        //                     url: "{{ route('search.service') }}",
        //                     method: 'GET',
        //                     data: { service: query },
        //                     success: function (data) {
        //                         let suggestions = '';
        //                         if (data.length > 0) {
        //                             data.forEach(function (item) {
        //                                 suggestions += `<a href="javascript:void(0);" class="dropdown-item" onclick="selectService('${item.name}')">${item.name}</a>`;
        //                             });
        //                         } else {
        //                             suggestions = '<a href="javascript:void(0);" class="dropdown-item disabled">No services found</a>';
        //                         }
        //                         $('#service-suggestions').html(suggestions).show();
        //                     },
        //                     error: function () {
        //                         $('#service-suggestions').html('<a href="javascript:void(0);" class="dropdown-item disabled">Error fetching data</a>').show();
        //                     }
        //                 });
        //             } else {
        //                 $('#service-suggestions').hide();
        //             }
        //         });
        //     }

        //     // Function to handle service selection (either from input or dropdown)
        //     window.selectService = function (serviceName) {
        //         $('#lead_service_type').val(serviceName);
        //         $('#service-suggestions').hide();

        //         // Now, let's fetch the related services based on the selected service
        //         fetchServicesOnSubmit(serviceName);
        //     };

        //     function fetchServicesOnSubmit(serviceType) {
        //         if (serviceType.trim() !== '') {
        //             $.ajax({
        //                 url: "{{ route('search.service') }}",
        //                 method: 'GET',
        //                 data: { service: serviceType },
        //                 success: function (data) {
        //                     let serviceTypeName = data[0]?.name || serviceType;
        //                     let dynamicContent = '';
            
        //                     if (data.length > 0) {
        //                         dynamicContent += `
        //                             <div class="row">
        //                                 <div class="col-12 text-center">
        //                                     <!-- Display service type image -->
        //                                     <div class="image-container">
        //                                         <img src="${data[0]?.image_url}" alt="${serviceTypeName}" class="img-fluid" style="width: 60%; height:200px; border-radius: 10px;">
        //                                     </div>
        //                                     <h2 class="fs-title mt-3">What are your ${serviceTypeName} needs?</h2>
        //                                 </div>
        //                             </div>`;
            
        //                         data.forEach(function (item) {
        //                             if (item.services && item.services.length > 0) {
        //                                 item.services.forEach(function (service) {
        //                                     dynamicContent += `
        //                                         <div class="field-div">
        //                                             <input type="radio" id="service-${service.id}" name="need" value="${service.name}" required>
        //                                             <label for="service-${service.id}">${service.name}</label>
        //                                             <input type="hidden" name="service_id" value="${service.id}">
        //                                         </div>`;
        //                                 });
        //                             }
        //                         });
        //                     } else {
        //                         dynamicContent = `
        //                             <div class="field-div">
        //                                 <p>No services found for "${serviceType}".</p>
        //                             </div>`;
        //                     }
            
        //                     $('#dynamic-services').html(dynamicContent);
        //                 },
        //                 error: function () {
        //                     $('#dynamic-services').html(`
        //                         <div class="field-div">
        //                             <p>Something went wrong. Please try again later.</p>
        //                         </div>
        //                     `);
        //                 }
        //             });
        //         } else {
        //             alert('Please enter a service to search for.');
        //         }
        //     }
        //     // Function to handle form submission for lead generation
        //     function handleLeadGenerationFormSubmit() {
        //         $('#msform').on('submit', function (e) {
        //             e.preventDefault(); // Prevent the default form submission

        //             // Serialize form data
        //             let formData = $(this).serialize();

        //             // AJAX Request
        //             $.ajax({
        //                 url: "{{ route('lead_genrate') }}",
        //                 method: "POST",
        //                 data: formData,
        //                 beforeSend: function () {
        //                     // Optionally, show a loading indicator here
        //                     $('#submit-button').text('Submitting...').prop('disabled', true);
        //                 },
        //                 success: function (response) {
        //                     // On success, move to step 8 and display success message
        //                     const fieldsets = $('fieldset');
        //                     const currentFieldset = fieldsets.last(); // Assuming step 8 is the last fieldset
        //                     fieldsets.hide(); // Hide all fieldsets
        //                     currentFieldset.show(); // Show the success fieldset

        //                     // Reset the form or perform any additional success handling
        //                     $('#msform')[0].reset();
        //                     $('#submit-button').text('Submit').prop('disabled', false);
        //                 },
        //                 error: function (xhr) {
        //                     // Handle errors (e.g., validation, server issues)
        //                     alert("An error occurred: " + xhr.responseJSON.message || "Unknown error");
        //                     $('#submit-button').text('Submit').prop('disabled', false);
        //                 }
        //             });
        //         });
        //     }

        //     // Function to hide suggestions on outside click
        //     function hideSuggestionsOnClickOutside() {
        //         $(document).click(function (e) {
        //             if (!$(e.target).closest('#service-suggestions, #lead_service_type').length) {
        //                 $('#service-suggestions').hide();
        //             }
        //         });
        //     }

        //     // Function to initialize "Other" radio button functionality
        //     function initializeOtherFunctionality(radioName, inputId) {
        //         const otherRadioButton = document.querySelector(`input[name="${radioName}"][value="Other"]`);
        //         const otherInput = document.getElementById(inputId);
        //         const allRadioButtons = document.querySelectorAll(`input[name="${radioName}"]`);

        //         const handleRadioChange = (event) => {
        //             if (event.target === otherRadioButton) {
        //                 otherInput.style.display = 'inline';
        //                 otherInput.focus();
        //             } else {
        //                 otherInput.style.display = 'none';
        //                 otherInput.value = ''; // Clear input value
        //                 otherRadioButton.value = 'Other'; // Reset the "Other" value
        //             }
        //         };

        //         otherInput.addEventListener('input', function () {
        //             otherRadioButton.value = this.value;
        //         });

        //         allRadioButtons.forEach((radio) => {
        //             radio.addEventListener('change', handleRadioChange);
        //         });
        //     }

        //     // Function to handle slider background changes
        //     function handleSliderBackground() {
        //         const sliders = @json($sliders);
        //         const sliderElement = document.getElementById("slider");
        //         const titleElement = document.getElementById("slider-title");
        //         const descriptionElement = document.getElementById("slider-description");

        //         let currentIndex = 0;

        //         function changeBackground() {
        //             const currentSlider = sliders[currentIndex];
        //             const storageBaseUrl = "{{ asset('storage/') }}";
        //             const imageUrl = `${storageBaseUrl}/${currentSlider.image}`;

        //             sliderElement.style.backgroundImage = `url('${imageUrl}')`;
        //             titleElement.textContent = currentSlider.title || "Default Title";
        //             descriptionElement.textContent = currentSlider.description || "Default Description";

        //             currentIndex = (currentIndex + 1) % sliders.length;
        //         }

        //         setInterval(changeBackground, 3000);
        //         changeBackground(); // Initial load
        //     }
            
        //     // Function to initialize event handlers
        //     function initializeEventHandlers() {
        //         // Handle the form submission for lead generation
        //         handleLeadGenerationFormSubmit();

        //         // Handle closing the form
        //         window.closeForm = closeForm;
        //         // Handle service selection from dropdown
        //         window.handleServiceSelect = handleServiceSelect;
        //     }
        //     // Function to handle the service selection (dropdown click)
        //     function handleServiceSelect(serviceType) {
        //         // Fetch the form data based on the selected service
        //         resetFormContent();
        //         fetchServiceForm(serviceType);
        //     }

        //     // Function to fetch service form data dynamically
        //     function fetchServiceForm(serviceType) {
        //         $.ajax({
        //             url: '/get-service-form-data/' + serviceType,  // The endpoint to get the form data
        //             method: 'GET',
        //             success: function (response) {
        //                 // Inject the received form HTML into the 'dynamic-services' div
        //                 injectFormContent(response.html);

        //                 // Display the form section
        //                 displayFormSection();
        //                 // Scroll to the top after the form is loaded
        //                 scrollToTop();
        //             },
        //             error: function () {
        //                 alert('Something went wrong while fetching the service form. Please try again later.');
        //             }
        //         });
        //     }
        //     // Function to scroll to the top of the page
        //     function scrollToTop() {
        //         window.scrollTo({ top: 0, behavior: 'smooth' });
        //     }
        //     // Function to inject the form HTML content into the page
        //     function injectFormContent(htmlContent) {
        //         // $('#dynamic-services').html(''); // Clear old content
        //         $('#dynamic-services').html(htmlContent);
        //         $('#myForm').show();// Inject new content
        //     }
        //     // Function to show the form section
        //     function displayFormSection() {

        //         var form = document.getElementById("myForm");
        //         form.style.display = "block";
        //         form.classList.add("fade-in");
        //         form.classList.remove("fade-out");

        //         // Show the overlay
        //         var overlay = document.getElementById("overlay");
        //         overlay.style.display = "block";
        //         //$('#myForm').show();  // Assuming '#myForm' is the ID of the form container
        //     }
        //     // Function to reset the form content
        //     function resetFormContent() {
        //         // $('#dynamic-services').html(''); // Clear existing dynamic content
        //         $('#msform')[0].reset(); // Reset the form fields
        //     }
        //     // Function to handle successful form submission
        //     function handleFormSuccess(response) {
        //         const fieldsets = $('fieldset');
        //         const currentFieldset = fieldsets.last(); // Assuming step 8 is the last fieldset
        //         fieldsets.hide(); // Hide all fieldsets
        //         currentFieldset.show(); // Show the success fieldset
        //         $('#msform')[0].reset(); // Optionally reset the form
        //         $('#submit-button').text('Submit').prop('disabled', false);
        //     }
        //     // Function to handle form submission errors
        //     function handleFormError(xhr) {
        //         alert("An error occurred: " + (xhr.responseJSON.message || "Unknown error"));
        //         $('#submit-button').text('Submit').prop('disabled', false);
        //     }
            
        //     // Initialize functions
        //     initializeEventHandlers();
        //     fetchServiceSuggestions();
        //     hideSuggestionsOnClickOutside();
        //     handleLeadGenerationFormSubmit();
        //     initializeOtherFunctionality('business', 'other-business');
        //     initializeOtherFunctionality('industry', 'industry-other');
        //     initializeOtherFunctionality('live_website', 'website-other');
        //     initializeOtherFunctionality('budget', 'budget-other');
        //     initializeOtherFunctionality('hire', 'hire-other');
        //     handleSliderBackground();
        // });