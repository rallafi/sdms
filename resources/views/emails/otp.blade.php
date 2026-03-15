<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>OTP Code</title>
</head>
<body>
    <h2>Hello {{ $userName }},</h2>

    <p>Your OTP code for Secure Document Management System is:</p>

    <h1 style="letter-spacing: 4px;">{{ $otpCode }}</h1>

    <p>This OTP will expire in 5 minutes.</p>

    <p>Thank you,<br>SDMS</p>
</body>
</html>