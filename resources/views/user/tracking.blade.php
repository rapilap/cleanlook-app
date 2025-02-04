<head>
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.css" rel="stylesheet" />
    <!-- Tambahkan ini sebelum script $.ajax -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<x-app_user title="Order" bodyClass="py-3">
    <div class="">
        <div class="drop-shadow-md border-b-2 text-center text-lg">{{ $order->id }}</div>

        <div class="text-center items-center p-3 drop-shadow-md border-b-2">
            Pesanan
            <div class="flex flex-col text-start">
<<<<<<< HEAD
                {{ $order->courier->name }}
=======
                {{ $order->courier->name }} ({{ $order->courier->plate_number }})
>>>>>>> baad1804da9abbee120eed27c261ff002465d5df
                <div class="flex flex-row justify-between items-center">
                    <div>{{ $order->courier->phone ?? 'Tidak Ada' }}</div>
                    <button class="p-2 hover:bg-slate-300">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
                            <path d="M22.707 16.293l-4-4a1 1 0 0 0-1.414 0l-3 3a1 1 0 0 1-1.414 0l-6-6a1 1 0 0 1 0-1.414l3-3a1 1 0 0 0 0-1.414l-4-4A1 1 0 0 0 4 2H2a1 1 0 0 0-1 1C1 11.837 9.163 20 18 20a1 1 0 0 0 1-1v-2a1 1 0 0 0-.293-.707z"/>
                        </svg>
                    </button>
                </div>
                {{ $order->status == 'pickup' ? 'Sedang Diambil' : ($order->status == 'deliver' ? 'Sedang Diantar' : 'Selesai') }}
            </div>
        </div>

        <div class="drop-shadow-md">
            <div id="map" style="width: 100%; height: 380px;" class="mt-4"></div>
        </div>

        <div class="text-center pt-3 px-3 border-b-2 drop-shadow-md">
            Tujuan
            <div class="flex flex-row text-start mt-2 justify-between pb-3">
                {{ $order->landfill->name }}
                <div>
                    {{ $order->landfill->address }}
                </div>
            </div>
        </div>
    </div>
</x-app_user>

<script>
    mapboxgl.accessToken = "{{ config('services.mapbox.access_token') }}";

    var pickupLocation = [{{ $order->pickup_long }}, {{ $order->pickup_lat }}]; // Koordinat alamat jemput
    var landfillLocation = [{{ $order->landfill->longitude }}, {{ $order->landfill->latitude }}]; // Koordinat TPS
    var courierLocation = [{{ $order->courier->longitude }}, {{ $order->courier->latitude }}];

    // Inisialisasi Peta
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: courierLocation, // Titik pusat peta
        zoom: 13
    });

    // Tambahkan Marker untuk Titik Jemput
    new mapboxgl.Marker({ color: "green" })
        .setLngLat(courierLocation)
        .setPopup(new mapboxgl.Popup().setHTML("<b>Kurir</b><br>{{ $order->courier->name }}"))
        .addTo(map);

    // Tambahkan Marker untuk TPS
    var pickupMarker = new mapboxgl.Marker({ color: "red" })
        .setLngLat(pickupLocation)
        .setPopup(new mapboxgl.Popup().setHTML("<b>Ambil</b><br>{{ $order->address }}"))
        .addTo(map);

    var landfillMarker = new mapboxgl.Marker({ color: "red" })
        .setLngLat(landfillLocation)
        .setPopup(new mapboxgl.Popup().setHTML("<b>TPS</b><br>{{ $order->landfill->name }}"));

    // Ambil rute antara titik jemput dan TPS
    function updateRoute(start, end) {
    fetch(
        `https://api.mapbox.com/directions/v5/mapbox/driving/${start[0]},${start[1]};${end[0]},${end[1]}?geometries=geojson&access_token={{ config('services.mapbox.access_token') }}`
    )
    .then(response => response.json())
    .then(json => {
        console.log("Route response:", json); // Debugging: cek response API
        if (!json.routes || json.routes.length === 0) {
            console.error("No route found");
            return;
        }

        const routeData = json.routes[0].geometry;

        if (map.getSource("route")) {
            map.getSource("route").setData({
                type: "Feature",
                properties: {},
                geometry: routeData
            });
        } else {
            map.addSource("route", {
                type: "geojson",
                data: {
                    type: "Feature",
                    properties: {},
                    geometry: routeData
                }
            });

            map.addLayer({
                id: "route",
                type: "line",
                source: "route",
                layout: { "line-cap": "round", "line-join": "round" },
                paint: { "line-color": "#1db7dd", "line-width": 5 }
            });
        }
    })
    .catch(error => console.error("Error fetching route:", error));
}


    // map.on('load', function () {
    //     getRoute(courierLocation, pickupLocation);
    // });
    map.on("load", function () {
    updateRoute(courierLocation, pickupLocation);
});

</script>

<script>
    let courierId = "{{ $activeOrder->courier_id ?? '' }}"; // Pastikan variabel tidak null

    function updateCourierLocation() {
        if (!courierId) {
            console.warn("Tidak ada courier_id aktif.");
            return;
        }

        $.ajax({
            url: `/history/get-location/${courierId}`,
            type: "GET",
            success: function(response) {
                console.log("Lokasi kurir terbaru:", response);
                let lat = response.latitude;
                let lng = response.longitude;

                // Update marker di Mapbox
                marker.setLngLat([lng, lat]);
            },
            error: function(xhr) {
                console.error("Gagal mengambil lokasi kurir:", xhr);
            }
        });
    }

    // Panggil fungsi update setiap 5 detik
    setInterval(updateCourierLocation, 5000);
</script>
