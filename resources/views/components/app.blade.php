<!-- Contoh di resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>
        @isset($title)
            {{ $title }}
        @else
            Laravel
        @endisset
    </title>
    @vite('resources/css/app.css') <!-- Pastikan Vite digunakan -->
</head>
<body class="flex flex-col {{ $bodyClass ?? '' }}">
    <!-- Navbar -->
    <main class="flex-grow pb-16"> 
        {{ $slot }}
    </main>
    
    <nav class="fixed bottom-0 left-0 w-full bg-white shadow-t z-50 h-16 flex items-center justify-around">
        @include('components.navbar.navbar')
    </nav>
</body>
</html>
