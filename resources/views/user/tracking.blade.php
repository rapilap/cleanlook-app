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
            <div class="grid grid-cols-2 items-center p-3">
                <div class="flex flex-col text-start">
                    {{ $order->courier->name }} ({{ $order->courier->plate_number }})
                    <div class="flex flex-row justify-between items-center">
                        <div>{{ $order->courier->phone ?? 'Tidak Ada' }}</div>
                    </div>
                    {{ $order->status == 'pickup' ? 'Sedang Diambil' : ($order->status == 'deliver' ? 'Sedang Diantar' : 'Selesai') }}
                </div>
                <div class="flex justify-end">
                    <img class="w-24 h-24 rounded-full object-cover border-2 border-black" 
                         src="{{ $order->courier->image ? asset('storage/' . $order->courier->image) : asset('assets/default-avatar.png') }}">
                </div>
            </div>
            
        </div>

        <div class="drop-shadow-md">
            <div id="map" class="mt-4 w-full h-[450px] md:h-[280px]"></div>
        </div>

        <div class="text-center pt-3 px-3 border-b-2 drop-shadow-md">
            Tujuan
            <div class="flex flex-row text-start mt-2 justify-between pb-3">
                <div class="w-full">
                    {{ $order->landfill->name }}
                </div>
                <div class="w-full text-end">
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
    var marker = new mapboxgl.Marker({ color: "green" })
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

                // Pastikan lokasi benar
                if (!lat || !lng) {
                    console.error("Data lokasi kosong atau tidak valid");
                    return;
                }

                // Update lokasi courierLocation
                courierLocation = [lng, lat];

                // Update marker kurir di Mapbox
                marker.setLngLat(courierLocation);

                // Jika status sudah deliver, pastikan rute diperbarui ke TPS
                if (statusField.value === "deliver") {
                    updateRoute(courierLocation, landfillLocation);
                }
            },
            error: function(xhr) {
                console.error("Gagal mengambil lokasi kurir:", xhr);
            }
        });
    }

    // Panggil fungsi update setiap 5 detik
    setInterval(updateCourierLocation, 5000);
</script>
