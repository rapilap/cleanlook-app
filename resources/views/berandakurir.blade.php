<x-app_user title="Home">

    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    
    <!-- Navbar -->
    <nav class="bg-primary py-4 px-6 flex justify-between">
        <div class="flex items-center">
            <div class="text-2xl font-bold">Cleanlook</div>
        </div>
        <div>
            <form action="{{ route('courier.logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-secondary hover:bg-green-300 duration-700 text-white text-sm font-medium py-2 px-4 rounded">Logout</button>
            </form>
        </div>
    </nav>

    <div class="mx-5 h-full">

        <div class="pt-6">
            <!-- Greeting -->
            <h1 class="text-xl font-bold mb-2">Halo, {{$courier->name }}</h1>
            <p class="text-sm text-gray-600 mb-6">Semangat dan selamat bekerja dengan cleanlook</p>
            
        </div>
        </div>
        
        <div class="rounded-lg px-5 py-3 shadow-xl mx-5 h-[500px] md:h-[420px]">
            <div class="drop-shadow-xl w-full">
                <h3 class="text-md font-bold mb-1 drop-shadow-md">Pesanan</h3>
            </div>
            <div class="overflow-x-auto max-h-[450px] md:max-h[200px]">
                @foreach($order as $item)
            <div class="p-4 rounded-lg shadow-lg">
                <div class="flex flex-row justify-between">
                    <p class="py-2"><strong>Penjemputan:</strong> <br>{{ $item->address }}</p>
                    <p class="py-2"><strong>Pengantaran:</strong> <br>{{ $item->landfill->name }}
                </div>
                <div class="flex flex-row">
                    <p class="pb-2"><strong>Berat Sampah:</strong> <span class="bg-green-200 text-green-700 px-2 py-1 rounded">{{ $item->weight }} kg</span></p>                    
                </div>
                <p class="pb-2"><strong>Biaya:</strong> Rp. {{ number_format($item->price, 0, ',', '.') }}</p>
                <div class="flex justify-between mt-4">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg">Pick</button>                    
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg">Cancel</button>                        
                </div>
            </div>
            @endforeach
        </div>
</x-app_user>