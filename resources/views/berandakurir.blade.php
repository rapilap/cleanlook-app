<x-app_user>

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

    <div class="mx-5">

        <div class="pt-6">
            <!-- Greeting -->
            <h1 class="text-xl font-bold mb-2">Halo, nma</h1>
            <p class="text-sm text-gray-600 mb-6">Semangat dan selamat bekerja dengan cleanlook</p>
            
            <!-- Balance Section -->
            <div class="bg-primary p-6 rounded-lg shadow-lg mb-6">
            <h3 class="text-lg font-semibold">Total Balance</h3>
            <p class="text-2xl font-bold text-gray-800">Rp. </p>
            
            <div class="flex justify-between mt-4">
                <div class="flex items-center">
                    <span class="text-green-600 font-bold text-lg">&#8595;</span>
                    <div class="ml-2">
                        <p class="text-sm text-gray-600">Penghasilan</p>
                        {{-- <p class="font-bold text-gray-800">Rp. {{ number_format($pengeluaran, 0, ',', '.') }}</p> --}}
                        <p class="font-bold text-gray-800">Rp. 50,000</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <span class="text-red-600 font-bold text-lg">&#8593;</span>
                    <div class="ml-2">
                        <p class="text-sm text-gray-600">Pengeluaran</p>
                        <p class="font-bold text-gray-800">Rp.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Pickup Section -->
        <h3 class="text-md font-bold mb-1">Pesanan</h3>
        
    </div>

    {{-- @foreach($pesanan as $item) --}}
    <div class="overflow-x-auto max-h-[230px] md:max-h[210px]">

        <div class="p-4 rounded-lg shadow-lg">
            {{-- <p><strong>Alamat:</strong> {{ $item->alamat }}</p> --}}
            <div class="flex flex-row justify-between">
                <p class="py-2"><strong>Penjemputan:</strong> Bandung</p>
                <p class="py-2"><strong>Pengantaran:</strong> TPS Uber
                </div>
                {{-- <p><strong>Berat sampah:</strong> <span class="bg-green-200 text-green-700 px-2 py-1 rounded">{{ $item->berat }}kg</span></p> --}}
                <div class="flex flex-row">
                    <p class="pb-2"><strong>Berat Sampah:</strong> <span class="bg-green-200 text-green-700 px-2 py-1 rounded">40 kg</span></p>
                    {{-- <span class="px-2 py-1 bg-red-400 rounded">B3</span> --}}
                </div>
            {{-- <p><strong>Biaya:</strong> Rp. {{ number_format($item->biaya, 0, ',', '.') }}</p> --}}
            <p class="pb-2"><strong>Biaya:</strong> Rp. 500, 000</p>
            <div class="flex justify-between mt-4">
                {{-- <form action="{{ route('pesanan.pick', $item->id) }}" method="POST">
                    @csrf --}}
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg">Pick</button>
                    {{-- </form> --}}
                    {{-- <form action="{{ route('pesanan.cancel', $item->id) }}" method="POST">
                        @csrf --}}
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg">Cancel</button>
                        {{-- </form> --}}
            </div>
        </div>
        <div class="p-4 rounded-lg shadow-lg">
            {{-- <p><strong>Alamat:</strong> {{ $item->alamat }}</p> --}}
            <div class="flex flex-row justify-between">
                <p class="py-2"><strong>Penjemputan:</strong> Bandung</p>
                <p class="py-2"><strong>Pengantaran:</strong> TPS Uber
                </div>
                {{-- <p><strong>Berat sampah:</strong> <span class="bg-green-200 text-green-700 px-2 py-1 rounded">{{ $item->berat }}kg</span></p> --}}
                <div class="flex flex-row">
                    <p class="pb-2"><strong>Berat Sampah:</strong> <span class="bg-green-200 text-green-700 px-2 py-1 rounded">40 kg</span></p>
                    {{-- <span class="px-2 py-1 bg-red-400 rounded">B3</span> --}}
                </div>
            {{-- <p><strong>Biaya:</strong> Rp. {{ number_format($item->biaya, 0, ',', '.') }}</p> --}}
            <p class="pb-2"><strong>Biaya:</strong> Rp. 500, 000</p>
            <div class="flex justify-between mt-4">
                {{-- <form action="{{ route('pesanan.pick', $item->id) }}" method="POST">
                    @csrf --}}
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg">Pick</button>
                    {{-- </form> --}}
                    {{-- <form action="{{ route('pesanan.cancel', $item->id) }}" method="POST">
                        @csrf --}}
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg">Cancel</button>
                        {{-- </form> --}}
                    </div>
                </div>
            </div>
        {{-- @endforeach --}}
    </div>
</x-app_user>