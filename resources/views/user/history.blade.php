<x-app_user title="Riwayat" bodyClass="p-3">
    <form  method="GET" action="{{ route('user.orderHistory') }}" class="flex flex-row justify-between">
        <div class="text-3xl text-secondary items-center">
            Riwayat
        </div>
        <input type="text" name="search" id="search" value="{{ request()->query('search') }}" class="border border-primary hover:border-secondary rounded-lg p-2 w-3/6" placeholder="Cari Tanggal">
    </form>

    <div class="mt-5">
        Pesanan Berlangsung
    </div>
    @if (count($ongoingOrders) > 0)
        @foreach ($ongoingOrders as $order)
        <div class="flex justify-between items-center p-4 border border-teal-500 rounded-lg font-sans w-50 mt-2">
            <div>
                <div class="text-lg font-bold text-black">{{ $order->courier->name ?? 'Mencari Kurir' }}</div>
                <div class="text-sm text-gray-500">Rp. {{ number_format($order->price, 0, ',', '.') }}</div>
                <div class="text-sm text-gray-500">{{ $order->landfill->name }}</div>
            </div>
            <form action="{{ route('user.orderTrack', $order->id) }}" method="GET">
                <x-button variant='secondary' class="">Lihat</x-button>
            </form>
        </div>
        @endforeach
    @else
        <div class="w-full text-center py-3">
            Transaksi Kosong
        </div>    
    @endif
    
    <div class="mt-5">
        Riwayat Pesanan
    </div>
    <div class="max-h-[350px] overflow-auto">
        @if (count($history)>0)
            @foreach ($history as $his)
                
            <div class="flex justify-between items-center p-4 border border-teal-500 rounded-lg font-sans w-50 mt-2">
                <div>
                    <div class="text-md font-bold text-black">{{ $his->landfill->name }}
                    </div>
                    <div class="text-sm text-gray-500">{{ $his->date }}</div>
                </div>
                <div class="text-lg font-bold text-red-600">-Rp. {{ number_format($his->price, 0, ',', '.') }}</div>
            </div>
            @endforeach
        @else
            <div class="w-full text-center py-3">
                Transaksi Kosong
            </div>
        @endif
    </div>
</x-app_user>