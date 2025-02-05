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
                <form action="{{ route('admin.index') }}" method="GET"> 
                    <input type="hidden" name="type" value="{{ $dataType }}">
                    <input 
                    type="text"
                    name="search"
                    placeholder="Search"
                    value="{{ request('search') }}"
                    class="p-2 rounded-lg border border-gray-300 focus">
                </form>
                <div>
                    @if ($dataType === 'courier')
                        <x-button as='a' href="{{ route('admin.create') }}" variant="secondary">Tambah Kurir</x-button>
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
        
        <div class="max-h-[480px] overflow-y-auto mt-2">
            <table class="table">
              <!-- head -->
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nama</th>
                  <th>No Telepon</th>
                  @if ($dataType === 'courier')
                        <th>
                            No Kendaraan
                        </th>
                    @endif
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($page as $user)
                    
                <!-- row 1 -->
                <tr class="hover">
                    <td>
                        {{ $user->id }}
                    </td>
                  <td>
                    <div class="flex items-center gap-3">
                      <div class="avatar">
                        <div class="mask mask-squircle h-12 w-12">
                            <img src="{{ $user->image ? asset('storage/' . $user->image) : asset('assets/default-avatar.png') }}">
                        </div>
                      </div>
                      <div>
                        <div class="font-bold">{{ $user->name }}</div>
                        <div class="text-sm opacity-50">{{ $user->email }}</div>
                      </div>
                    </div>
                  </td>
                  <td>
                    {{ $user->phone }}
                    <br />
                  </td>
                  @if ($dataType === 'courier')
                    <td>        
                        {{ $user->plate_number }}
                    </td>
                    @endif
                    <td>
                        <a href="{{ route('admin.edit', [$user->id, 'type'=>$dataType]) }}" class="bg-secondary text-white hover:bg-primary hover:text-white hover:border-primary p-2 rounded-lg">Detail</a>
                    </td>
                </tr>
            @endforeach
              </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    {{-- <div class="absolute bottom-0 inset-x-0 flex justify-between p-3 bg-white"> --}}
    <div class="mt-auto mb-1">
        {{ $page->appends(request()->except('page'))->links() }}
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

@if (session('success'))
    <script>
        Swal.fire({
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'OK'
        });
    </script>
@endif