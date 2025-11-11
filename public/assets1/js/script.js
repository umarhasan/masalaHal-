function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}


$('.testimonial').owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    autoplay: true,
    navText: ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 1
        },
        1000: {
            items: 1
        }
    }
});

$('.owl-slider').owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    autoplay: true,
    navText: ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 1
        },
        1000: {
            items: 3
        }
    }
});

$('.your-class').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    infinite: true,
    responsive: [{
            breakpoint: 2400,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 4,
            }
        },
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }

    ]
});

AOS.init({ once: true });



var currentStep = 1;
var userSelections = {};
var formData = {
    propertyType: '',
    cleaningFrequency: '',
    bedrooms: '',
    bathrooms: '',
    receptionRooms: '',
    hireDecision: '',
    name: '',
    phone: '',
    email: '',
    zip: '',
    address: '',
    city: '', // New field
    state: '', // New field
    country: '',
    contact: '',

};
var formSubmitted = false;

$(document).ready(function() {
    showStep(currentStep);

    $(".next").click(function() {
        if (validate(currentStep)) {
            if (currentStep === 1) {
                userSelections.propertyType = formData.propertyType;
                userSelections.cleaningFrequency = formData.cleaningFrequency;
                userSelections.bedrooms = formData.bedrooms;
                userSelections.bathrooms = formData.bathrooms;
                userSelections.receptionRooms = formData.receptionRooms;
                userSelections.hireDecision = formData.hireDecision;
                userSelections.name = formData.name;
                userSelections.phone = formData.phone;
                userSelections.email = formData.email;
                userSelections.zip = formData.zip;
                userSelections.address = formData.address;
            }
            currentStep++;
            showStep(currentStep);
        }
    });

    $(".previous").click(function() {
        currentStep--;
        showStep(currentStep);

        if (currentStep === 1) {
            formData.propertyType = userSelections.propertyType;
            formData.cleaningFrequency = userSelections.cleaningFrequency;
            formData.bedrooms = userSelections.bedrooms;
            formData.bathrooms = userSelections.bathrooms;
            formData.receptionRooms = userSelections.receptionRooms;
            formData.hireDecision = userSelections.hireDecision;
            formData.name = userSelections.name;
            formData.phone = userSelections.phone;
            formData.email = userSelections.email;
            formData.zip = userSelections.zip;
            formData.address = userSelections.address;
        }
    });
});


function validate(step) {
    var valid = true;
    if (step === 1) {
        formData.propertyType = $("input[name='need']:checked").val();
        if (!formData.propertyType) {
            valid = false;
            $("#age-error").text("Please select an option.");
        } else {
            $("#age-error").text("");
        }
    } else if (step === 2) {
        formData.cleaningFrequency = $("input[name='business']:checked").val();
        if (!formData.cleaningFrequency) {
            valid = false;
            $("#daily-error").text("Please select an option.");
        } else {
            $("#daily-error").text("");
        }
    } else if (step === 3) {
        formData.bedrooms = $("input[name='industry']:checked").val();
        if (!formData.bedrooms) {
            valid = false;
            $("#bed-error").text("Please select an option.");
        } else {
            $("#bed-error").text("");
        }
    } else if (step === 4) {
        formData.bathrooms = $("input[name='live_website']:checked").val();
        if (!formData.bathrooms) {
            valid = false;
            $("#bath-error").text("Please select an option.");
        } else {
            $("#bath-error").text("");
        }
    } else if (step === 5) {
        formData.receptionRooms = $("input[name='budget']:checked").val();
        if (!formData.receptionRooms) {
            valid = false;
            $("#rec-error").text("Please select an option.");
        } else {
            $("#rec-error").text("");
        }
    } else if (step === 6) {
        formData.hireDecision = $("input[name='hire']:checked").val();
        if (!formData.hireDecision) {
            valid = false;
            $("#hire-error").text("Please select an option.");
        } else {
            $("#hire-error").text("");
        }
    } else if (step === 7) {
    // Fetch the content from the textarea
    formData.contact = $("textarea[name='contact']").val(); // Correct selector

    // Check if the textarea is using a WYSIWYG editor like Summernote
    if ($('#summernote').length) {
        formData.contact = $('#summernote').summernote('code'); // Fetch the editor's content
    }

    // Trim the content and validate
    if (!formData.contact || !formData.contact.trim() || formData.contact === '<p><br></p>') {
        valid = false;
        $("#name-error").text("Please fill all fields.");
    } else {
        $("#name-error").text("");
    }

    // Debug to ensure the value is fetched
    console.log("Contact value:", formData.contact);
    } else if (step === 8) {
        formData.name = $("input[name='name']").val();
        if (!formData.name) {
            valid = false;
            $("#name-error").text("Please fill all fields.");
        } else {
            $("#name-error").text("");
        }
        formData.phone = $("input[name='phone']").val();
        if (!formData.phone) {
            valid = false;
            $("#name-error").text("Please fill all fields.");
        } else {
            $("#name-error").text("");
        }
        formData.email = $("input[name='email']").val();
        if (!formData.email) {
            valid = false;
            $("#name-error").text("Please fill all fields.");
        } else {
            $("#name-error").text("");
        }
        formData.zip = $("input[name='zip']").val();
        if (!formData.zip) {
            valid = false;
            $("#name-error").text("Please fill all fields.");
        } else {
            $("#name-error").text("");
        }
        formData.address = $("textarea").val();
        if (!formData.address) {
            valid = false;
            $("#name-error").text("Please fill all fields.");
        } else {
            $("#name-error").text("");
        }
        // Validate new fields
        formData.city = $("input[name='city']").val();
        if (!formData.city) {
            valid = false;
            $("#name-error").text("Please enter your city.");
        } else {
            $("#name-error").text("");
        }

        formData.state = $("input[name='state']").val();
        if (!formData.state) {
            valid = false;
            $("#name-error").text("Please enter your state/province.");
        } else {
            $("#name-error").text("");
        }

        formData.country = $("input[name='country']").val();
        if (!formData.country) {
            valid = false;
            $("#name-error").text("Please enter your country.");
        } else {
            $("#name-error").text("");
        }

    }
    return valid;
}

