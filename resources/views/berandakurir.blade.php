@vite('resources/css/app.css')
<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    

    <!-- Navbar -->
  `<nav class="bg-primary py-4 px-6 flex justify-between">
    <div class="flex items-center">
        <div class="text-2xl font-bold">Cleanlook</div>
    </div>
    <div>
        <a href="" 
           class=" font-bold hover:underline">
           Log Out
        </a>
    </div>
</nav>`

<div class="p-6">
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
                        <p class="font-bold text-gray-800">Rp. {{ number_format($pengeluaran, 0, ',', '.') }}</p>
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
        <h3 class="text-md font-bold mb-4">Penjemputan hari ini</h3>

</div>

@foreach($pesanan as $item)
            <div class="bg-white p-4 rounded-lg shadow-lg mb-4">
                <p><strong>Alamat:</strong> {{ $item->alamat }}</p>
                <p><strong>Berat sampah:</strong> <span class="bg-green-200 text-green-700 px-2 py-1 rounded">{{ $item->berat }}kg</span></p>
                <p><strong>Biaya:</strong> Rp. {{ number_format($item->biaya, 0, ',', '.') }}</p>
                <div class="flex justify-between mt-4">
                    <form action="{{ route('pesanan.pick', $item->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg">Pick</button>
                    </form>
                    <form action="{{ route('pesanan.cancel', $item->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg">Cancel</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>