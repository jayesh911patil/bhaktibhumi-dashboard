<!DOCTYPE html>
<html>
<head>
    <title>Partner Account Approved</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            background: #ffffff;
            margin: 40px auto;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.1);
            border: 1px solid #e5e5e5;
        }
        .header {
            background-color: #bf4040;
            color: #ffffff;
            text-align: center;
            padding: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 22px;
        }
        .content {
            padding: 25px;
            color: #333333;
            line-height: 1.6;
        }
        .content h2 {
            color: #bf4040;
            margin-bottom: 15px;
        }
        .details {
            background: #f9eaea;
            border: 1px solid #bf4040;
            border-radius: 6px;
            padding: 15px;
            margin: 20px 0;
        }
        .details li {
            margin: 8px 0;
        }
        .btn {
            display: inline-block;
            background: #bf4040;
            color: #ffffff !important;
            padding: 12px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 10px;
        }
        .footer {
            text-align: center;
            padding: 15px;
            font-size: 13px;
            color: #888888;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>🎉 Partner Account Approved</h1>
        </div>

        <!-- Body -->
        <div class="content">
            <p>Dear <strong>{{ $name }}</strong>,</p>

            <p>Your partner account has been <strong style="color:#bf4040;">approved successfully</strong>! 🎊</p>

            <h2>Your Login Details:</h2>
            <ul class="details">
                <li><strong>Email:</strong> {{ $email }}</li>
                <li><strong>Password:</strong> {{ $password }}</li>
            </ul>

            <p>You can now log in to your account and get started.</p>

            <p style="text-align:center;">
                <a href="{{ url('/') }}" class="btn">Login Now</a>
            </p>

            <p>Best Regards,<br><strong>Admin Team</strong></p>
        </div>

        <!-- Footer -->
        <div class="footer">
            © {{ date('Y') }} Your Company. All Rights Reserved.
        </div>
    </div>
</body>
</html>
