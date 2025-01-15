<x-app title="{{ $title }}" bodyClass="relative h-screen px-5 bg-gray-50"> {{-- Tambahkan relative untuk container utama --}}
    <div class="p-3">
        @if ($dataType === 'courier')
            <div class="justify-between flex flex-row items-center">
                <div class="gap-3">
                    <x-button 
                        as="a" 
                        href="{{ route('admin.index', ['type' => 'courier']) }}" 
                        variant="{{ request('type', 'courier') === 'courier' ? 'secondary' : 'primary' }}" 
                        class="max-w-fit mr-3">Akun Kurir</x-button>
                    <x-button 
                        as="a" 
                        href="{{ route('admin.index', ['type' => 'user']) }}" 
                        variant="{{ request('type') === 'user' ? 'secondary' : 'primary' }}" 
                        class="max-w-fit">Akun Pengguna</x-button>
                </div>
                <div> 
                    <input 
                    type="text"
                    name="search"
                    placeholder="Search"
                    class="p-2 rounded-lg border border-gray-300 focus">
                </div>
                <div>
                    @if ($dataType === 'courier')
                        <x-button as='a' href="/admin/account/add" variant="secondary">Tambah Kurir</x-button>
                    @endif
                </div>
            </div>
        @else
            <div class="justify-between flex flex-row items-center">
                <div class="gap-3">
                    <x-button 
                        as="a" 
                        href="{{ route('admin.index', ['type' => 'courier']) }}" 
                        variant="{{ request('type', 'courier') === 'courier' ? 'secondary' : 'primary' }}" 
                        class="max-w-fit mr-3">Akun Kurir</x-button>
                    <x-button 
                        as="a" 
                        href="{{ route('admin.index', ['type' => 'user']) }}" 
                        variant="{{ request('type') === 'user' ? 'secondary' : 'primary' }}" 
                        class="max-w-fit">Akun Pengguna</x-button>
                </div>
                <div> 
                    <input 
                    type="text"
                    name="search"
                    placeholder="Search"
                    class="p-2 rounded-lg border border-gray-300 focus">
                </div>
            </div>
        @endif

        <table class="w-full border-collapse border border-gray-300 mt-3">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 p-2 font-normal text-center">ID</th>
                    <th class="border border-gray-300 p-2 font-normal text-center">Email</th>
                    <th class="border border-gray-300 p-2 font-normal text-center">Nama</th>
                    <th class="border border-gray-300 p-2 font-normal text-center">No Telepon</th>
                    <th class="border border-gray-300 p-2 font-normal text-center">Domisili</th>
                    @if ($dataType === 'courier')
                        <th class="border border-gray-300 p-2 font-normal text-center">
                            No Kendaraan
                        </th>
                    @endif
                    <th class="border border-gray-300 p-2 font-normal text-center">Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user as $user)
                <tr class="my-3">
                    <td class="border border-gray-300 p-2 text-center">{{ $user->id }}</td>
                    <td class="border border-gray-300 p-2">{{ $user->email }}</td>
                    <td class="border border-gray-300 p-2">{{ $user->name }}</td>
                    <td class="border border-gray-300 p-2">{{ $user->phone }}</td>
                    <td class="border border-gray-300 p-2">{{ $user->city }}</td>
                    @if ($dataType === 'courier')
                    <td class="border border-gray-300 p-2">        
                        {{ $user->plate_number }}
                    </td>
                    @endif
                    <td class="border border-gray-300 px-4 py-3  text-center">
                        <a href="{{ route('admin.edit', $user->id)}}" class="bg-secondary text-white hover:bg-primary hover:text-white hover:border-primary p-2 rounded-lg">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="absolute bottom-0 inset-x-0 flex justify-between p-3 bg-white">
        <span>1</span>
        <span>2</span>
        <span>3</span>
    </div>
</x-app>
<script>
    let timeout = null;

    function filterDelay() {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            document.getElementById('filter-form').submit();
        }, 300);
    }
</script>
