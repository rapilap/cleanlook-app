<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css" rel="stylesheet" />
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.2.0/mapbox-gl-directions.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.2.0/mapbox-gl-directions.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- midtrans --}}
    <script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="{{ config('midtrans.clientKey') }}"></script>
</head>

<x-app_user title="Home">

    <body class="bg-gray-100">

        <!-- Navbar -->
        <nav class="bg-primary py-4 px-6 flex justify-between">
            <div class="flex items-center">
                <div class="text-2xl font-bold">Cleanlook</div>
            </div>
            <div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-secondary hover:bg-green-300 duration-700 text-white text-sm font-medium py-2 px-4 rounded">Logout</button>
                </form>
            </div>
        </nav>

        <!-- Interactive Text -->
        <div class="text-center mt-4">
            <h2 class="text-lg md:text-xl font-semibold">
                Halo <span id="user" class="font-bold">user</span>,
            </h2>
            <p class="text-gray-600"><span id="interactive-text"></span></p>
        </div>

        <!-- Map Section -->
        <div class="bg-white h-64 sm:h-96">
            <div name="geolocate" id="geolocate" class="w-fit"></div>
            &ensp;
            <div name="map" id="map" class="w-full h-full"></div>
        </div>

        <!-- Form Section -->
        <div class="p-4 md:p-6">
            <form action="{{ route('user.payment') }}" method="POST" class="bg-white p-4 md:p-6 rounded shadow-md">
                @csrf
                <!-- Alamat Input -->
                <div class="gap-4 mb-4 grid grid-cols-1 md:grid-cols-2">
                    <div class="flex-col w-full">
                        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <input type="text" id="alamat" name="alamat" class="w-full p-2 border border-primary hover:border-secondary rounded mt-1 focus:ring-green-500 focus:border-green-500" placeholder="Masukkan alamat pengambilan">
                        <ul id="autocomplete-list" class="absolute bg-white border border-gray-300 rounded w-fit z-10"></ul>
                    </div>
                    <div class="flex-col w-full">
                        <label for="landfill" class="block text-sm font-medium text-gray-700">Pilih TPS</label>
                        <select id="landfill" name="landfill" class="w-full p-2 border border-primary hover:border-secondary rounded mt-1 focus:ring-green-500 focus:border-green-500">
                            <option disabled selected>Pilih TPS</option>
                        </select>
                    </div>
                </div>

                <!-- Berat Sampah and Type Sampah -->
                <div class="grid gap-4 mb-4 grid-cols-1 lg:grid-cols-3">
                    <!-- Berat Sampah -->
                    <div>
                        <label for="berat" class="block text-sm font-medium text-gray-700">Berat sampah</label>
                        <input type="number" id="berat" name="berat" class="w-full p-2 border border-primary hover:border-secondary rounded mt-1 focus:ring-green-500 focus:border-green-500" placeholder="Max: 50kg">
                    </div>

                    <!-- Type Sampah -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tipe Sampah</label>
                        <div class="mt-2">
                            <label class="block">
                                <input type="radio" name="type_sampah" value="organik" class="radio mr-2"/> Organik
                            </label>
                            <label class="block">
                                <input type="radio" name="type_sampah" value="anorganik" class="radio mr-2"/> Anorganik
                            </label>
                            <label class="block">
                                <input type="radio" name="type_sampah" value="b3" class="radio mr-2"/> B3
                            </label>
                        </div>
                    </div>

                    <!-- Total Price -->
                    <input type="hidden" id="price" name="price" value="0">
                    <div class="text-2xl rounded-lg p-2 border border-primary hover:border-secondary flex flex-col justify-between">
                        <div>Total:</div>
                        <span id="total" class="text-5xl font-bold items-end h-full">Rp. 0</span>
                    </div>
                </div>

                <!-- Pesan Button -->
                <button type="submit" id="pay-button" class="w-full bg-green-500 text-white py-2 rounded text-lg font-semibold hover:bg-green-600">PESAN</button>
            </form>
        </div>

        <!-- About and Contact Section -->
        <div class="p-6 flex flex-col md:flex-row justify-between text-sm gap-4">
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
    </body>
</x-app_user>

