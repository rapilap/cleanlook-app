<x-app_user title="Home">
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Navbar -->
        <nav class="bg-primary py-4 px-6 flex justify-between items-center">
            <div class="text-2xl font-bold">Cleanlook</div>
            <form action="{{ route('courier.logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-secondary hover:bg-green-300 duration-700 text-white text-sm font-medium py-2 px-4 rounded">
                    Logout
                </button>
            </form>
        </nav>

    <div class="mx-5 h-full">
        <div class="pt-6">
            <!-- Greeting -->
            <h1 class="text-xl font-bold mb-2">Halo, {{ $courier->name }}</h1>
            <p class="text-sm text-gray-600 mb-6">Semangat dan selamat bekerja dengan Cleanlook</p>
        </div>

        <div class="rounded-lg px-5 py-3 shadow-xl h-[670px] md:h-[420px]">
            <div class="drop-shadow-xl w-full mb-3">
                <h3 class="text-md font-bold drop-shadow-md">Pesanan</h3>
            </div>
            <div class="overflow-x-auto max-h-[600px] md:max-h-[200px] space-y-4">
                @foreach($order as $item)
                    <div class="p-2 rounded-lg shadow-lg bg-white">
                        <div class="mb-2">
                            <p><strong>Id Pesanan:</strong></p>
                            <p class="p-2 rounded">{{ $item->id }}</p>
                        </div>
                        <div class="mb-2">
                            <p><strong>Penjemputan:</strong></p>
                            <p class="p-2 rounded">{{ $item->address }}</p>
                        </div>
                        <div class="mb-2">
                            <p><strong>Pengantaran:</strong></p>
                            <p class="p-2 rounded">{{ $item->landfill->name }}</p>
                        </div>
                        
                        <div class="flex flex-row items-center space-x-4 mt-2">
                            <p><strong>Berat Sampah:</strong></p>
                            <span class="bg-green-200 text-green-700 px-2 py-1 rounded">
                                {{ $item->weight }} kg
                            </span>
                        </div>
                        <p class="mt-3"><strong>Biaya:</strong> Rp. {{ number_format($item->price, 0, ',', '.') }}</p>
                        <div class="flex justify-between mt-4">
                            @if ($item->status === 'searching')
                                <form action="{{ route('courier.accept', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="bg-green-500 text-white px-4 py-2 rounded-lg" type="submit">Ambil</button>
                                    {{-- <button class="bg-red-500 text-white px-4 py-2 rounded-lg">Cancel</button> --}}
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
                @if ($activeOrder)
                    <div class="active-order">
                        <div class="p-2 rounded-lg shadow-lg bg-white">
                            <div class="mb-2">
                                <p><strong>Id Pesanan:</strong></p>
                                <p class="p-2 rounded">{{ $activeOrder->id }}</p>
                            </div>
                            <div class="mb-2">
                                <p><strong>Penjemputan:</strong></p>
                                <p class="p-2 rounded">{{ $activeOrder->address }}</p>
                            </div>
                            <div class="mb-2">
                                <p><strong>Pengantaran:</strong></p>
                                <p class="p-2 rounded">{{ $activeOrder->landfill->name }}</p>
                            </div>
                            
                            <div class="flex flex-row items-center space-x-4 mt-2">
                                <p><strong>Berat Sampah:</strong></p>
                                <span class="bg-green-200 text-green-700 px-2 py-1 rounded">
                                    {{ $activeOrder->weight }} kg
                                </span>
                            </div>
                            <p class="mt-3"><strong>Biaya:</strong> Rp. {{ number_format($activeOrder->price, 0, ',', '.') }}</p>
                            <div class="flex justify-between mt-4">
                                <a href="{{ route('courier.detail', $activeOrder->id) }}" class="btn btn-warning">
                                    Lihat
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <form action="{{ route('courier.location') }}" method="POST" id="location-form">
        @csrf
        <input type="hidden" id="latitude" name="latitude">
        <input type="hidden" id="longitude" name="longitude">
        <button type="submit" id="update-location" class="hidden"></button>
    </form>
    
    <script>
        function updateLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    document.getElementById('latitude').value = position.coords.latitude;
                    document.getElementById('longitude').value = position.coords.longitude;
                    document.getElementById('update-location').click();
                });
            }
        }
    
        setInterval(updateLocation, 10000); // Kirim lokasi setiap 10 detik
    </script>
    
</x-app_user>
