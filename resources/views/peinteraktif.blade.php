<title>Peta Kurir</title>
    @vite('resources/css/app.css')
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&libraries=places"></script>
</head>
<body class="bg-gray-100">
<div class="h-screen flex flex-col">
        <!-- Peta -->
        <div id="map" class="flex-1"></div>

        <!-- Informasi Kurir -->
        <div class="bg-green-500 p-4 text-white">
            <h2 class="text-xl font-bold">SELECT LOCATION</h2>
            <div class="bg-white text-black p-4 rounded-md mt-2">
                <div>
                    <strong>From:</strong>
                    <p id="from-address" class="text-sm">-</p>
                </div>
                <div class="mt-2">
                    <strong>To:</strong>
                    <p id="to-address" class="text-sm">-</p>
                </div>
            </div>
        </div>
        
</body>