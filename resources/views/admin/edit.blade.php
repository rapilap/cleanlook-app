<x-app title="Tambah Akun" bodyClass="h-screen flex flex-col gap-3">
    <div class="flex flex-row flex-grow w-full">
        {{-- Sidebar --}}
        <div class="w-fit flex flex-col gap-5 p-7 items-center">
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

                <div class="stat">
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
                    <input type="text" class="w-full p-2 rounded-xl border-2 drop-shadow-lg hover:border-secondary" value="{{ $user->name ?? '' }}">
                </div>
                <div>
                    Email
                    <input type="text" class="w-full p-2 rounded-xl border-2 drop-shadow-lg hover:border-secondary" value="{{ $user->email ?? '' }}">
                </div>
            </div>

            <div class="mb-2 w-full text-xl flex flex-row justify-between gap-3">
                <div class="w-full">
                    No Telepon
                    <input type="text" class="w-full p-2 rounded-xl border-2 drop-shadow-lg hover:border-secondary" value="{{ $user->phone ?? '' }}">
                </div>
            </div>

            <div class="mb-2 w-full text-xl flex flex-row justify-between gap-3">
                <div class="w-4/6">
                    Tanggal Lahir
                    <input type="date" class="w-full p-2 rounded-xl border-2 drop-shadow-lg hover:border-secondary" value="{{ $user->birthdate ?? '' }}">
                </div>
                <div class="">
                    Jenis Kelamin
                    <select class="w-full p-2 rounded-xl border-2 drop-shadow-lg hover:border-secondary">
                        <option value="Laki-laki" {{ $user->gender == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ $user->gender == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="mb-2 w-full text-xl flex flex-row justify-between gap-3">
                <div class="w-4/6">
                    Alamat
                    <textarea class="w-full p-2 rounded-xl border-2 drop-shadow-lg hover:border-secondary">
                    {{ $user->address ?? '' }}
                    </textarea>
                </div>
                <div>
                    Kota
                    <input type="text" class="w-full p-2 rounded-xl border-2 drop-shadow-lg hover:border-secondary" value="{{ $user->city ?? '' }}">
                </div>
                @if ($dataType === 'courier')
                    <div>
                        Plat Nomor
                        <input type="text" class="w-full p-2 rounded-xl border-2 drop-shadow-lg hover:border-secondary" value="{{ $user->plate_number ?? '' }}">
                    </div>
                @endif
            </div>

            {{-- Footer Section --}}
            <div class="mt-auto mb-3">
                <x-button variant="secondary" class="w-full">Simpan</x-button>
            </div>
        </div>
    </div>
</x-app>
