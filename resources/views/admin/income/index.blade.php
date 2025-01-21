<x-app title="Pendapatan" bodyClass="p-4 flex h-screen flex-col">
    <div class="container text-5xl text-secondary">
        Pendapatan
    </div>
    <div class="flex w-full flex-row gap-3 justify-between">
        <div class="mt-5 flex flex-col w-1/4">
            <label for="start">Tanggal Awal</label>
            <input type="date" name="start-date" id="start-date" class="mt-2 p-2 w-full border border-black rounded-lg hover:border-primary">
        </div>
        <div class="mt-5 flex flex-col w-1/4">
            <label for="end">Tanggal Akhir</label>
            <input type="date" name="end-date" id="end-date" class="mt-2 p-2 w-full border border-black rounded-lg hover:border-primary">
        </div>
        <form action="{{ route('admin.history.index') }}" method="GET" class="w-full text-end mt-5 flex items-end justify-end">
            <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}"
            id="search" 
            placeholder="Cari di sini" class="p-2 w-5/6 md:w-2/6 items-end border border-black rounded-lg hover:border-primary">
        </form>
    </div>

    <div class="overflow-x-auto overflow-y-auto max-h-[360px] mt-5">
        <table class="table table-auto border-collapse w-full">
            <!-- head -->
            <thead class="bg-white sticky top-0 z-10">
                <tr>
                  <th class="p-2">ID Pesanan</th>
                  <th class="p-2">Tanggal</th>
                  <th class="p-2">Tipe Sampah</th>
                  <th class="p-2">Berat Sampah</th>
                  <th class="p-2">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($history as $his)
                <tr class="hover">
                    <td class="p-2">{{ $his->id }}</td>
                    <td class="p-2">{{ $his->date }}</td>
                    <td class="p-2">{{ $his->category->cat_name }}</td>
                    <td class="p-2">{{ $his->weight }} Kg</td>
                    <td class="p-2">Rp. {{ number_format($his->price, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="my-2">
        {{ $history->links() }}
    </div>
</x-app>
