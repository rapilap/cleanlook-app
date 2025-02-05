<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Akun Kurir</title>
</head>
<body>
    <h1>Selamat, {{ $courier->name }}!</h1>
    <p>Akun kurir Anda telah dibuat oleh admin. Berikut adalah informasi akun Anda:</p>
    <ul>
        <li><strong>Email:</strong> {{ $courier->email }}</li>
        <li><strong>Password:</strong> {{ $password }}</li>
    </ul>
    <p>Harap login dan ubah password Anda segera setelah login.</p>
    <p>Terima kasih.</p>
</body>
</html>
