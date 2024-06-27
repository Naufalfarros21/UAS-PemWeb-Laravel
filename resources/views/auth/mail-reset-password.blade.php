<!DOCTYPE html>
<html>

<head>
    <title>Reset Password</title>
</head>

<body>
    <h2>Reset Password Request</h2>
    <p>Click the link below to reset your password:</p>
    <a href="{{ route('validasi-forgot-password', $token) }}">Reset Password</a>
</body>

</html>