<head>
    <!-- import elemen dasar mapbox -->
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.js"></script>
    <!-- import geocoder mapbox -->
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.min.js"></script>
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.css" type="text/css">
    <!-- import cdn sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<x-app title="Edit Lokasi" bodyClass="h-screen gap-3 p-4">
    <form action="{{ route('landfill.update', $landfill->id) }}" method="POST" class="grid grid-cols-2 h-full">
        @csrf
        @method('PUT')

        <div class="flex flex-col gap-3 mr-4 h-full">
            <div class="text-5xl text-secondary mb-4">
                Edit Lokasi
            </div>
            <div class="flex flex-col">
                <label for="name">Nama Lokasi</label>
                <input type="text" name="name" id="name" class="border-2 border-black p-3 rounded-lg hover:border-primary" value="{{ $landfill->name ?? '' }}">
            </div>

            <div class="flex flex-col">
                <label for="address">Alamat Lokasi</label>
                <textarea name="address" id="address" rows="5" class="border-2 border-black p-3 rounded-lg hover:border-primary">{{ $landfill->address }}</textarea>
            </div>

            <div class="flex flex-col">
                <label for="capacity">Kapasitas (Kg)</label>
                <input type="text" name="capacity" id="capacity" class="border-2 border-black p-3 rounded-lg hover:border-primary" value="{{ $landfill->capacity }}"> Kg
            </div>

            <div class="flex flex-row w-full gap-3">

                <div class="flex flex-col w-full">
                    <label for="latitude">Latitude</label>
                    <input type="text" name="latitude" id="latitude" class="border-2 border-black p-3 rounded-lg hover:border-primary" value="{{ $landfill->latitude }}">
                </div>
                <div class="flex flex-col w-full">
                    <label for="longitude">Longitude</label>
                    <input type="text" name="longitude" id="longitude" class="border-2 border-black p-3 rounded-lg hover:border-primary" value="{{ $landfill->longitude }}">
                </div>
            </div>

            <div class="h-full items-end"id="editForm-{{ $landfill->id }}">
                <x-button variant="secondary" class="w-full items-end" type="submit" onclick="confirmEdit('{{ $landfill->id }}')">Simpan Lokasi</x-button>
            </div>
        </div>

        <div id="map" style="width: 100%; height: 95%;"></div>

    </form>
</x-app>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        mapboxgl.accessToken = '{{ config("services.mapbox.access_token") }}';

        // Koordinat awal berdasarkan data lokasi
        const initialCoordinates = [{{ $landfill->longitude }}, {{ $landfill->latitude }}];

        // Inisialisasi Mapbox
        const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: initialCoordinates, // Pusatkan pada koordinat awal
            zoom: 13,
        });

        // Tambahkan marker pada koordinat awal
        let marker = new mapboxgl.Marker()
            .setLngLat(initialCoordinates)
            .addTo(map);

        // Update latitude dan longitude di form saat marker dipindahkan
        map.on('click', (e) => {
            const { lng, lat } = e.lngLat;

            // Pindahkan marker ke lokasi baru
            marker.setLngLat([lng, lat]);

            // Update input form
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        });
    });

    function confirmEdit(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, ubah!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`editForm-${id}`).submit();
            }
        });
    }
</script>
