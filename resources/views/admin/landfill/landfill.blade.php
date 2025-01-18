<script src="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js"></script>
<link href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css" rel="stylesheet" />

<x-app title="Lokasi TPA" bodyClass="h-screen gap-3 p-4">
    <div class="grid grid-cols-2">
        <!-- Kontainer Kiri -->
        <div class="flex flex-col gap-3 mr-4">
            <!-- Pencarian dan Tombol Tambah -->
            <div class="flex flex-row gap-3 justify-between">
                <input type="text" class="border-2 p-2 rounded-lg text-lg hover:border-primary" placeholder="Cari Lokasi">
                <x-button variant='secondary' class="mr-10">Tambah Lokasi</x-button>
            </div>

            <!-- Kontainer Scroll untuk Card -->
            <div class="overflow-y-auto max-h-[525px] pr-2"> 
                @foreach ($landfill as $ld)
                <div class="card w-full h-fit shadow-xl flex flex-row justify-between mb-2">
                    <div class="card-body">
                        <h1 class="card-title text-xl">{{ $ld->name }}</h1>
                        <p>{{ $ld->address }}</p>
                        <p>Kapasitas: {{ $ld->capacity }} kg</p>
                    </div>
                    <div class="card-actions h-50 items-center mr-4">
                        <x-button variant="secondary" class="">Pusatkan</x-button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        <!-- Kontainer Kanan -->
        <div class="gap-5">
            {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d101662.90772537998!2d107.56075443316591!3d-6.903442379229659!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6398252477f%3A0x146a1f93d3e815b2!2sBandung%2C%20Bandung%20City%2C%20West%20Java!5e1!3m2!1sen!2sid!4v1737129065162!5m2!1sen!2sid" width="100%" height="90%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> --}}

            <div id="map" style="width: 100%; height: 90%;"></div>
                {{-- <script>
                    mapboxgl.accessToken = '{{ config('services.mapbox.access_token') }}';
                
                    const map = new mapboxgl.Map({
                        container: "map", // ID elemen peta
                        style: "mapbox://styles/mapbox/streets-v11", // Gaya peta
                        center: [107.560754, -6.903442], // Koordinat (lng, lat)
                        zoom: 12, // Level zoom
                    });
                
                    // Tambahkan marker
                    const markers = [
                        { lng: 107.619123, lat: -6.917464, title: "Titik 1" },
                        { lng: 107.602123, lat: -6.904464, title: "Titik 2" },
                    ];
                
                    markers.forEach((marker) => {
                        new mapboxgl.Marker()
                            .setLngLat([marker.lng, marker.lat])
                            .setPopup(new mapboxgl.Popup().setText(marker.title)) // Pop-up info
                            .addTo(map);
                    });
                </script> --}}
                
                {{-- <script>
                    mapboxgl.accessToken = '{{ config("services.mapbox.access_token") }}';
            
                    // Inisialisasi Mapbox
                    const map = new mapboxgl.Map({
                        container: 'map',
                        style: 'mapbox://styles/mapbox/streets-v11',
                        center: [107.6191, -6.9175], // Default center
                        zoom: 10,
                    });
            
                    // Fungsi untuk menambahkan marker ke peta
                    function addMarker(lng, lat, name) {
                        new mapboxgl.Marker()
                            .setLngLat([lng, lat])
                            .setPopup(new mapboxgl.Popup().setHTML(`<h3>${name}</h3>`))
                            .addTo(map);
                    }
            
                    // Fetch data landfill dari backend (AJAX)
                    fetch('{{ url("/admin/landfill") }}', {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest', // Indikasi permintaan AJAX
                        },
                    })
                        .then(response => response.json())
                        .then(data => {
                            // Tambahkan marker untuk setiap lokasi
                            data.data.forEach(location => {
                                addMarker(location.longitude, location.latitude, location.name);
                            });
                        })
                        .catch(error => console.error('Error fetching landfill data:', error));
                </script> --}}

                {{-- <script>
                    mapboxgl.accessToken = '{{ config("services.mapbox.access_token") }}';
                
                    // Inisialisasi Mapbox
                    const map = new mapboxgl.Map({
                        container: 'map', // ID elemen HTML
                        style: 'mapbox://styles/mapbox/streets-v11',
                        center: [107.6191, -6.9175], // Titik pusat awal (Bandung)
                        zoom: 10,
                    });
                
                    // Fungsi untuk menambahkan marker
                    function addMarker(lng, lat, name, address, capacity) {
                        const popupContent = `
                            <div>
                                <h3>${name}</h3>
                                <p>${address}</p>
                                <p>Kapasitas: ${capacity} kg</p>
                            </div>
                        `;
                
                        new mapboxgl.Marker()
                            .setLngLat([lng, lat]) // Longitude, Latitude
                            .setPopup(new mapboxgl.Popup().setHTML(popupContent)) // Tambahkan popup
                            .addTo(map);
                    }
                
                    // Fetch data Landfill via AJAX
                    fetch('{{ url("/admin/landfill") }}', {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest', // Indikasi permintaan AJAX
                        },
                    })
                        .then(response => response.json())
                        .then(data => {
                            // Iterasi data dan tambahkan marker
                            data.data.forEach(location => {
                                if (location.longitude && location.latitude) {
                                    addMarker(location.longitude, location.latitude, location.name, location.address, location.capacity);
                                } else {
                                    console.warn('Invalid data for marker:', location);
                                }
                            });
                        })
                        .catch(error => console.error('Error fetching landfill data:', error));
                </script> --}}

                <script>
                    mapboxgl.accessToken = '{{ config("services.mapbox.access_token") }}';
                
                    // Inisialisasi Mapbox
                    const map = new mapboxgl.Map({
                        container: 'map',
                        style: 'mapbox://styles/mapbox/streets-v11',
                        center: [107.6191, -6.9175], // Titik pusat awal (Bandung)
                        zoom: 10,
                    });
                
                    // Data landfill dari server (PHP ke JavaScript)
                    const landfills = @json($landfill);
                
                    // Fungsi untuk menambahkan marker
                    function addMarker(lng, lat, name, address, capacity) {
                        const popupContent = `
                            <div>
                                <h3>${name}</h3>
                                <p>${address}</p>
                                <p>Kapasitas: ${capacity} kg</p>
                            </div>
                        `;
                
                        new mapboxgl.Marker()
                            .setLngLat([lng, lat])
                            .setPopup(new mapboxgl.Popup().setHTML(popupContent))
                            .addTo(map);
                    }
                
                    // Tambahkan marker untuk setiap landfill
                    landfills.forEach(location => {
                        if (location.latitude && location.longitude) {
                            addMarker(location.longitude, location.latitude, location.name, location.address, location.capacity);
                        }
                    });
                </script>
                
            <div class="mt-3">
                {{-- {{ $landfill->links() }} --}}
            </div>
        </div>
    </div>
</x-app>
