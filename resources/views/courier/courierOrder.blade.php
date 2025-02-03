<head>
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.css" rel="stylesheet" />
</head>

<x-app_user title="Order" bodyClass="py-3">
    <div class="overflow-auto mb-16">
        <div class="drop-shadow-md border-b-2 text-center text-lg">{{ $order->id }}</div>

        <div class="text-center items-center p-3 drop-shadow-md border-b-2">
            Pengambilan
            <div class="flex flex-col text-start">
                {{ $order->user->name }}
                <div class="flex flex-row justify-between items-center">
                    <div>{{ $order->user->phone ?? 'Tidak Ada' }}</div>
                    <button class="p-2 hover:bg-slate-300">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
                            <path d="M22.707 16.293l-4-4a1 1 0 0 0-1.414 0l-3 3a1 1 0 0 1-1.414 0l-6-6a1 1 0 0 1 0-1.414l3-3a1 1 0 0 0 0-1.414l-4-4A1 1 0 0 0 4 2H2a1 1 0 0 0-1 1C1 11.837 9.163 20 18 20a1 1 0 0 0 1-1v-2a1 1 0 0 0-.293-.707z"/>
                        </svg>
                    </button>
                </div>
                {{ $order->address }}
            </div>
        </div>

        <div class="drop-shadow-md">
            <div id="map" style="width: 100%; height: 340px;" class="mt-4"></div>
        </div>

        <div class="text-center pt-3 px-3 border-b-2 drop-shadow-md">
            Tujuan
            <div class="flex flex-row text-start mt-2 justify-between pb-3">
                <div class="w-full">
                    {{ $order->landfill->name }}
                </div>
                <div class="w-full">
                    {{ $order->landfill->address }}
                </div>
            </div>
        </div>

        <form id="updateStatusForm" action="{{ route('order.status', $order->id) }}" method="POST" class="text-center pt-3 px-3">
            @csrf
            @method("PATCH")
            <input type="hidden" name="status" id="statusField" value="{{ $order->status }}">
        
            <x-button variant="secondary" class="w-full" id="statusButton">
                {{ $order->status == 'pickup' ? 'Konfirmasi Pengambilan' : ($order->status == 'deliver' ? 'Selesaikan' : 'Selesai') }}
            </x-button>
        </form>
    </div>
</x-app_user>
<script>
    document.getElementById("statusButton").addEventListener("click", function(event) {
    event.preventDefault();
    let statusField = document.getElementById("statusField");
    let currentStatus = statusField.value;

    if (currentStatus === "pickup") {
        statusField.value = "deliver";

        // Hapus marker pickup
        pickupMarker.remove();

        // Tambahkan marker baru untuk tujuan (TPS)
        landfillMarker.addTo(map);

        // Update rute ke landfill
        updateRoute(courierLocation, landfillLocation);
    } else if (currentStatus === "deliver") {
        statusField.value = "completed";
    }

    document.getElementById("updateStatusForm").submit();
});


</script>
{{-- <script>
    mapboxgl.accessToken = '{{ config("services.mapbox.access_token") }}';

    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [{{ $order->courier->longitude }}, {{ $order->courier->latitude }}],
        zoom: 13
    });

    new mapboxgl.Marker()
        .setLngLat([{{ $order->courier->longitude }}, {{ $order->courier->latitude }}])
        .addTo(map);
</script> --}}

<script>
    mapboxgl.accessToken = "{{ config('services.mapbox.access_token') }}";

    // Koordinat Titik Jemput dan TPS
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