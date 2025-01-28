{{-- Sweetalert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<x-app title="Detail Akun {{ $user->id }}" bodyClass="h-screen flex flex-col gap-3">
    <div class="flex flex-row flex-grow w-full h-full">
        {{-- Sidebar --}}
        <div class="w-fit flex flex-col gap-5 p-7 items-center h-auto">
            <div class="avatar">
                <div class="w-64 rounded-full items-center border">
                    <img src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                </div>
            </div>

            <div class="stats stats-vertical drop-shadow-lg w-full">
                <div class="stat">
                    <div class="stat-title">Jumlah Pesanan</div>
                    <div class="stat-value">34</div>
                </div>

                <div class="stat h-full">
                    @if ($dataType === 'courier')
                        <div class="stat-title">Total Pendapatan</div>
                    @else
                        <div class="stat-title">Total Pengeluaran</div>
                    @endif
                    <div class="stat-value">Rp. 270.000</div>
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="flex flex-col flex-grow p-7">
            <div class="mb-2 w-full text-xl flex flex-row justify-between gap-3">
                <div class="w-4/6">
                    Nama Lengkap 
                    <input type="text" class="w-full p-2 rounded-xl border-2 drop-shadow-lg hover:border-secondary" value="{{ $user->name ?? '' }}" readonly>
                </div>
                <div>
                    Email
                    <input type="text" class="w-full p-2 rounded-xl border-2 drop-shadow-lg hover:border-secondary" value="{{ $user->email ?? '' }}" readonly>
                </div>
            </div>

            <div class="mb-2 w-full text-xl flex flex-row justify-between gap-3">
                <div class="w-full">
                    No Telepon
                    <input type="text" class="w-full p-2 rounded-xl border-2 drop-shadow-lg hover:border-secondary" value="{{ $user->phone ?? '' }}" readonly>
                </div>
            </div>

            <div class="mb-2 w-full text-xl flex flex-row justify-between gap-3">
                <div class="w-4/6">
                    Tanggal Lahir
                    <input type="date" class="w-full p-2 rounded-xl border-2 drop-shadow-lg hover:border-secondary" value="{{ $user->birthdate ?? '' }}" readonly>
                </div>
                <div class="">
                    Jenis Kelamin
                    <input class="w-full p-2 rounded-xl border-2 drop-shadow-lg hover:border-secondary" value="{{ $user->gender === 'P' ? 'Perempuan' : 'Laki-laki' }}" >
                </div>
            </div>

            <div class="mb-2 w-full text-xl flex flex-row justify-between gap-3">
                <div class="w-4/6">
                    Alamat
                    <textarea id="address" name="address" class="w-full p-2 rounded-xl border-2 drop-shadow-lg hover:border-secondary" readonly>{{ $user->address ?? '' }}</textarea>

                </div>
                <div>
                    Kota
                    <input type="text" class="w-full p-2 rounded-xl border-2 drop-shadow-lg hover:border-secondary" value="{{ $user->city ?? '' }}" readonly>
                </div>
                @if ($dataType === 'courier')
                    <div>
                        Plat Nomor
                        <input type="text" class="w-full p-2 rounded-xl border-2 drop-shadow-lg hover:border-secondary" value="{{ $user->plate_number ?? '' }}" readonly>
                    </div>
                @endif
            </div>

            {{-- Footer Section --}}
            
            @if ($dataType === 'courier')
                <div class="flex flex-row mt-auto mb-3 gap-3">
                    <form id="delete-form-{{ $user->id }}" action="{{ route('admin.destroy', $user->id) }}" method="POST" class="w-full hidden h-fit">
                        @csrf
                        @method('DELETE')
                    </form>

                    <x-button 
                        variant='danger'
                        class="w-full h-fit"
                        onclick="confirmDelete({{ $user->id }})">
                        Hapus
                    </x-button>
                    
                    <form action="{{ route('admin.index', ['type' => $dataType]) }}" class="w-full">
                        <x-button variant="secondary" class="w-full">Kembali</x-button>
                    </form>

                </div>
            @else
                <form action="{{ route('admin.index', ['type' => $dataType]) }}" class="mt-auto mb-3">
                    <x-button variant="secondary" class="w-full">Kembali</x-button>
                </form>
            @endif
        </div>
    </div>
</x-app>

<script>
    function confirmDelete(courierId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data kurir ini akan dihapus dan disimpan ke log!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${courierId}`).submit();
            }
        });
    }
</script>