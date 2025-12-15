<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register | Problem Solving</title>
    <link rel="icon" href="{{ asset('assets/images/maslyhal.png') }}" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
            margin: 0;
        }

        .auth-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            padding: 20px;
        }

        .auth-card {
            background: #fff;
            border-radius: 16px;
            width: 100%;
            max-width: 420px;
            padding: 40px 30px;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.3);
            text-align: center;
            animation: fadeIn 0.6s ease-in-out;
        }

        .auth-card img {
            height: 55px;
            margin-bottom: 15px;
        }

        .auth-card h4,
        .auth-card p {
            color: #fff;
        }

        .form-label {
            font-weight: 500;
            color: #fff;
            text-align: left;
            display: block;
        }

        .form-control {
            border-radius: 8px;
            padding: 10px 12px;
        }

        .input-group button {
            background: transparent;
            border: none;
            color: #fff;
        }

        .btn-primary {
              background-color: #fff;
            color: #062462;
            border: none;
            border-radius: 8px;
            padding: 10px;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #fff;
            color: #062462;
        }

        .social-login a {
            display: inline-block;
            margin: 0 10px;
            font-size: 18px;
            color: #062462;
            background: #f5f5f5;
            padding: 10px 15px;
            border-radius: 50%;
            transition: 0.3s;
        }

        .social-login a:hover {
            background: #062462;
            color: #fff;
        }

        .divider {
            margin: 25px 0;
            color: #aaa;
            position: relative;
        }

        .divider::before,
        .divider::after {
            content: "";
            position: absolute;
            top: 50%;
            width: 40%;
            height: 1px;
            background: #ccc;
        }

        .divider::before {
            left: 0;
        }

        .divider::after {
            right: 0;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        /* Role */
        .role-select-wrapper {
        display: flex;
        gap: 15px;
        margin: 20px 0;
    }

    .role-card {
        flex: 1;
        padding: 18px;
        border-radius: 12px;
        border: 2px solid #ffffff50;
        text-align: center;
        cursor: pointer;
        background: #ffffff15;
        color: white;
        transition: 0.3s;
        user-select: none;
    }

    .role-card:hover {
        border-color: #fff;
        background: #ffffff25;
    }

    .role-card.active {
        border-color: #00ffbf;
        background: #ffffff35;
        box-shadow: 0 0 12px rgba(0, 255, 191, 0.6);
    }

    .role-card i {
        font-size: 32px;
        margin-bottom: 8px;
        display: block;
    }

    .role-label {
        font-size: 18px;
        font-weight: 600;
    }
    </style>
</head>

<body>
    <div class="auth-wrapper">
        <div class="auth-card" style="background:#062462;">
            <a href="/"><img src="{{ asset('assets/images/logo.png') }}" alt="Logo"></a>
            <p>Create your account to get started</p>

            {{-- Register Form --}}
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
                    {{-- <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="password">Role</label>
                            <select name="roles" class="form-control" required="required">
                                <option disabled selected valüe="">select role</option>
                                @foreach($roles as $role)
                                    <option value="{{$role->name}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                <div class="text-start">
                    <label class="form-label d-block">Select Account Type</label>
                </div>

                <div class="role-select-wrapper">
                    <div class="role-card active" data-role="customer">
                        <i class="fas fa-user"></i>
                        <div class="role-label">Customer</div>
                        <small>Buy products & order services</small>
                    </div>

                    <div class="role-card" data-role="seller">
                        <i class="fas fa-store"></i>
                        <div class="role-label">Seller</div>
                        <small>Sell your services & products</small>
                    </div>
                </div>

                <!-- Hidden Field for Submission -->
                <input type="hidden" id="roleInput" name="roles" value="customer">

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

            <div class="divider">Or continue with</div>

            {{-- Social Login --}}
            <div class="social-login">
                <a href="{{ route('login') }}" title="Already have account"><i class="fas fa-sign-in-alt"></i></a>
                <a href="{{ url('auth/google') }}" title="Login with Google"><i class="fab fa-google"></i></a>
                <a href="{{ url('auth/facebook') }}" title="Login with Facebook"><i class="fab fa-facebook-f"></i></a>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/vendor/jquery-3.6.2.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
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
    <script>
        // Example: States and Cities data
        const data = {
            Pakistan: {
                Sindh: ["Karachi", "Hyderabad", "Sukkur"],
                Punjab: ["Lahore", "Faisalabad", "Multan"],
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
    <script>
        const roleCards = document.querySelectorAll(".role-card");
        const roleInput = document.getElementById("roleInput");

        roleCards.forEach(card => {
            card.addEventListener("click", function () {

                roleCards.forEach(c => c.classList.remove("active"));

                this.classList.add("active");

                let selectedRole = this.getAttribute("data-role");

                roleInput.value = selectedRole;
            });
        });
    </script>

</body>

</html>
