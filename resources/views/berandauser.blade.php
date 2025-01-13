<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <title>Cleanlook</title>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-green-500 text-white py-4 px-6">
        <img src="{{asset('assets/logo.jpg')}}" alt="Logo" class="h-12 w-12 rounded-full  ">
    </nav>

    <!-- Interactive Text -->
    <div class="text-center mt-4">
        <h2 class="text-lg font-semibold">Halo <span id="user" class="font-bold">user</span>,</h2>
        <p class="text-gray-600"><span id="interactive-text"></span></p>
    </div>

    <!-- Map Section -->
    <div class="bg-gray-300 h-48 mt-4"><script src="https://maps.googleapis.com/maps/api/js?key= SILAHKAN ISI
DENGAN KEY YANG SUDAH ANDA DAPATKAN DARI GOOGLE
&libraries=places"></script> </div>

    <!-- Form Section -->
    <div class="p-6">
        <form action="/pesan" method="POST" class="bg-white p-6 rounded shadow-md">
            @csrf
            <!-- Alamat Input -->
            <div class="mb-4">
                <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                <input type="text" id="alamat" name="alamat" class="w-full border-gray-300 rounded mt-1 focus:ring-green-500 focus:border-green-500">
            </div>

            <!-- Berat Sampah and Type Sampah -->
            <div class="flex space-x-4 mb-4">
                <!-- Berat Sampah -->
                <div class="flex-1">
                    <label for="berat" class="block text-sm font-medium text-gray-700">Berat sampah</label>
                    <input type="number" id="berat" name="berat" class="w-full border-gray-300 rounded mt-1 focus:ring-green-500 focus:border-green-500" placeholder="Max: 50kg">
                </div>

                <!-- Type Sampah -->
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700">Tipe Sampah</label>
                    <div class="mt-2">
                        <label class="block">
                            <input type="radio" name="type_sampah" value="organik" class="mr-2"> Organik
                        </label>
                        <label class="block">
                            <input type="radio" name="type_sampah" value="anorganik" class="mr-2"> Anorganik
                        </label>
                        <label class="block">
                            <input type="radio" name="type_sampah" value="b3" class="mr-2"> B3
                        </label>
                    </div>
                </div>
            </div>

            <!-- Pesan Button -->
            <button type="submit" class="w-full bg-green-500 text-white py-2 rounded text-lg font-semibold hover:bg-green-600">PESAN</button>
        </form>
    </div>

    <!-- About and Contact Section -->
    <div class="p-6 flex justify-between text-sm">
        <div>
            <h3 class="font-bold">Tentang Kami</h3>
            <p>Kami hadir sebagai solusi untuk mengatasi masalah sampah anda. Gunakan Cleanlook kapanpun dan dimanapun kamu mau.</p>
        </div>
        <div>
            <h3 class="font-bold">Contact Us</h3>
            <p>Instagram: <a href="https://instagram.com/cleanlook" class="text-green-500">Cleanlook</a></p>
            <p>WhatsApp: <a href="https://wa.me/xxxxxx" class="text-green-500">xxxxxx</a></p>
        </div>
    </div>
    <div>
    @include('components.navbar.footer_navbar')
    </div>
    <!-- Scripts -->
    <script>
        // Animasi teks interaktif
        const options = {
            strings: ["Sampah apa yang hari ini Anda akan buang?"],
            typeSpeed: 50
        };

        const typed = new Typed("#interactive-text", options);

        // Dinamis nama user
        const user = "{{ Auth::user()->name ?? 'user' }}";
        document.getElementById('user').innerText = user;
    </script>

</body>
</html>
