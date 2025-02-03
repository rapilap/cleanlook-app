<x-app title="Dashboard" bodyClass="w-full h-full">
    <div class="items-center w-full h-full">
        <!-- Logo Section -->
        <div class="bg-primary w-full h-fit py-3 px-6 flex justify-center drop-shadow-lg items-center">
            <div class="w-full h-full text-center flex flex-row">
                <img src="{{ asset('assets/logo.jpg') }}" alt="Logo" class="rounded-full max-h-16 max-w-16">
                <div class="text-2xl ml-3 w-full flex items-center text-white font-medium">
                    CleanLook
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="">
                @csrf
                <x-button variant='secondary'>Logout</x-button>
            </form>
        </div>

        <!-- Filter -->
        <div class="px-6 pt-3 flex flex-row w-full justify-between">
            <form method="GET" action="{{ route('admin.dashboard') }}" class="flex items-center gap-4">
                <div class="flex flex-col">
                    <label for="start_date" class="text-sm font-semibold">Tanggal Awal</label>
                    <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}" class="border border-gray-300 rounded-lg p-2 shadow-md">
                </div>
                
                <div class="flex flex-col">
                    <label for="end_date" class="text-sm font-semibold">Tanggal Akhir</label>
                    <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}" class="border border-gray-300 rounded-lg p-2 shadow-md">
                </div>
        
                <x-button type="submit" variant="primary" class="drop-shadow-lg mt-5">Filter</x-button>
            </form>
            
            <div class="px-6 pt-3">
                <h3 class="text-lg font-semibold">
                    Periode: {{ $periode ?? 'Semua Waktu' }}
                </h3>
            </div>
        </div>

        <!-- Cards Section -->
        <div class="px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2">

                <div class="h-44 bg-white rounded-lg drop-shadow-lg border border-primary hover:border-secondary shadow-md p-4 flex flex-col justify-between">
                    <label class="text-2xl font-semibold">Sampah Dominan:</label>
                    <div class="flex-1 flex items-center">
                        <span class="text-4xl font-bold">
                            {{ $currentWaste->category->cat_name ?? 'Tidak Ada' }}
                        </span>
                    </div>
                    <div class="text-lg flex justify-between">
                        <span>Total = {{ $currentWaste->total_weight ?? 0 }} kg</span>
                    </div>
                </div>
        
                <div class="h-44 bg-white rounded-lg drop-shadow-lg border border-primary hover:border-secondary shadow-md p-4 flex flex-col justify-between">
                    <label class="text-2xl font-semibold">TPS Dominan:</label>
                    <div class="flex-1 flex items-center">
                        <span class="text-4xl font-bold">
                            {{ $currentTPS->landfill->name ?? 'Tidak Ada' }}
                        </span>
                    </div>
                    <div class="text-lg flex justify-between">
                        <span>Total = {{ $currentTPS->total_tps ?? 0 }} kg</span>
                    </div>
                </div>
        
                <div class="h-44 bg-white rounded-lg drop-shadow-lg border border-primary hover:border-secondary shadow-md p-4 flex flex-col justify-between">
                    <label class="text-2xl font-semibold">Kurir Teladan:</label>
                    <div class="flex-1 flex items-center">
                        <span class="text-4xl font-bold">
                            {{ $topCourier->courier->name ?? 'Tidak Ada' }}
                        </span>
                    </div>
                    <div class="text-lg flex justify-between">
                        <span>Total = {{ $topCourier->total_orders ?? 0 }} pesanan</span>
                    </div>
                </div>
        
                <div class="h-44 bg-white rounded-lg drop-shadow-lg border border-primary hover:border-secondary shadow-md p-4 flex flex-col justify-between">
                    <label class="text-2xl font-semibold">Pendapatan:</label>
                    <div class="flex-1 flex items-center">
                        <span class="text-4xl font-bold">
                            Rp. {{ number_format($currentRevenue, 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="text-lg flex justify-between">
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>
