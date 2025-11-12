<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | Problem Solving</title>
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
            /* background: linear-gradient(135deg, #062462, #208bee); */
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

        .auth-card h4 {
            color: #fff;
            font-weight: 600;
        }

        .auth-card p {
            color: #fff;
            margin-bottom: 25px;
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
            color: #062462;
        }

        .input-group button:hover {
            color: #062462;
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
    </style>
</head>

<body>
    <div class="auth-wrapper">
        <div class="auth-card" style="background:#062462;">
            <a href="/"><img src="{{ asset('assets/images/logo.png') }}" alt="Logo"></a>
            <p>Sign in to continue to your account</p>

            {{-- Login Form --}}
            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="mb-3 text-start">
                    <label for="email" class="form-label">Email or Username</label>
                    <input type="text" name="email" class="form-control" id="email"
                        placeholder="Enter your email or username" required autofocus>
                </div>

                <div class="mb-3 text-start">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="••••••••" required>
                        <button type="button" id="togglePassword" style="background:#fff;">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label" for="remember" style="color:#fff"> Remember Me </label>
                    </div>
                    <a href="{{ route('password.request') }}" class="small text-primary" style="color:#fff">Forgot Password?</a>
                </div>

                <button type="submit" class="btn btn-primary w-100">Sign In</button>
            </form>

            <div class="divider">Or continue with</div>

            {{-- Social Login --}}
            <div class="social-login">
                <a href="{{ route('register') }}" title="Register"><i class="fas fa-user-plus"></i></a>
                <a href="{{ url('auth/google') }}" title="Login with Google"><i class="fab fa-google"></i></a>
                <a href="{{ url('auth/facebook') }}" title="Login with Facebook"><i class="fab fa-facebook-f"></i></a>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/vendor/jquery-3.6.2.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const password = document.getElementById('password');
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.innerHTML = type === 'password' ?
                '<i class="fas fa-eye"></i>' :
                '<i class="fas fa-eye-slash"></i>';
        });
    </script>
</body>

</html>
