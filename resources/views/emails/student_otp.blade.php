<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registration OTP</title>
</head>
<body>
    <h2>Your One-Time Password (OTP)</h2>
    <p>Thank you for registering with us.</p>
    <p>Your OTP code is:</p>

    <h1 style="font-size: 32px; color: #2c5282;">{{ $otp }}</h1>

    <p>This OTP will expire in 10 minutes.</p>
    <p>Do not share it with anyone.</p>

    <p>— {{ config('app.name') }}</p>
</body>
</html>
