<script src="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js"></script>
<link href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<x-app title="Lokasi TPA" bodyClass="h-screen gap-3 p-4">
    <div class="grid grid-cols-2 h-full">
        <div class="flex flex-col gap-3 mr-4">
            <div class="flex flex-row gap-3 justify-between">
                <form action="{{ route('landfill.index') }}" method="GET">
                    <input 
                    type="text"
                    name="search"
                    id="search" 
                    class="border-2 p-2 rounded-lg text-lg hover:border-primary" 
                    value="{{ request('search') }}"
                    placeholder="Cari Lokasi">
                </form>
                <form action="{{ route('landfill.create') }}">
                    <x-button variant='secondary' class="mr-10" type="submit">Tambah Lokasi</x-button>
                </form>
            </div>

            <!-- Kontainer Scroll untuk Card -->
            @if (count($landfill) > 0)
                
            <div class="overflow-y-auto max-h-[515px] pr-2"> 
                @foreach ($landfill as $ld)
                <div class="card w-full h-fit shadow-xl flex flex-row justify-between mb-2">
                    <div class="card-body">
                        <h1 class="card-title text-xl">{{ $ld->name }}</h1>
                        <p>{{ $ld->address }}</p>
                        <p>Kapasitas: {{ $ld->capacity }} kg</p>
                    </div>

                    <div class="card-actions items-center justify-center flex flex-col gap-2 mr-2 pt-2">
                        <x-button 
                        onclick="focusMarker({{ $ld->latitude }}, {{ $ld->longitude }}, '{{ $ld->name }}', '{{ $ld->address }}', '{{ $ld->capacity }}')" variant='secondary'>
                            Tampilkan
                        </x-button>
                        <div class="flex flex-row w-full gap-2">
                            <form action="{{ route('landfill.edit', $ld->id) }}" method="get" class="w-2/4 text-center bg-yellow-500 p-3 rounded-md text-white font-medium transition-all duration-300 hover:bg-yellow-400">
                                @csrf
                                <button type="submit">
                                    Edit
                                </button>
                            </form>
                            <form action="{{ route('landfill.destroy', $ld->id) }}" method="POST" id="deleteForm-{{ $ld->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="w-full md:w-auto text-center bg-red-500 p-3 rounded-md text-white font-medium transition-all duration-300 hover:bg-red-400" onclick="confirmDelete('{{ $ld->id }}')">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-lg text-center">Tidak ada data</p>
            @endif
        </div>
        
        <!-- Kontainer Kanan -->
        <div class="gap-5">
            <div id="map" style="width: 100%; height: 95%;"></div>
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

                    // Fungsi untuk memindahkan peta ke lokasi marker tertentu
                    function focusMarker(lat, lng, name, address, capacity) {
                        const popupContent = `
                            <div>
                                <h3>${name}</h3>
                                <p>${address}</p>
                                <p>Kapasitas: ${capacity} kg</p>
                            </div>
                        `;

                        // Tambahkan marker dan popup saat tombol "Tampilkan" diklik
                        new mapboxgl.Popup()
                            .setLngLat([lng, lat])
                            .setHTML(popupContent)
                            .addTo(map);

                        // Pindahkan peta ke marker
                        map.flyTo({
                            center: [lng, lat],
                            zoom: 15, // Zoom level
                            essential: true, // This ensures the transition is smooth
                        });
                    }

                    function confirmDelete(id) {
                        Swal.fire({
                            title: 'Apakah Anda yakin?',
                            text: "Data yang dihapus tidak dapat dikembalikan!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.getElementById(`deleteForm-${id}`).submit();
                            }
                        });
                    }
                </script>
                
            <div class="mt-3">
                {{-- {{ $landfill->links() }} --}}
            </div>
        </div>
    </div>
</x-app>
