<head>
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.css" rel="stylesheet" />
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
</script>