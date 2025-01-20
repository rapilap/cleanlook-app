<head>
    <!-- import elemen dasar mapbox -->
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.js"></script>
    <!-- import geocoder mapbox -->
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.min.js"></script>
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.css" type="text/css">
</head>

<x-app title="Tambah Lokasi" bodyClass="h-screen gap-3 p-4">
    <form action="{{ route('landfill.store') }}" method="POST" class="grid grid-cols-2 h-full">
        @csrf
        <div class="flex flex-col gap-3 mr-4 h-full">
            <div class="text-5xl text-secondary mb-4">
                Tambah Lokasi
            </div>
            <div class="flex flex-col">
                <label for="name">Nama Lokasi</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    value="{{ old('name') }}" 
                    class="border-2 border-black p-3 rounded-lg hover:border-primary @error('name') border-red-500 @enderror"
                    placeholder="Masukkan nama lokasi"
                >
                @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col">
                <label for="address">Alamat Lokasi</label>
                <textarea name="address" id="address" cols="30" rows="5" class="border-2 border-black p-3 rounded-lg hover:border-primary @error('address') border-red-500 @enderror" placeholder="Masukkan alamat">{{ old('address') }}</textarea>
                @error('address')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col">
                <label for="capacity">Kapasitas (Kg)</label> 
                <input 
                type="text" 
                name="capacity" 
                id="capacity" 
                value="{{ old('capacity') }}"
                class="border-2 border-black p-3 rounded-lg hover:border-primary @error('capacity') border-red-500 @enderror" placeholder="Masukkan kapasitas (kg)">
                @error('capacity')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-row w-full gap-3">

                <div class="flex flex-col w-full">
                    <label for="latitude">Latitude</label>
                    <input 
                    type="text" 
                    name="latitude" 
                    id="latitude" 
                    value="{{ old('latitude') }}"
                    class="border-2 border-black p-3 rounded-lg hover:border-primary @error('latitude') border-red-500 @enderror" placeholder="Terisi otomatis">
                    @error('latitude')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col w-full">
                    <label for="longitude">Longitude</label>
                    <input 
                    type="text" 
                    name="longitude" 
                    id="longitude" 
                    value="{{ old('longitude') }}"
                    class="border-2 border-black p-3 rounded-lg hover:border-primary @error('longitude') border-red-500 @enderror" placeholder="Terisi otomatis">
                    @error('longitude')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="h-full items-end">
                <x-button variant="secondary" class="w-full items-end" type="submit" onclick="return confirm('Apakah Anda yakin ingin menambah data ini?')">Simpan Lokasi</x-button>
            </div>
        </div>

        <div id="map" style="width: 100%; height: 95%;"></div>

    </form>
</x-app>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        mapboxgl.accessToken = "{{ config('services.mapbox.access_token') }}";

        const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [107.6191, -6.9175],
            zoom: 10,
        });

        // Tambahkan kontrol pencarian (autocomplete)
        const geocoder = new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
            mapboxgl: mapboxgl,
            marker: false,
            countries: 'id'
        });
        map.addControl(geocoder);

        // Tambahkan marker manual saat klik peta
        let marker;
        map.on('click', (e) => {
            const { lng, lat } = e.lngLat;

            // Jika marker sudah ada, pindahkan ke lokasi baru
            if (marker) {
                marker.setLngLat([lng, lat]);
            } else {
                // Buat marker baru
                marker = new mapboxgl.Marker().setLngLat([lng, lat]).addTo(map);
            }

            // Isi input latitude dan longitude
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        });

        // Update input address saat hasil pencarian dipilih
        geocoder.on('result', (e) => {
            const { center, place_name } = e.result;

            // Isi alamat, latitude, dan longitude
            document.getElementById('address').value = place_name;
            document.getElementById('latitude').value = center[1];
            document.getElementById('longitude').value = center[0];

            // Pindahkan marker ke lokasi hasil pencarian
            if (marker) {
                marker.setLngLat(center);
            } else {
                marker = new mapboxgl.Marker().setLngLat(center).addTo(map);
            }
        });

        geocoder.on('result', (e) => {
            const { center, place_name } = e.result;

            // Isi alamat, latitude, dan longitude
            document.getElementById('address').value = place_name; // Menyimpan nama tempat ke input address
            document.getElementById('latitude').value = center[1];
            document.getElementById('longitude').value = center[0];

            // Pindahkan marker ke lokasi hasil pencarian
            if (marker) {
                marker.setLngLat(center);
            } else {
                marker = new mapboxgl.Marker().setLngLat(center).addTo(map);
            }
        });

    });
</script>
