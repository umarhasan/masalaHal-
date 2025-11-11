<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Register | Quick Solutions</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="./assets/images/q.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="../assets/vendor/css/pages/page-auth.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
    <?php $roles = DB::table('roles')->get(); ?>

</head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        {{-- <div class="authentication-inner"> --}}
          <!-- Register Card -->
          <div class="card" style="min-width:40%">
            <div class="card-body">
                <a href="javascript:history.back()" class="btn btn-primary" style="position: absolute;right: 20px;">
                    <i class="fas fa-arrow-left"></i> Back
                </a></br></br>
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <span class="app-brand-text  fw-bolder">
                    <center><img src="{{ asset('assets/images/logo.png') }}" class="logo1" style="width:100%;"/></center>
                  </span>
              </div>
              <!-- /Logo -->
             <center><h4 class="mb-2">Quick Solutions Register 🚀</h4></center>
              <p class="mb-4">Make your app management easy and fun!</p>

              <form id="formAuthentication" class="mb-3" action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" class="form-control"
                    id="username" name="name" value="{{ old('name') }}" placeholder="Enter your username" autofocus
                  />
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control" @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" />
                </div>
                <div class="field-div">
                    <label class="form-label" for="Country">Country</label>
                    <select class="input-text form-control" name="country" id="country" onchange="loadStates(this.value)">
                        <option value="">Select Your Country</option>
                        <option value="Pakistan">Pakistan</option>
                        <option value="India">India</option>
                        <option value="United States">United States</option>
                        <option value="Canada">Canada</option>
                        <!-- Add more countries as needed -->
                    </select>
                </div>

                <div class="field-div">
                    <label class="form-label" for="State">State</label>
                    <select class="input-text form-control" name="state" id="state" onchange="loadCities(this.value)">
                        <option value="">Select Your State</option>
                        <!-- States will be dynamically loaded based on selected country -->
                    </select>
                </div>

                <div class="field-div">
                    <label class="form-label" for="Cite">City</label>
                    <select class="input-text form-control" name="city" id="city">
                        <option value="">Select Your City</option>
                        <!-- Cities will be dynamically loaded based on selected state -->
                    </select>
                </div>
                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password">Password</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      @error('password') is-invalid @enderror" type="password" name="password"
                      required
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>

                <div class="mb-3 form-password-toggle">
                    <label class="form-label" for="password">Confirm Password</label>
                    <div class="input-group input-group-merge">
                      <input
                        type="password"
                        id="confirm-password"
                        class="form-control"
                        @error('confirm-password') is-invalid @enderror" type="password" name="confirm-password"
                        required
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="password"
                      />
                      <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label class="form-label" for="password">Role</label>
                        <select name="roles" class="form-control" required="required">
                            <option disabled selected valüe="">select role</option>
                            @foreach($roles as $role)

                            <option value="{{$role->name}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                    <label class="form-check-label" for="terms-conditions">
                      I agree to
                      <a href="javascript:void(0);">privacy policy & terms</a>
                    </label>
                  </div>
                </div>
                <button class="btn btn-primary d-grid w-100">Sign up</button>

              </form>

              <p class="text-center">
                <span>Already have an account?</span>
                <a href="{{ route('login') }}">
                  <span>Sign in instead</span>
                </a>
              </p>
            </div>
          </div>
          <!-- Register Card -->
        {{-- </div> --}}
      </div>
    </div>

    <!-- / Content -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->
    <!-- Vendors JS -->
    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>
    <!-- Page JS -->
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    {{-- <script>
        $(document).ready(function () {
            // Load countries
            $.getJSON('/json/countries', function (countries) {
                countries.forEach(country => {
                    $('#country').append(`<option value="${country.id}" data-name="${country.name}">${country.name}</option>`);
                });
            });

            // Load states based on selected country
            $('#country').change(function () {
                const countryId = $(this).val();
                const countryName = $('#country option:selected').data('name');

                // Set country name in hidden input
                $('#country_name').val(countryName);

                $.getJSON('/json/states', function (states) {
                    const filteredStates = states.filter(state => state.country_id == countryId);
                    $('#state').html('<option value="" disabled selected>Select State</option>');
                    filteredStates.forEach(state => {
                        $('#state').append(`<option value="${state.id}" data-name="${state.name}">${state.name}</option>`);
                    });
                });

                // Clear state and city selections when country changes
                $('#state_name').val('');
                $('#city_name').val('');
                $('#state').html('<option value="" disabled selected>Select State</option>');
                $('#city').html('<option value="" disabled selected>Select City</option>');
            });

            // Load cities based on selected state
            $('#state').change(function () {
                const stateId = $(this).val();
                const stateName = $('#state option:selected').data('name');

                // Set state name in hidden input
                $('#state_name').val(stateName);

                $.getJSON('/json/cities', function (cities) {
                    const filteredCities = cities.filter(city => city.state_id == stateId);
                    $('#city').html('<option value="" disabled selected>Select City</option>');
                    filteredCities.forEach(city => {
                        $('#city').append(`<option value="${city.id}" data-name="${city.name}">${city.name}</option>`);
                    });
                });

                // Clear city selection when state changes
                $('#city_name').val('');
            });

            // Set city name in hidden input on change
            $('#city').change(function () {
                const cityName = $('#city option:selected').data('name');
                $('#city_name').val(cityName);
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            @if (session('success'))
                toastr.success("{{ session('success') }}");
            @endif

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    toastr.error("{{ $error }}");
                @endforeach
            @endif
        });
    </script> --}}
    <script>
        // Example: States and Cities data
const data = {
    Pakistan: {
        Punjab: ["Lahore", "Faisalabad", "Multan"],
        Sindh: ["Karachi", "Hyderabad", "Sukkur"],
        Balochistan: ["Quetta", "Gwadar"],
    },
    India: {
        Maharashtra: ["Mumbai", "Pune", "Nagpur"],
        Delhi: ["New Delhi", "South Delhi"],
        Gujarat: ["Ahmedabad", "Surat"],
    },
    "United States": {
        California: ["Los Angeles", "San Francisco", "San Diego"],
        Texas: ["Houston", "Dallas", "Austin"],
        Florida: ["Miami", "Orlando", "Tampa"],
    },
    Canada: {
        Ontario: ["Toronto", "Ottawa"],
        Quebec: ["Montreal", "Quebec City"],
    },
};

// Load states based on selected country
function loadStates(country) {
    const stateSelect = document.getElementById("state");
    const citySelect = document.getElementById("city");

    // Clear existing options
    stateSelect.innerHTML = '<option value="">Select Your State</option>';
    citySelect.innerHTML = '<option value="">Select Your City</option>';

    if (country && data[country]) {
        const states = Object.keys(data[country]);
        states.forEach((state) => {
            const option = document.createElement("option");
            option.value = state;
            option.textContent = state;
            stateSelect.appendChild(option);
        });
    }
}

// Load cities based on selected state
function loadCities(state) {
    const country = document.getElementById("country").value;
    const citySelect = document.getElementById("city");

    // Clear existing options
    citySelect.innerHTML = '<option value="">Select Your City</option>';

    if (country && data[country] && data[country][state]) {
        const cities = data[country][state];
        cities.forEach((city) => {
            const option = document.createElement("option");
            option.value = city;
            option.textContent = city;
            citySelect.appendChild(option);
        });
    }
}
    </script>
  </body>
</html>

