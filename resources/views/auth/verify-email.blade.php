<!DOCTYPE html>
<html>

<head>
    <title>Verifikasi Email</title>
</head>

<body>
    <h1>Verifikasi Email Anda</h1>
    <p>Sebelum melanjutkan, mohon periksa email Anda untuk link verifikasi.</p>
    <form method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit">Kirim Ulang Email Verifikasi</button>
    </form>
    @if (session('message'))
    <div class="alert alert-success" role="alert">
        {{ session('message') }}
    </div>
    @endif
</body>

</html>