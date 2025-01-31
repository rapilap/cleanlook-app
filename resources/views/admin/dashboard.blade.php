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

        <!-- Filter Tahun / Bulan -->
        <div class="px-6 pt-3 flex flex-row w-full justify-between">
            <form method="GET" action="{{ route('admin.dashboard') }}">
                <x-button name="filter" value="month" variant='primary' class="drop-shadow-lg">Bulan</x-button>
                <x-button name="filter" value="year" variant='primary' class="drop-shadow-lg">Tahun</x-button>
                <x-button type="submit" name="filter" value="all" variant='primary' class="drop-shadow-lg">Semua</x-button>
            </form>
            <div class="px-6 pt-3">
                <h3 class="text-lg font-semibold">Periode: {{ $periode }}</h3>
            </div>
        </div>

        <!-- Cards Section -->
        <div class="px-6">

            <div class="flex flex-row w-full gap-4 pt-2 h-44">
                <div class="h-full bg-white rounded-lg drop-shadow-lg border border-primary hover:border-secondary shadow-md w-full">
                    <div class="p-2 text-2xl gap-3 flex flex-col h-full">
                        <label for="" class="">
                        Sampah Dominan:
                    </label>
                    <div class="h-full flex items-center">
                        <label for="" class="text-4xl">
                            {{ $currentWaste->category->cat_name ?? 'Tidak Ada' }}
                        </label>
                    </div>
                    <div class="text-lg flex items-end flex-row justify-between">
                        <label for="">
                            Total = {{ $currentWaste->total_weight ?? 0 }} kg
                        </label>
                        <label for="">
                            -0.5%
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="h-full bg-white rounded-lg drop-shadow-lg border border-primary hover:border-secondary shadow-md w-full ">
                <div class="p-2 text-2xl gap-3 flex flex-col h-full">
                    <label for="" class="">
                        TPS Dominan:
                    </label>
                    <div class="h-full flex items-center">
                        <label for="" class="text-4xl">
                            {{ $currentTPS->landfill->name ?? 'Tidak Ada' }}
                        </label>
                    </div>
                    <div class="text-lg flex items-end flex-row justify-between">
                        <label for="">
                            Total = 30 kg
                        </label>
                        <label for="">
                            TPS Sukajadi (50kg)
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="h-full bg-white rounded-lg drop-shadow-lg border border-primary hover:border-secondary shadow-md w-full ">
                <div class="p-2 text-2xl gap-3 flex flex-col h-full">
                    <label for="" class="">
                        Kurir Teladan:
                    </label>
                    <div class="h-full flex items-center">
                        <label for="" class="text-4xl">
                            Rahmat
                        </label>
                    </div>
                    <div class="text-lg flex items-end flex-row justify-between">
                        <label for="">
                            Total = 45 pesanan
                        </label>
                        <label for="">
                            Budi (99 pesanan)
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="h-full bg-white rounded-lg drop-shadow-lg border border-primary hover:border-secondary shadow-md w-full ">
                <div class="p-2 text-2xl gap-3 flex flex-col h-full">
                    <label for="" class="">
                        Pendapatan:
                    </label>
                    <div class="h-full flex items-center">
                        <label for="" class="text-4xl">
                            Rp. 1.500.000
                        </label>
                    </div>
                    <div class="text-lg flex items-end flex-row justify-between">
                        <label for="">
                            -0.5%
                        </label>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Overview Section -->
        <div class="w-full mt-3">
            <h3 class="text-lg font-semibold">Overview</h3>
            <div class="h-52 rounded-lg shadow-md border border-primary"></div>
        </div>
    </div>
    </div>
</x-app>
