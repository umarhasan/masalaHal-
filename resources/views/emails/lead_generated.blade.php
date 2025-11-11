<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lead Generated</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #007BFF; /* Update to Quick Solutions theme color */
            font-size: 24px;
            text-align: center;
        }
        h3 {
            color: #333;
            font-size: 20px;
            margin-top: 20px;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 20px;
        }
        ul {
            padding-left: 20px;
            font-size: 16px;
            line-height: 1.6;
        }
        li {
            margin-bottom: 10px;
        }
        .info {
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 5px;
        }
        .footer {
            font-size: 14px;
            text-align: center;
            color: #888;
            margin-top: 40px;
        }
        .cta-button {
            display: inline-block;
            background-color: #007BFF; /* Quick Solutions theme color */
            color: #fff;
            padding: 10px 20px;
            font-size: 16px;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            margin-top: 20px;
        }
        .cta-button:hover {
            background-color: #0056b3; /* Darker shade of theme color */
        }
        .logo {
            display: block;
            margin: 0 auto;
            max-width: 200px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Company Logo -->
        <img src="{{ asset('assets/images/logohere.png') }}" alt="Quick Solutions Logo" class="logo"> <!-- Replace with the actual logo URL -->

        <h1>Hello {{ $userName }},</h1>

        <p>Thank you for registering with us. Your lead has been successfully generated and is now being processed.</p>

        <h3>Your Lead Details:</h3>
        <div class="info">
            <ul>
                <li><strong>Name:</strong> {{ $leadData['name'] }}</li>
                <li><strong>Phone:</strong> {{ $leadData['phone'] }}</li>
                <li><strong>Email:</strong> {{ $leadData['email'] ?? 'Not Provided' }}</li>
                <li><strong>Country:</strong> {{ $leadData['country'] }}</li>
                <li><strong>City:</strong> {{ $leadData['city'] }}</li>
                <li><strong>State:</strong> {{ $leadData['state'] }}</li>
            </ul>
        </div>

        <h3>Your Account Information:</h3>
        <div class="info">
            <p><strong>Email:</strong> {{ $userEmail }}</p>
            <p><strong>Password:</strong> {{ $password }}</p>
        </div>

        <p>To manage your leads, please log in using the button below:</p>
        <a href="{{ route('login') }}" class="cta-button">Login to Your Account</a>

        <p>If you have any questions, feel free to contact us at any time.</p>

        <p>Best regards,<br> The Quick Solutions Team</p>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Quick Solutions. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
