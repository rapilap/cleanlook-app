<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/jpg" href="{{ asset('assets/logo.jpg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <title>Reset password</title>
</head>
<body class="h-screen w-full bg-primary flex items-center justify-center flex-col">
    <h1 class="text-5xl font-medium text-white mb-3">CleanLook</h1>
    <div class="bg-white p-6 rounded-lg shadow-lg w-96 text-center">
        <h4 class="text-lg font-semibold text-gray-800">Reset password</h4>
        <div class="text-start">
            <p class="text-gray-600 mt-2">Email</p>
            <form method="POST" action="/forgot-password" class="">
                @csrf
                <input type="text" name="email" id="email" class="p-3 rounded-lg border border-primary w-full mb-3 hover:border-secondary" placeholder="Masukkan email">
        </div>
        <x-button variant="tertiery" type="submit" class="w-full">Kirim</x-button>
        </form>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger col-md-6 mt-3" style="max-width: 400px">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success col-md-6 mt-3" style="max-width: 400px">
            {{ session('status') }}
        </div>
    @endif

    <p class="mt-4"><a href="/" class="hover:text-secondary">Kembali</a></p>
</body>

</html>
