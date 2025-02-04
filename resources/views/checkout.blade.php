<head>
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css" rel="stylesheet" />
</head>

<script type="text/javascript"
src="https://app.sandbox.midtrans.com/snap/snap.js"
data-client-key="{{ config('midtrans.clientKey') }}"></script>

<x-app_user title="Payment Checkout" bodyClass='p-3'>
    <div class="flex flex-col shadow-2xl w-full h-[500px] rounded-lg p-3 mb-3">
        <table class="w-full">
            <tr>
                <td>No pesanan</td> <td>:</td> <td>{{ $transaction->order_id }}</td>
            </tr>
            <tr>
                <td>Tanggal</td> <td>:</td> <td>{{ $transaction->date }}</td>
            </tr>
            <tr>
                <td>Nama pelanggan</td> <td>:</td> <td>{{ $transaction->user->name }}</td>
            </tr>
            <tr>
                <td>Alamat pengambilan</td> <td>:</td> <td>{{ $transaction->address }}</td>
            </tr>
            <tr>
                <td>TPS</td> <td>:</td> <td>{{ $transaction->landfill->name }}</td>
            </tr>
            <tr>
                <td>Berat sampah</td> <td>:</td> <td>{{ $transaction->weight }} Kg</td>
            </tr>
            <tr>
                <td>Jenis Sampah</td> <td>:</td> <td>{{ $transaction->category->cat_name }}</td>
            </tr>
            <tr>
                <td>Biaya</td> <td>:</td> <td>{{ $transaction->price }}</td>
            </tr>
        </table>
        <div class="bg-white h-64">
            <div name="map" id="map" class="w-full h-full"></div>
            <div name="geolocate" id="geolocate" class="w-fit"></div>
            &ensp;
        </div>
    </div>
    <div class="mt-10 w-full gap-3 flex flex-row justify-end mb-16">
        <form action="{{ route('user.home') }}" class="w-full">
            <x-button type='submit' variant='danger' class="w-full">Kembali</x-button>
        </form>
        <div class="w-full">
            <x-button id="pay-button" variant='tertiery' class="w-full">Bayar</x-button>
        </div>
    </div>
</x-app_user>

<script>
    mapboxgl.accessToken = "{{ config('services.mapbox.access_token') }}";

    // Koordinat Titik Jemput dan TPS
    var pickupLocation = [{{ $transaction->pickup_long }}, {{ $transaction->pickup_lat }}]; // Koordinat alamat jemput
    var landfillLocation = [{{ $transaction->landfill->longitude }}, {{ $transaction->landfill->latitude }}]; // Koordinat TPS

    // Inisialisasi Peta
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: pickupLocation, // Titik pusat peta
        zoom: 13
    });

    // Tambahkan Marker untuk Titik Jemput
    new mapboxgl.Marker({ color: "green" })
        .setLngLat(pickupLocation)
        .setPopup(new mapboxgl.Popup().setHTML("<b>Titik Jemput</b><br>{{ $transaction->address }}"))
        .addTo(map);

    // Tambahkan Marker untuk TPS
    new mapboxgl.Marker({ color: "red" })
    .setLngLat(landfillLocation)
        .setPopup(new mapboxgl.Popup().setHTML("<b>TPS</b><br>{{ $transaction->landfill->name }}"))
        .addTo(map);

    // Ambil rute antara titik jemput dan TPS
    async function getRoute(start, end) {
        const query = await fetch(
            `https://api.mapbox.com/directions/v5/mapbox/driving/${start[0]},${start[1]};${end[0]},${end[1]}?geometries=geojson&access_token={{ config('services.mapbox.access_token') }}`,
            { method: 'GET' }
        );
        const json = await query.json();
        const data = json.routes[0];

        // Tambahkan garis rute ke peta
        map.addSource('route', {
            type: 'geojson',
            data: {
                type: 'Feature',
                properties: {},
                geometry: data.geometry
            }
        });

        map.addLayer({
            id: 'route',
            type: 'line',
            source: 'route',
            layout: { 'line-cap': 'round', 'line-join': 'round' },
            paint: { 'line-color': '#1db7dd', 'line-width': 5 }
        });
    }

    map.on('load', function () {
        getRoute(pickupLocation, landfillLocation);
    });
</script>

<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {

        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                /* You may add your own implementation here */
                // alert("payment success!"); 
                window.location.href = '/history'; // ganti url routenya
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
    });
</script>