function showStep(step) {
    var fieldsets = $("fieldset");
    fieldsets.hide();
    fieldsets.eq(step - 1).show();
    setProgressBar(step);

    // Repopulate the form fields based on the stored data
    if (formData.propertyType) {
        $("input[name='age'][value='" + formData.propertyType + "']").prop("checked", true);
    }
    if (formData.cleaningFrequency) {
        $("input[name='daily'][value='" + formData.cleaningFrequency + "']").prop("checked", true);
    }
    if (formData.bedrooms) {
        $("input[name='0bedroom'][value='" + formData.bedrooms + "']").prop("checked", true);
    }
    if (formData.bathrooms) {
        $("input[name='1bathroom'][value='" + formData.bathrooms + "']").prop("checked", true);
    }
    if (formData.receptionRooms) {
        $("input[name='rec0'][value='" + formData.receptionRooms + "']").prop("checked", true);
    }
    if (formData.hireDecision) {
        $("input[name='hire'][value='" + formData.hireDecision + "']").prop("checked", true);
    }

    // Repopulate the input text and textarea fields
    $("input[name='Name']").val(userSelections.name);
    $("input[name='Phone']").val(userSelections.phone);
    $("input[name='Email']").val(userSelections.email);
    $("input[name='Zip']").val(userSelections.zip);
    // $("textarea").val(userSelections.address);
    // Repopulate new fields
    $("input[name='city']").val(formData.city);
    $("input[name='state']").val(formData.state);
    $("input[name='country']").val(formData.country);
    if (step === 9) {

        setTimeout(function() {
            location.reload();
        }, 3000);
    }
}

function setProgressBar(step) {
    var percent = (step - 1) / ($("fieldset").length - 1) * 100;
    $(".progress-bar").css("width", percent + "%");
}

function openForm() {
    var form = document.getElementById("myForm");
    form.style.display = "block";
    form.classList.add("fade-in");
    form.classList.remove("fade-out");

    // Show the overlay
    var overlay = document.getElementById("overlay");
    overlay.style.display = "block";
}

// Function to close the form and overlay
function closeForm() {
    var form = document.getElementById("myForm");
    form.classList.add("fade-out");
    form.classList.remove("fade-in");

    // Hide the overlay
    var overlay = document.getElementById("overlay");
    overlay.style.display = "none";

    // Reset form fields and errors
    $("input[type='radio']").prop("checked", false);
    $(".error-message").text("");
    currentStep = 1;
    showStep(currentStep);
}

$("#submit-button").click(function() {
    formSubmitted = true;
});

$(".cancel").click(function() {
    if (!formSubmitted) {
        $("#confirmation-popup").show();
        // Show the overlay
        var overlay = document.getElementById("overlay");
        overlay.style.display = "block";
    }
});
// When the "quit" button in the confirmation popup is clicked
$("#quit-button").click(function() {
    closeForm(); // Close the form
    if (!formSubmitted) {
        $("#confirmation-popup").hide(); // Hide the confirmation popup
    }
});

// When the "continue" button in the confirmation popup is clicked
$("#continue-button").click(function() {
    $("#confirmation-popup").hide(); // Hide the confirmation popup
    openForm(); // Open the form again at the previous step
});

var form = document.getElementById('myForm-search');

// Add a submit event listener to the form
form.addEventListener('submit', function(event) {
    // Prevent the form from actually submitting
    event.preventDefault();
    openForm();
});