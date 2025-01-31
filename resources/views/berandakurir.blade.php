<x-app_user title="Home">
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <x-slot name="header">
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
    </x-slot>

    <div class="mx-5 h-full">
        <div class="pt-6">
            <!-- Greeting -->
            <h1 class="text-xl font-bold mb-2">Halo, {{ $courier->name }}</h1>
            <p class="text-sm text-gray-600 mb-6">Semangat dan selamat bekerja dengan Cleanlook</p>
        </div>

        <div class="rounded-lg px-5 py-3 shadow-xl h-[730px] md:h-[420px]">
            <div class="drop-shadow-xl w-full mb-3">
                <h3 class="text-md font-bold drop-shadow-md">Pesanan</h3>
            </div>
            <div class="overflow-x-auto max-h-[660px] md:max-h-[200px] space-y-4">
                @foreach($order as $item)
                    <div class="p-2 rounded-lg shadow-lg bg-white">
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
                            <button class="bg-green-500 text-white px-4 py-2 rounded-lg">Pick</button>
                            <button class="bg-red-500 text-white px-4 py-2 rounded-lg">Cancel</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app_user>
