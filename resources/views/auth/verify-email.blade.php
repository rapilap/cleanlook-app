<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/jpg" href="{{ asset('assets/logo.jpg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <title>Verifikasi</title>
</head>
<body class="h-screen w-full bg-primary flex items-center justify-center flex-col">
    <h1 class="text-5xl font-medium text-white mb-3">CleanLook</h1>
    <div class="bg-white p-6 rounded-lg shadow-lg w-96 text-center">
        <h4 class="text-lg font-semibold text-gray-800">Verifikasi Email Diperlukan</h4>
        <p class="text-gray-600 mt-2">Kami telah mengirimkan email verifikasi ke <strong>{{ auth()->user()->email }}</strong>.</p>
        <p class="text-gray-600">Silakan periksa email Anda dan klik tautan verifikasi untuk melanjutkan.</p>
        <form method="POST" action="{{ route('verification.send') }}" class="mt-4">
            @csrf
            <x-button variant="tertiery" type="submit">Kirim Ulang Email Verifikasi</x-button>
        </form>
    </div>
</body>

</html>
