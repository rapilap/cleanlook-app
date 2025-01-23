<x-app_user title="Home">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js"></script>
        <link href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-primary text-white py-4 px-6 flex flex-row justify-between items-center">
        <div class="text-2xl font-bold">Cleanlook</div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <x-button variant='secondary'>Logout</x-button>
        </form>
    </nav>

    <!-- Interactive Text -->
    <div class="text-center mt-4">
        <h2 class="text-lg font-semibold">Halo <span id="user" class="font-bold">user</span>,</h2>
        <p class="text-gray-600"><span id="interactive-text"></span></p>
    </div>

    <!-- Map Section -->
    <div class="bg-gray-300 h-48 mt-4">
        {{-- <div id="map"></div> --}}
        <div id="map" style="width: 100%; height: 95%;"></div>

    </div>

    <!-- Form Section -->
    <div class="p-6">
        <form action="/pesan" method="POST" class="bg-white p-6 rounded shadow-md">
            @csrf
            <!-- Alamat Input -->
            <div class="gap-4 mb-4 flex flex-row">
                <div class="flex-col w-full">
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <input type="text" id="alamat" name="alamat" class="w-full p-2 border border-primary hover:border-secondary rounded mt-1 focus:ring-green-500 focus:border-green-500" placeholder="Masukkan alamat pengambilan">
                </div>
                <div class="flex-col w-full">
                    <label for="landfill" class="block text-sm font-medium text-gray-700">Pilih TPS</label>
                    <select class="select select-bordered w-full max-w-xs">
                        <option disabled selected>Who shot first?</option>
                        <option>Han Solo</option>
                        <option>Greedo</option>
                      </select>
                </div>
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
</x-app_user>

<script>
    mapboxgl.accessToken = '{{ config("services.mapbox.access_token") }}';

    // Inisialisasi Mapbox
    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [107.6191, -6.9175], // Titik pusat awal (Bandung)
        zoom: 10,
    });
</script>
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