<script>
    mapboxgl.accessToken = '{{ config("services.mapbox.access_token") }}';

    // Inisialisasi Mapbox
    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [107.6191, -6.9175],
        zoom: 10,
    });

    // Tambahkan kontrol Directions API ke peta
    const directions = new MapboxDirections({
        accessToken: mapboxgl.accessToken,
        unit: 'metric',
        profile: 'mapbox/driving',
    });
    map.addControl(directions, 'bottom-right');

    // Menambahkan kontrol Geolokasi
    const geolocateControl = new mapboxgl.GeolocateControl({
        positionOptions: {
            enableHighAccuracy: true,
        },
        trackUserLocation: true,
        showUserHeading: true,
    });
    map.addControl(geolocateControl);

    // Trigger tombol "Find My Location" saat peta dimuat
    map.on('load', () => {
        geolocateControl.trigger();
    });

    let marker = null;

    // Fungsi reverse geocoding untuk mendapatkan alamat dari koordinat
    function reverseGeocode(lng, lat) {
        // console.log(`Reverse geocoding for coordinates: ${lng}, ${lat}`);
        const geocodingUrl = `https://api.mapbox.com/geocoding/v5/mapbox.places/${lng},${lat}.json?access_token=${mapboxgl.accessToken}`;

        fetch(geocodingUrl)
            .then((response) => response.json())
            .then((data) => {
                if (data.features && data.features.length > 0) {
                    const address = data.features[0].place_name;
                    // console.log('Reverse geocoded address:', address);
                    document.getElementById('alamat').value = address;
                }
            })
            .catch((error) => console.error('Error reverse geocoding:', error));
    }

    // Event listener untuk menambahkan marker saat peta diklik
    map.on('click', (event) => {
        const { lng, lat } = event.lngLat;

        // console.log('Map clicked at:', lng, lat);

        // Jika marker sudah ada, perbarui posisinya
        if (marker) {
            marker.setLngLat([lng, lat]);
        } else {
            // Jika belum ada marker, buat marker baru
            marker = new mapboxgl.Marker().setLngLat([lng, lat]).addTo(map);
        }

        // Panggil fungsi untuk mendapatkan TPS terdekat
        fetchNearbyLandfills(lng, lat);

        // Reverse geocoding untuk alamat
        reverseGeocode(lng, lat);
    });

    // Fungsi untuk mendapatkan TPS terdekat berdasarkan koordinat
    function fetchNearbyLandfills(lng, lat) {
        // console.log('Fetching nearby landfills for coordinates:', lng, lat);
        const url = `/home/nearby?longitude=${lng}&latitude=${lat}`;

        fetch(url)
            .then((response) => response.json())
            .then((landfills) => {
                // console.log('Nearby landfills:', landfills);
                const landfillSelect = document.getElementById('landfill');

                // Bersihkan opsi sebelumnya
                landfillSelect.innerHTML = '<option disabled selected>Pilih TPS</option>';

                // Tambahkan opsi TPS terdekat
                landfills.forEach((landfill) => {
                    const option = document.createElement('option');
                    option.value = landfill.id;
                    option.textContent = `${landfill.name} - ${landfill.distance.toFixed(2)} km`;
                    option.dataset.distance = landfill.distance;
                    landfillSelect.appendChild(option);
                });
            })
            .catch((error) => console.error('Error fetching nearby landfills:', error));
    }

    let selectedTPS = null;

    // Saat TPS dipilih dari dropdown
    document.getElementById('landfill').addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        if (!selectedOption || selectedOption.value === '') return;

        const landfillId = selectedOption.value;
        // console.log('Selected landfill ID:', landfillId);

        // Ambil data TPS berdasarkan ID
        fetch(`/home/nearby/${landfillId}`)
            .then((response) => response.json())
            .then((landfill) => {
                // console.log('Fetched TPS data:', landfill);

                const { latitude, longitude, name } = landfill;

                // Arahkan peta ke lokasi TPS
                map.flyTo({
                    center: [longitude, latitude],
                    zoom: 14,
                });

                // Atur rute dari lokasi marker ke TPS
                if (marker) {
                    const markerPosition = marker.getLngLat();
                    directions.setOrigin([markerPosition.lng, markerPosition.lat]); // Lokasi marker
                    directions.setDestination([longitude, latitude]); // Lokasi TPS
                } else {
                    alert('Tentukan titik jemput terlebih dahulu dengan mengklik peta.');
                }

                selectedTPS = {
                    id: selectedOption.value,
                    distance: selectedOption.dataset.distance, // Ambil distance dari atribut dataset
                };

                // console.log('TPS Terpilih:', selectedTPS);

                updateTotal(); // Perbarui total harga
            })
            .catch((error) => console.error('Error fetching landfill data:', error));
    });

    document.getElementById('berat').addEventListener('input', updateTotal);
    document.querySelectorAll('input[name="type_sampah"]').forEach((radio) => {
        radio.addEventListener('change', updateTotal);
    });

    const categories = [
        { cat_name: "organik", cat_price: 3000 },
        { cat_name: "anorganik", cat_price: 4000 },
        { cat_name: "b3", cat_price: 5000 },
    ];

    function updateTotal() {
        const berat = parseFloat(document.getElementById('berat').value) || 0;
        const selectedType = document.querySelector('input[name="type_sampah"]:checked')?.value;

        // console.log('Selected Type:', selectedType);
        // console.log('Selected TPS:', selectedTPS);

        // Pastikan TPS sudah dipilih
        if (!selectedTPS || !selectedType) {
            console.warn('TPS atau tipe sampah belum dipilih.');
            document.getElementById('total').textContent = 'Rp. 0';
            return;
        }

        // Pastikan distance memiliki nilai numerik
        const distance = parseFloat(selectedTPS.distance);
        if (isNaN(distance)) {
            console.error('Distance tidak valid:', selectedTPS.distance);
            document.getElementById('total').textContent = 'Rp. 0';
            return;
        }

        // Cari kategori berdasarkan tipe sampah
        const category = categories.find((cat) => cat.cat_name === selectedType);

        // console.log('Category:', category);

        const categoryPrice = category ? category.cat_price : 0; // Jika tidak ditemukan, default 0

        // Hitung biaya
        const distanceCost = distance * 5000; // Biaya per km
        const weightCost = berat * categoryPrice; // Biaya per kg

        const totalPrice = Math.ceil(distanceCost + weightCost);

        // console.log('Distance Cost:', distanceCost);
        // console.log('Weight Cost:', weightCost);
        // console.log('Total Price:', totalPrice);

        // Tampilkan total harga
        document.getElementById('total').textContent = `Rp. ${totalPrice.toLocaleString()}`;
    }

    // Event listener untuk autocomplete input alamat
    const alamatInput = document.getElementById('alamat');
    alamatInput.addEventListener('input', () => {
        const query = alamatInput.value;

        if (query.length > 3) {
            const geocodingUrl = `https://api.mapbox.com/geocoding/v5/mapbox.places/${query}.json?access_token=${mapboxgl.accessToken}`;

            fetch(geocodingUrl)
                .then((response) => response.json())
                .then((data) => {
                    const suggestions = data.features;

                    // Buat daftar saran autocomplete
                    const suggestionList = document.getElementById('autocomplete-list');
                    suggestionList.innerHTML = '';

                    suggestions.forEach((feature) => {
                        const listItem = document.createElement('li');
                        listItem.textContent = feature.place_name;
                        listItem.className = 'cursor-pointer hover:bg-gray-200 p-2';

                        // Saat saran diklik, isi input dan pindahkan marker
                        listItem.addEventListener('click', () => {
                            alamatInput.value = feature.place_name;
                            const [lng, lat] = feature.geometry.coordinates;

                            // Pindahkan marker ke lokasi yang dipilih
                            if (marker) {
                                marker.setLngLat([lng, lat]);
                            } else {
                                marker = new mapboxgl.Marker().setLngLat([lng, lat]).addTo(map);
                            }

                            // Geser peta ke lokasi
                            map.flyTo({ center: [lng, lat], zoom: 15 });

                            // Bersihkan daftar autocomplete
                            suggestionList.innerHTML = '';
                        });

                        suggestionList.appendChild(listItem);
                    });
                })
                .catch((error) => console.error('Error fetching autocomplete:', error));
        }
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
<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        @if (isset($snapToken))
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                /* You may add your own implementation here */
                alert("payment success!"); 
                //   window.location.href = '/invoice/{{ $order->id }}';
                console.log(result);
                },
                onPending: function(result){
                /* You may add your own implementation here */
                alert("wating your payment!"); console.log(result);
                },
                onError: function(result){
                /* You may add your own implementation here */
                alert("payment failed!"); console.log(result);
                },
                onClose: function(){
                /* You may add your own implementation here */
                alert('you closed the popup without finishing the payment');
                }
            })
        @else
        alert('Transaction token not found');
        @endif
    });
</script>